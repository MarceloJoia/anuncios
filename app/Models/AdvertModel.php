<?php

namespace App\Models;

use App\Entities\Advert;

class AdvertModel extends MyBaseModel
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        /**
         * @todo $this->user = service('auth')->user() ?? auth('api')->user();
         */
        $this->user = service('auth')->user();
    }

    protected $DBGroup          = 'default';
    protected $table            = 'adverts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Advert::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'category_id',
        'code',
        'title',
        'description',
        'price',
        //'is_published', // esse não colocamos aqui, pois queremos ter um controle maior de quando o anúncio deverá ser publicado/despublicado
        'situation',
        'zipcode',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeDataXSS', 'generateCitySlug', 'generateCode', 'setUserID'];
    protected $beforeUpdate   = ['escapeDataXSS', 'generateCitySlug'/*, 'unpublish'*/];

    /**
     * Gera o Slug da Cidade que está vindo nos dados
     *
     * @param array $data
     * @return array
     */
    protected function generateCitySlug(array $data): array
    {
        if (isset($data['data']['city'])) {
            $data['data']['city_slug'] = mb_url_title($data['data']['city'], lowercase: true);
        }
        return $data;
    }

    /**
     * Se existir a posição $data Cria a posição CODE e gerar um código
     *
     * @param array $data
     * @return array
     */
    protected function generateCode(array $data): array
    {
        if (isset($data['data'])) {
            $data['data']['code'] = strtoupper(uniqid('AVERT_', true));
        }
        return $data;
    }


    /**
     * Captura o Usuário logado e gera um ID de Usuário
     *
     * @param array $data
     * @return array
     */
    protected function setUserID(array $data): array
    {
        if (isset($data['data'])) {
            $data['data']['user_id'] = $this->user->id;
        }
        return $data;
    }


    protected function unpublish(array $data): array
    {
        // Houve alteração no title ou description?
        if (isset($data['data']['title']) || isset($data['data']['description'])) {
            // Sim.... houve alteração.... então tornamos o anúncio como não publicado (false)
            $data['data']['is_published'] = false;
        }

        return $data;
    }


    /**
     * Recupera todos os anúncios de acordo com o usuário logado.
     *
     * @param boolean $onlyDeleted
     * @return void
     */
    public function getAllAdverts(bool $onlyDeleted = false)
    {
        $this->setSQLMode();

        $builder = $this;

        if ($onlyDeleted) {
            $builder->onlyDeleted();
        }

        $tableFields = [
            'adverts.*',
            'categories.name AS category',
            'adverts_images.image AS images', // apelido (alias) de 'images', que utilizaremos no método image() do Entity Advert
        ];

        $builder->select($tableFields);

        // Quem está logado é o manager?
        if (!$this->user->isSuperadmin()) {
            // É o usuário anunciante.... então recuperamos apenas os anúncios dele
            $builder->where('adverts.user_id', $this->user->id);
        }

        $builder->join('categories', 'categories.id = adverts.category_id');
        $builder->join('adverts_images', 'adverts_images.advert_id = adverts.id', 'LEFT'); // Nem todos os anúncios terão imagens
        $builder->groupBy('adverts.id'); // para não repetir registros
        $builder->orderBy('adverts.id', 'DESC');

        return $builder->findAll();
    }


    /**
     * Recupera o anúncio de acordo com o id.
     *
     * @param integer $id
     * @param boolean $withDeleted
     * @return object|null
     */
    public function getAdvertByID(int $id, bool $withDeleted = false)
    {

        $builder = $this;

        $tableFields = [
            'adverts.*',
            'users.email', // para notificarmos o usuário/anunciante
        ];

        $builder->select($tableFields);
        $builder->withDeleted($withDeleted);

        // Quem está logado é o manager?
        if (!$this->user->isSuperadmin()) {
            // É o usuário anunciante.... então recuperamos apenas os anúncios dele
            $builder->where('adverts.user_id', $this->user->id);
        }

        $builder->join('users', 'users.id = adverts.user_id');

        $advert = $builder->find($id);

        // Foi encontrado um anúncio?
        if (!is_null($advert)) {
            // Sim... então podemos buscar as imagens do mesmo
            $advert->images = $this->getAdvertImages($advert->id);
        }

        // Retornamos o anúncio que pode ou não ter imagens
        return $advert;
    }

    /**
     * Recupera a image do anúncio
     *
     * @param integer $advertID
     * @return array
     */
    public function getAdvertImages(int $advertID): array
    {
        return $this->db->table('adverts_images')->where('advert_id', $advertID)->get()->getResult();
    }


    /**
     * Salva o anúncio no database
     *
     * @param Advert $advert
     * @param boolean $protect
     * @return void
     */
    public function trySaveAdvert(Advert $advert, bool $protect = true)
    {
        try {
            $this->db->transStart();
            $this->protect($protect)->save($advert);
            $this->db->transComplete();
        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error saving data');
        }
    }

    public function tryStoreAdvertImages(array $dataImages, int $advertID)
    {
        try {
            $this->db->transStart();

            $this->db->table('adverts_images')->insertBatch($dataImages); // Salva as imagens

            $this->protect(false)->set('is_published', false)->where('id', $advertID)->update(); // Despublica o Anúncio

            $this->db->transComplete();
        } catch (\Exception $e) {

            log_message('error', '[ERROR] {exception}', ['exception' => $e]);

            die('Error saving data');
        }
    }


    public function tryDeleteAdvertImage(int $advertID, string $image)
    {
        $criteria = [
            'advert_id' => $advertID,
            'image'     => $image
        ];

        return $this->db->table('adverts_images')->where($criteria)->delete();
    }



    public function tryArchiveAdvert(int $advertID)
    {
        try {
            $this->db->transStart();
            // Quem está logado é o manager?
            if (!$this->user->isSuperadmin()) {
                // É o usuário anunciante.... então arquivamos apenas os anúncio dele
                $this->where('user_id', $this->user->id)->delete($advertID);
            } else {
                // é o manager
                $this->delete($advertID);
            }
            $this->db->transComplete();
        } catch (\Exception $e) {

            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            die('Error saving data');
        }
    }
}
