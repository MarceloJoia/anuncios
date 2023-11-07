<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use App\Validations\Customized; //=> Nossas validações

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        Customized::class, //=> Nossas validações
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];


    // --------------------------------------------------------------------
    // Categories
    // --------------------------------------------------------------------
    public array $category = [
        'id'            => 'permit_empty|is_natural_no_zero',
        'name'          => 'required|min_length[3]|max_length[97]|is_unique[categories.name,id,{id}]',
    ];

    public array $category_errors = [
        'name' => [
            'required'      => 'Categories.name.required',
            'min_length'    => 'Categories.name.min_length',
            'max_length'    => 'Categories.name.max_length',
            'is_unique'     => 'Categories.name.is_unique',
        ],
    ];


    //--------------------------------------------------------------------
    // Plans
    //--------------------------------------------------------------------
    public $plan = [
        'id'            => 'permit_empty|is_natural_no_zero',
        'name'              => 'required|min_length[3]|max_length[99]|is_unique[plans.name,id,{id}]',
        'recorrence'        => 'required|in_list[monthly,quarterly,semester,yearly]',
        'value'             => 'required',
        'description'       => 'required',
    ];

    public $plan_errors = [
        'name' => [
            'required'      => 'Plans.name.required',
            'min_length'    => 'Plans.name.min_length',
            'max_length'    => 'Plans.name.max_length',
            'is_unique'     => 'Plans.name.is_unique',
        ],
        'recorrence' => [
            'in_list'       => 'Plans.recorrence.in_list', // lang() não pode ser colocado aqui... dará erro de sintaxe
        ],
        'value' => [
            'required'      => 'Plans.value.required',
        ],
        'description' => [
            'required'      => 'Plans.description.required',
        ],
    ];




    //--------------------------------------------------------------------
    // Adverts
    //--------------------------------------------------------------------
    public $advert = [
        'id'                => 'permit_empty|is_natural_no_zero',
        'title'             => 'required|min_length[3]|max_length[125]|is_unique[adverts.title,id,{id}]',
        'situation'         => 'required|in_list[new,used]',
        'category_id'       => 'required|is_not_unique[categories.id]',
        'price'             => 'required',
        'description'       => 'required|max_length[5000]',
        'zipcode'           => 'required|exact_length[9]',
        'street'            => 'required|max_length[137]',
        'neighborhood'      => 'required|max_length[137]',
        'city'              => 'required|max_length[137]',
        'state'             => 'required|exact_length[2]',
    ];

    public $advert_errors = [
        'title' => [
            'required'      => 'Adverts.title.required',
            'min_length'    => 'Adverts.title.min_length',
            'max_length'    => 'Adverts.title.max_length',
            'is_unique'     => 'Adverts.title.is_unique',
        ],
        'situation' => [
            'required'     => 'Qual é a situação do produto?',
        ],
        'category_id' => [
            'required' => 'Por favor escolha a Categoria',
        ],
        'price' => [
            'required' => 'Digite um valor para o produto',
        ],
        'description' => [
            'required' => 'O produto precisa de uma descrição',
        ],
    ];


    public $advert_images = [
        'images' => [
            'uploaded[images]',
            'is_image[images]',
            'mime_in[images,image/jpg,image/jpeg,image/png,image/webp]',
            'max_size[images,2048]',
            'max_dims[images,1920,1080]', //Tamanho maximo: 1920 Tamanho mínimo:1080
        ],
    ];

    // Podemos traduzir as mensagens de erro aqui!
    public $advert_images_error = [];



    //--------------------------------------------------------------------
    // User
    //--------------------------------------------------------------------
    public $user_profile = [
        'id'                => 'permit_empty|is_natural_no_zero',
        'name'              => 'required|min_length[2]|max_length[47]',
        'last_name'         => 'required|min_length[2]|max_length[47]',
        'email'             => 'required|valid_email|min_length[5]|max_length[240]|is_unique[users.email,id,{id}]',
        'cpf'               => 'required|validate_cpf|is_unique[users.cpf,id,{id}]',
        'phone'             => 'required|validate_phone|exact_length[15]|is_unique[users.phone,id,{id}]',
        'birth'             => 'required',
    ];

    public $user_profile_errors = [];
}
