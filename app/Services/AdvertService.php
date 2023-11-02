<?php

namespace App\Services;

use App\Entities\Advert;
use App\Models\AdvertModel;
use CodeIgniter\Config\Factories;
use CodeIgniter\Events\Events; // para disparar eventos

class AdvertService
{
    private $user;
    private $advertModel;

    public const SITUATION_NEW  = 'new';
    public const SITUATION_USED = 'used';


    public function __construct()
    {
        // $this->user = service('auth')->user() ?? auth('api')->user();
        $this->user = service('auth')->user();
        $this->advertModel = Factories::models(AdvertModel::class);
    }


    public function getAllAdverts(
        bool $showBtnArchive = true,
        bool $showBtnViewAdvert = true,
        bool $showBtnQuestions = true,
        string $classBtnActions = 'btn btn-primary btn-sm',
        string $sizeImage = 'small',
    ) {
        $adverts = $this->advertModel->getAllAdverts();

        $data = [];

        /** @var string $baseRouteToEditImages para editar imagem */
        $baseRouteToEditImages  = $this->user->isSuperadmin() ? 'adverts.manager.edit.images' : 'adverts.my.edit.images';

        /** @var string $baseRouteToQuestions para editar as perguntas */
        $baseRouteToQuestions   = $this->user->isSuperadmin() ? 'adverts.manager.edit.questions' : 'adverts.my.edit.questions';


        foreach ($adverts as $advert) {

            // É para exibir o botão?
            if ($showBtnArchive) {

                // Sim...

                $btnArchive = form_button(
                    [
                        'data-id' => $advert->id,
                        'id'      => 'btnArchiveAdvert', // ID do html element
                        'class'   => 'dropdown-item'
                    ],
                    '<i class="bi bi-archive-fill"></i>&nbsp;'  . lang('App.btn_archive')
                );
            }

            $btnEdit = form_button(
                [
                    'data-id' => $advert->id,
                    'id'      => 'btnEditAdvert', // ID do html element
                    'class'   => 'dropdown-item'
                ],
                '<i class="bi bi-pencil-square"></i>&nbsp;' . lang('App.btn_edit')
            );


            $finalRouteToEditImages = route_to($baseRouteToEditImages, $advert->id);

            $btnEditImages = form_button(
                [
                    'class'     => 'dropdown-item',
                    'onClick'   => "location.href='{$finalRouteToEditImages}'",
                ],
                '<i class="bi bi-image"></i>&nbsp;'  . lang('Adverts.btn_edit_images')
            );


            // O botão é para ser exibido e o anúncio está publicado?
            if ($showBtnViewAdvert && $advert->is_published) {

                // Sim... podemos montar o botão (ação)

                $routeToViewAdvert = route_to('adverts.detail', $advert->code);

                $btnViewAdvert = form_button(
                    [
                        'class'     => 'dropdown-item',
                        'onClick'   => "window.open('{$routeToViewAdvert}', '_blank')",
                    ],
                    '<i class="bi bi-eye"></i>&nbsp;'  . lang('Adverts.btn_view_advert')
                );
            }


            // O botão é para ser exibido e o anúncio está publicado?
            if ($showBtnQuestions && $advert->is_published) {

                // Sim... podemos montar o botão (ação)

                $finalRouteToEditQuestions = route_to($baseRouteToQuestions, $advert->code);

                $btnViewQuestions = form_button(
                    [
                        'class'     => 'dropdown-item',
                        'onClick'   => "location.href='{$finalRouteToEditQuestions}'",
                    ],
                    '<i class="bi bi-person-raised-hand"></i>&nbsp;'  . lang('Adverts.btn_view_questions')
                );
            }


            // Começamos a montar o botão de ações do dropdown


            $btnActions = '<div class="dropdown dropup">'; // Abertura da div do dropdown


            $attrBtnActions = [
                'type'              => 'button',
                'id'                => 'actions',
                'class'             => "dropdown-toggle {$classBtnActions}",
                'data-bs-toggle'    => "dropdown", // Para BS5
                'data-toggle'       => "dropdown", // Para BS4
                'aria-haspopup'     => "true",
                'aria-expanded'     => "false",
            ];

            $btnActions .= form_button($attrBtnActions, lang('App.btn_actions'));


            $btnActions .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'; // abertura da div do dropdown menu

            // Criamos as opções de botões (ações)
            $btnActions .= $btnEdit;
            $btnActions .= $btnEditImages;


            // O botão é para ser exibido e o anúncio está publicado?
            if ($showBtnViewAdvert && $advert->is_published) {

                // Sim... podemos montar o botão (ação)

                $btnActions .= $btnViewAdvert;
            }

            // O botão é para ser exibido e o anúncio está publicado?
            if ($showBtnQuestions && $advert->is_published) {

                // Sim... podemos montar o botão (ação)

                $btnActions .= $btnViewQuestions;
            }


            // É para exibir o botão?
            if ($showBtnArchive) {

                // Sim...

                $btnActions .= $btnArchive;
            }

            $btnActions .= '</div>'; // Fechamento da div do dropdown-menu

            $btnActions .= '</div>'; // Fechamento da div do dropdown

            $data[] = [
                // 'image'        => $advert->image(classImage: 'card-img-top img-custom', sizeImage: $sizeImage),
                'image'        => $advert->image(),
                'title'        => $advert->title,
                'code'         => $advert->code,
                'category'     => $advert->category,
                'is_published' => $advert->isPublished(),
                'address'      => $advert->address(),
                'actions'      => $btnActions,
            ];
        }


        return $data;
    }


    // public function getArchivedAdverts(
    //     bool $showBtnRecover = true,
    //     string $classBtnActions = '',
    //     string $classBtnRecover = '',
    //     string $classBtnDelete = '',
    // ): array {


    //     $adverts = $this->advertModel->getAllAdverts(onlyDeleted: true);

    //     $data = [];

    //     $btnRecover = '';


    //     foreach ($adverts as $advert) {

    //         // É para exibir o botão?

    //         if ($showBtnRecover) {

    //             $btnRecover = form_button(
    //                 [
    //                     'data-id' => $advert->id,
    //                     'id'      => 'btnRecoverAdvert', // ID do html element
    //                     'class'   => 'dropdown-item'
    //                 ],
    //                 lang('App.btn_recover')
    //             );
    //         }


    //         $btnDelete = form_button(
    //             [
    //                 'data-id' => $advert->id,
    //                 'id'      => 'btnDeleteAdvert', // ID do html element
    //                 'class'   => 'dropdown-item'
    //             ],
    //             lang('App.btn_delete')
    //         );

    //         // Começamos a montar o botão de ações do dropdown


    //         $btnActions = '<div class="dropdown dropup">'; // Abertura da div do dropdown


    //         $attrBtnActions = [
    //             'type'              => 'button',
    //             'id'                => 'actions',
    //             'class'             => "dropdown-toggle {$classBtnActions}",
    //             'data-bs-toggle'    => "dropdown", // Para BS5
    //             'data-toggle'       => "dropdown", // Para BS4
    //             'aria-haspopup'     => "true",
    //             'aria-expanded'     => "false",
    //         ];

    //         $btnActions .= form_button($attrBtnActions, lang('App.btn_actions'));


    //         $btnActions .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'; // abertura da div do dropdown menu

    //         // Criamos as opções de botões (ações)
    //         $btnActions .= $btnRecover;
    //         $btnActions .= $btnDelete;

    //         $btnActions .= '</div>'; // Fechamento da div do dropdown-menu

    //         $btnActions .= '</div>'; // Fechamento da div do dropdown

    //         $data[] = [
    //             'title'                 => $advert->title,
    //             'code'                  => $advert->code,
    //             'actions'               => $btnActions,
    //         ];
    //     }


    //     return $data;
    // }


    // public function getAdvertByID(int $id, bool $withDeleted = false)
    // {
    //     $advert = $this->advertModel->getAdvertByID($id, $withDeleted);

    //     if (is_null($advert)) {

    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Advert not found');
    //     }

    //     return $advert;
    // }


    // public function getDropdownSituations(string $advertSituation = null)
    // {
    //     $options    = [];
    //     $selected   = [];

    //     $options = [
    //         ''                     => lang('Adverts.label_situation'), // option vazio
    //         self::SITUATION_NEW    => lang('Adverts.text_new'),
    //         self::SITUATION_USED   => lang('Adverts.text_used'),
    //     ];


    //     // Estamos criando ou editando um anúncio?
    //     if (is_null($advertSituation)) {

    //         // Estamos criando...

    //         return form_dropdown('situation', $options, $selected, ['class' => 'form-control']);
    //     }


    //     // Estamos editando um anúncio...

    //     $selected[] = match ($advertSituation) {

    //         self::SITUATION_NEW         => self::SITUATION_NEW,
    //         self::SITUATION_USED        => self::SITUATION_USED,

    //         default                     => throw new \Exception("Unsupported {$advertSituation}"),
    //     };

    //     return form_dropdown('situation', $options, $selected, ['class' => 'form-control']);
    // }


    // public function trySaveAdvert(Advert $advert, bool $protect = true, bool $notifyUserIfPublished = false)
    // {

    //     try {

    //         $advert->unsetAuxiliaryAttributes();

    //         if ($advert->hasChanged()) {

    //             $this->advertModel->trySaveAdvert($advert, $protect);

    //             $this->fireAdvertEvents($advert, $notifyUserIfPublished);
    //         }
    //     } catch (\Exception $e) {

    //         die('Error saving data');
    //     }
    // }


    // public function tryStoreAdvertImages(array $images, int $advertID)
    // {
    //     try {

    //         $advert = $this->getAdvertByID($advertID);

    //         $dataImages = ImageService::storeImages($images, 'adverts', 'advert_id', $advert->id);

    //         $this->advertModel->tryStoreAdvertImages($dataImages, $advert->id);

    //         $this->fireAdvertEventForNewImages($advert);
    //     } catch (\Exception $e) {

    //         die('Error saving data');
    //     }
    // }


    // public function tryDeleteAdvertImage(int $advertID, string $image)
    // {
    //     try {

    //         $advert = $this->getAdvertByID($advertID);

    //         $this->advertModel->tryDeleteAdvertImage($advert->id, $image);

    //         ImageService::destroyImage('adverts', $image);
    //     } catch (\Exception $e) {

    //         die('Error deleting data');
    //     }
    // }


    // public function tryArchiveAdvert(int $advertID)
    // {

    //     try {

    //         $advert = $this->getAdvertByID($advertID);

    //         $this->advertModel->tryArchiveAdvert($advert->id);
    //     } catch (\Exception $e) {

    //         die('Error archiving data');
    //     }
    // }

    // public function tryRecoverAdvert(int $advertID)
    // {

    //     try {

    //         $advert = $this->getAdvertByID($advertID, withDeleted: true);

    //         $advert->recover();

    //         $this->trySaveAdvert($advert, protect: false);
    //     } catch (\Exception $e) {

    //         die('Error recovering data');
    //     }
    // }

    // public function tryDeleteAdvert(int $advertID, bool $wantValidateAdvert = true)
    // {
    //     try {

    //         if ($wantValidateAdvert) {

    //             $advert = $this->getAdvertByID($advertID, withDeleted: true);
    //             $this->advertModel->tryDeleteAdvert($advert->id);
    //             return true;
    //         }

    //         $this->advertModel->tryDeleteAdvert($advertID);
    //         return true;
    //     } catch (\Exception $e) {

    //         log_message('error', '[ERROR] {exception}', ['exception' => $e]);

    //         die('Error deleting data');
    //     }
    // }

    // public function getAllAdvertsPaginated(int $perPage = 10, array $criteria = []): array
    // {
    //     return [
    //         'adverts' => $this->advertModel->getAllAdvertsPaginated($perPage, $criteria),
    //         'pager'   => $this->advertModel->pager
    //     ];
    // }

    // public function getAdvertByCode(string $code, bool $ofTheLoggedInUser = false)
    // {
    //     $advert = $this->advertModel->getAdvertByCode($code, $ofTheLoggedInUser);

    //     if (is_null($advert)) {

    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Advert not found');
    //     }

    //     return $advert;
    // }

    // public function getCitiesFromPublishedAdverts(int $limit = 5, string $categorySlug = null): array
    // {
    //     return $this->advertModel->getCitiesFromPublishedAdverts($limit, $categorySlug);
    // }


    // public function tryInsertAdvertQuestion(Advert $advert, string $question)
    // {
    //     try {

    //         $this->advertModel->insertAdvertQuestion($advert->id, $question);

    //         session()->remove('ask');

    //         $this->fireAdvertHasNewQuestion($advert);
    //     } catch (\Exception $e) {

    //         log_message('error', '[ERROR] {exception}', ['exception' => $e]);

    //         die('Erro ao realizar a pergunta');
    //     }
    // }

    // public function tryAnswerAdvertQuestion(int $questionID, Advert $advert, object $request)
    // {
    //     try {

    //         $this->advertModel->answerAdvertQuestion(questionID: $questionID, advertID: $advert->id, answer: $request->answer);

    //         $this->fireAdvertQuestionsHasBeenAnswered($advert, $request->question_owner);
    //     } catch (\Exception $e) {

    //         log_message('error', '[ERROR] {exception}', ['exception' => $e]);

    //         die('Erro na resposta da pergunta');
    //     }
    // }


    // public function getAllAdvertsByTerm(string $term = null): array
    // {
    //     $adverts = $this->advertModel->getAllAdvertsByTerm($term);

    //     $data = [];

    //     foreach ($adverts as $advert) {

    //         $data[] = [
    //             'code'  => $advert->code,
    //             'value' => $advert->title,
    //             'label' => $advert->image(classImage: 'image-autocomplete', sizeImage: 'small') . ' ' . $advert->title,
    //         ];
    //     }

    //     return $data;
    // }


    // public function getAllAdvertsForUserAPI(int $perPage = null, int $page = null): array
    // {
    //     $adverts = $this->advertModel->getAllAdvertsForUserAPI($perPage, $page);
    //     $pager = (!empty($adverts) ? $this->advertModel->pager->getDetails() : []);

    //     // O anunciante logado possui algum anúncio?
    //     if (empty($adverts)) {

    //         // Não tem nenhum
    //         return [
    //             'adverts' => [],
    //             'pager'   => $pager
    //         ];
    //     }

    //     $data = [];

    //     foreach ($adverts as $advert) {

    //         $data[] = [
    //             'id'                => $advert->id,
    //             'belongs_to'        => $advert->username,
    //             'images'            => $advert->image(),
    //             'title'             => $advert->title,
    //             'code'              => $advert->code,
    //             'price'             => $advert->price,
    //             'category'          => $advert->category,
    //             'category_id'       => $advert->category_id,
    //             'category_slug'     => $advert->category_slug,
    //             'is_published'      => $advert->is_published,
    //             'address'           => $advert->address(),
    //             'created_at'        => $advert->created_at,
    //             'updated_at'        => $advert->updated_at,
    //         ];
    //     }

    //     return [
    //         'adverts' => $data,
    //         'pager'   => $pager,
    //     ];
    // }

    // ///--------------------Métodos privados-----------------------//


    // private function fireAdvertEvents(Advert $advert, bool $notifyUserIfPublished)
    // {
    //     // Se estiver sendo editado, então o email já possui valor quando da recuperação do mesmo da base.
    //     // Se não tem valor, então estamos criando novo anúncio, portanto, recebe o e-mail do user logado
    //     $advert->email = !empty($advert->email) ? $advert->email : $this->user->email;

    //     if ($advert->hasChanged('title') || $advert->hasChanged('description')) {

    //         Events::trigger('notify_user_advert', $advert->email, "Estamos analisando o seu anúncio {$advert->code}... blaá blá blá...");
    //         Events::trigger('notify_manager', "Existem anúncios para serem auditados... blaá blá blá...");
    //     }

    //     if ($notifyUserIfPublished) {

    //         $this->fireAdvertPublished($advert);
    //     }
    // }


    // private function fireAdvertEventForNewImages(Advert $advert)
    // {
    //     // Se estiver sendo editado, então o email já possui valor quando da recuperação do mesmo da base.
    //     // Se não tem valor, então estamos criando novo anúncio, portanto, recebe o e-mail do user logado
    //     $advert->email = !empty($advert->email) ? $advert->email : $this->user->email;

    //     Events::trigger('notify_user_advert', $advert->email, "Estamos analisando as novas imagens do seu anúncio {$advert->code}... blaá blá blá...");
    //     Events::trigger('notify_manager', "Existem anúncios para serem auditados... Novas imagens foram inseridas... blaá blá blá...");
    // }

    // private function fireAdvertHasNewQuestion(Advert $advert)
    // {
    //     Events::trigger('notify_user_advert', $advert->email, "Se anúncio {$advert->title}... tem uma nova pergunta...");
    // }

    // private function fireAdvertQuestionsHasBeenAnswered(Advert $advert, int $userQuestionID)
    // {
    //     $userWhoAskedQuestion = Factories::class(UserService::class)->getUserByCriteria(['id' => $userQuestionID]);

    //     Events::trigger('notify_user_advert', $userWhoAskedQuestion->email, "A pergunta que você fez para o anúncio {$advert->title} foi respondida...");
    // }


    // private function fireAdvertPublished(Advert $advert)
    // {
    //     if ($advert->weMustNotifyThePublication()) {

    //         Events::trigger('notify_user_advert', $advert->email, "Seu anúncio {$advert->title} foi publicado... blaá blá blá...");
    //     }
    // }
}
