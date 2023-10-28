<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Entities\Category;
use App\Requests\CategoryRequest;
use App\Services\CategoryService;
use CodeIgniter\Config\Factories;

class CategoriesController extends BaseController
{

    private $categoryService;
    private $categoryRequest;

    public function __construct()
    {
        $this->categoryService = Factories::class(CategoryService::class);
        $this->categoryRequest = Factories::class(CategoryRequest::class);
    }


    public function index()
    {
        $data = [
            'title' => 'Categorias',
        ];
        return view('Manager/Categories/index', $data);
    }

    /**
     * Recupara as categorias arquivadas
     *
     * @return void
     */
    public function archived()
    {
        $data = [
            'title' => 'Categorias arquivadas'
        ];

        return view('Manager/Categories/archived', $data);
    }


    public function getAllCategories()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['data' => $this->categoryService->getAllCategories()]);
    }


    public function getAllArchivedCategories()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        return $this->response->setJSON(['data' => $this->categoryService->getAllArchivedCategories()]);
    }


    public function getCategoryInfo()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // exit($this->request->getGet('id'));

        $category = $this->categoryService->getCategory($this->request->getGetPost('id'));

        $options = [
            'class'         => 'form-control',
            'placeholder'   => lang('Categories.label_choose_category'),
            'selected'      => !(empty($category->parent_id)) ? $category->parent_id : ""
        ];

        $response = [
            'category' => $category,
            'parents'  => $this->categoryService->getMultinivel('parent_id', $options, $category->id)
        ];

        return $this->response->setJSON($response);
    }


    public function create()
    {
        $this->categoryRequest->validateBeforeSave('category'); //Valida o formulário. Se não validar mata o processo.

        $category = new Category($this->removeSpoofingFromRequest()); //=> Remove da requisição o _method

        $this->categoryService->trySaveCategory($category); //=> Salvar as alterações na categoria

        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_saved'))); //=> Retorna a mensagem de sucesso
    }

    public function update()
    {
        $this->categoryRequest->validateBeforeSave('category'); //Valida o formulário. Se não validar mata o processo.
        $category = $this->categoryService->getCategory($this->request->getGetPost('id')); //  Recuperar a categoria 
        $category->fill($this->removeSpoofingFromRequest()); //=> Remove da requisição o _method
        $this->categoryService->trySaveCategory($category); //=> Salvar as alterações na categoria
        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_saved'))); //=> Retorna a mensagem de sucesso
    }


    public function archive()
    {
        $this->categoryService->tryArchiveCategory($this->request->getGetPost('id'));

        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_archived')));
    }


    public function getDropdownParents()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $options = [
            'class'         => 'form-control',
            'placeholder'   => lang('Categories.label_choose_category'),
            'selected'      => "" // estamos criando uma categoria
        ];

        $response = [
            'parents'  => $this->categoryService->getMultinivel('parent_id', $options)
        ];

        return $this->response->setJSON($response);
    }

    
    /**
     * Chama o metodo [tryRecoverCategory($id)] que retorna o campo alterado para NULL.
     * Devolve em formato Json uma mensagem
     *
     * @return void
     */
    public function recover()
    {
        $this->categoryService->tryRecoverCategory($this->request->getGetPost('id'));

        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_archived')));
    }


    /**
     * Chama o método [ tryDeleteCategory($id) ], passando o ID da categoria a ser Deletada. Se existir a Categoria estiver Arquivada, Deleta a mesma e retorna uma mensagem de sucesso, caso ocorra algum erro retorna uma mensagem de ERROR.
     *
     * @return void
     */
    public function delete()
    {
        $this->categoryService->tryDeleteCategory($this->request->getGetPost('id'));

        return $this->response->setJSON($this->categoryRequest->respondWithMessage(message: lang('App.success_deleted')));
    }

}
