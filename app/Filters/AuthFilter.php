<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use \Fluent\Auth\Filters\AuthenticationFilter;

class AuthFilter extends AuthenticationFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        return $this->authenticate($request, $arguments);
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }



    protected function authenticate($request, $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        // Usaremos para redirecionar o user para a página de compra após user logar,
        // e caso necessário, após o user verificar o seu e-mail
        if (url_is('choice*')) {
            session()->set('choice', current_url());
        }

        // // Foi clicado no botão 'Perguntar' e estava logado?
        // if (url_is('toask*')) {

        //     session()->set('details', previous_url()); // aqui é previous_url
        //     session()->set('ask', $request->getPost('ask')); // setamos na sessão a pergunta para podermos colocá-la novamente no input do form depois de logar
        // }

        return $this->unauthenticated($request, $guards);
    }





    protected function unauthenticated($request, $guards)
    {
        if ($request->isAJAX()) {
            return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        }

        // if (url_is('api/adverts*')) {

        //     return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        // }

        // if (url_is('api/dashboard*')) {

        //     return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        // }

        // if (in_array('api', $guards)) {

        //     return $this->fail('Unauthenticated.', ResponseInterface::HTTP_UNAUTHORIZED);
        // }

        return redirect()->route('login');
    }
}
