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
}
