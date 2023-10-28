<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;


    /** @var mixed $locale  Recebe o Idioma que está sendo recebido pelo Navegador */
    protected $locale;


    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'number'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->setUpLanguageOptions($request);
    }

    protected function removeSpoofingFromRequest(): array
    {
        $data = $this->request->getPost();
        // garantimos o id nunca seja enviado no request, pois usamos ess método para fazer o preenchimento das propriedades dos objetos
        // quando precisamos do id utilizamos o $this->request->getGetPost('id') diretamente
        // Dessa forma garantimos que ao criar um registro não correremos o risco de atualizar algum registro
        // pois utilizamos o método model->save() que avalia se existe no $data uma posição 'id' e opera (insert ou update) de acordo com isso
        unset($data['id']);
        unset($data['_method']);

        return $data;
    }

    private function setUpLanguageOptions($request)
    {
        $this->locale = $request->getLocale();

        $view = service('renderer');
        $view->setVar('locale', $this->locale);

        $view->setVar('urls', (object) $this->getUrls($request));

        helper('html');

        $language = match ($this->locale) {
            'en'        => img('language/english.png') . ' English',
            'es'        => img('language/espanha.png') . ' Españhol',
            default     => img('language/brasil.png') . ' Português Brasil',
        };

        $view->setVar('language', $language);
    }


    /**
     * Retorna um objeto contendo as URL's atuais referentes aos idiomas suportados
     *
     * @param RequestInterface $request
     * @return object
     */
    private function getUrls(RequestInterface $request): object
    {
 
        // Criamos as opções de URL para os idiomas suportados
        return (object) [
            'url_en'    => $this->getLanguageUrl($request, 'en'),
            'url_es'    => $this->getLanguageUrl($request, 'es'),
            'url_pt_br' => $this->getLanguageUrl($request, 'pt-BR'),
        ];
    }

    /**
     * Controe a URL atual com o suporte ao idioma fornecido
     *
     * @param RequestInterface $request
     * @param string $idioma
     * @return string retorna algo como: "https://anuncios-marcelo-joia.test/pt-BR/manager/categories"
     */
    private function getLanguageUrl(RequestInterface $request, string $idioma): string
    {

        $request->uri->setSegment(1, $idioma);
        return $request->uri->getBaseURL() . implode('/', $request->uri->getSegments());
    }

}
