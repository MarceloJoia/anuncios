<?php

namespace App\Services;

use App\Entities\Category;
use App\Models\CategoryModel;
use CodeIgniter\Config\Factories;

class CategoryService
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = Factories::models(CategoryModel::class);
    }



    /**
     * Faz uma busca no banco de dados por Categories e tetorna um ARRAY de categorias.
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        $categories = $this->categoryModel->asObject()->orderBy('id', 'DESC')->findAll();

        $data = [];
        foreach ($categories as $category) {

            $btnEdit = form_button(
                [
                    'data-id' => $category->id,
                    'id' => 'updateCategoryBtn', //ID do HTML element
                    'class' => 'btn btn-primary btn-sm'
                ],
                '<i class="bi bi-pencil-square"></i>&nbsp;' . lang('App.btn_edit')
            );

            $btnArchive = form_button(
                [
                    'data-id' => $category->id,
                    'id' => 'archiveCategoryBtn', //ID do HTML element
                    'class' => 'btn btn-warning btn-sm'
                ],
                '<i class="bi bi-archive-fill"></i>&nbsp;'  . lang('App.btn_archive')
            );
            $data[] = [
                'id'        => $category->id,
                'name'      => $category->name,
                'slug'      => $category->slug,
                'actions'   => $btnEdit . ' ' . $btnArchive,
            ];
        }

        return $data;
    }


    /**
     * Recupera todas as Categorias arquivadas
     *
     * @return array
     */
    public function getAllArchivedCategories(): array
    {
        $categories = $this->categoryModel->asObject()->onlyDeleted()->orderBy('id', 'DESC')->findAll();

        $data = [];

        foreach ($categories as $category) {


            $btnRecover = form_button(
                [
                    'data-id' => $category->id,
                    'id'      => 'recoverCategoryBtn', // ID do html element
                    'class'   => 'btn btn-success btn-sm'
                ],
                '<i class="bi bi-recycle"></i>&nbsp;' . lang('App.btn_recover')
            );


            $btnDelete = form_button(
                [
                    'data-id' => $category->id,
                    'id'      => 'deleteCategoryBtn', // ID do html element
                    'class'   => 'btn btn-danger btn-sm'
                ],
                '<i class="bi bi-trash3"></i>&nbsp;' . lang('App.btn_delete')
            );



            $data[] = [
                'id'        => $category->id,
                'name'      => $category->name,
                'slug'      => $category->slug,
                'actions'   => $btnRecover . ' ' . $btnDelete,
            ];
        }

        return $data;
    }




    /**
     * Recupera a categoria de acordo com o ID 
     *
     * @param integer $id 
     * @param boolean $withDeleted 
     * @throws Exception  
     * @return null|Category 
     */
    public function getCategory(int $id, bool $withDeleted = false)
    {
        $category = $this->categoryModel->withDeleted($withDeleted)->find($id);

        if (is_null($category)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Category not found');
        }

        return $category;
    }



    public function getMultinivel(string $name, $options = [], int $exceptCategoryID = null)
    {
        $array = $this->categoryModel->getParentCategories($exceptCategoryID);

        $class_form = "";
        if (isset($options['class'])) {
            $class_form = $options['class'];
        }

        $selected = [];


        if (isset($options['selected'])) {
            $selected = is_array($options['selected']) ? $options['selected'] : [$options['selected']];
        }

        if (isset($options['placeholder'])) {
            $placeholder = [
                'id' => '',
                'name' => $options['placeholder'],
                'parent_id' => 0
            ];
            $array[] = $placeholder;
        }

        $multiple = '';
        if (isset($options['multiple'])) {
            $multiple = 'multiple';
        }

        $select = '<select class="' . $class_form . '" name="' . $name . '" ' . $multiple . '>';
        $select .= $this->getMultiLevelOptions($array, 0, [], $selected);
        $select .= '</select>';

        return $select;
    }

    public function getMultiLevelOptions(array $array, $parent_id = 0, $parents = [], $selected = [])
    {
        static $i = 0;
        if ($parent_id == 0) {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'], $parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }

        $menu_html = '';
        foreach ($array as $element) {
            $selected_item = '';
            if ($element['parent_id'] == $parent_id) {
                if (in_array($element['id'], $selected)) {
                    $selected_item = 'selected';
                }
                $menu_html .= '<option value="' . $element['id'] . '" ' . $selected_item . '>';
                for ($j = 0; $j < $i; $j++) {
                    $menu_html .= '&mdash; ';
                }
                $menu_html .= $element['name'] . '</option>';
                if (in_array($element['id'], $parents)) {
                    $i++;
                    $menu_html .= $this->getMultilevelOptions($array, $element['id'], $parents, $selected);
                }
            }
        }

        $i--;
        return $menu_html;
    }



    public function trySaveCategory(Category $category, bool $protect = true)
    {
        try {
            if ($category->hasChanged()) {
                $this->categoryModel->protect($protect)->save($category);
            }
        } catch (\Exception $e) {
            die('Erro ao salvar os dados!');
            // die($e->getMessage());
        }
    }


    public function tryArchiveCategory(int $id)
    {
        try {
            $category = $this->getCategory($id);

            $this->categoryModel->delete($category->id);
        } catch (\Exception $e) {
            die('Erro ao arquivar a categoria!');
            // die($e->getMessage());
        }
    }


    /**
     * Recebe o ID da Categoria. 
     * Executa uma consulta na tabela [categories] no campo [deleted_at]. Se o campo tiver a data, chama o método [recover()] e Seta NULL.
     * Se encontrar algum erro retorna uma mensagem de ERROR
     *
     * @param integer $id
     * @return void
     */
    public function tryRecoverCategory(int $id)
    {
        try {
            $category = $this->getCategory($id, withDeleted: true);
            $category->recover();
            $this->trySaveCategory($category, protect: false);
        } catch (\Exception $e) {
            die('Não foi possível recuperar a Categoria.');
            // die($e->getMessage());
        }
    }


    /**
     * Faz um Search em um ID espessífico e retorna uma Categoria Arquivada, na sequencia Deleta essa categoria se existir. Se não retorna uma mensagem de ERROR. 
     * [ purge ] Sobre escreve o Sofdelete, Deletando de maneira definitiva o Arquivo
     *
     * @param integer $id
     * @return void
     */
    public function tryDeleteCategory(int $id)
    {
        try {
            $category = $this->getCategory($id, withDeleted: true);
            $this->categoryModel->delete($category->id, purge: true);
        } catch (\Exception $e) {

            die('Erro aou deletar a categoria');
            // die($e->getMessage());
        }
    }
}
