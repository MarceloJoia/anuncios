<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Advert extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at', 'user_since'];
    protected $casts   = [
        'is_published'      => 'boolean',
        'adverts'           => '?integer', // pode ou não ser null
        'display_phone'     => 'boolean', // Exibe ou não o Telefone
    ];


    /**
     * Preenche automaticamente a propriedade price [ Metodo Mágico ]
     *
     * @param string $price
     * @return void
     */
    public function setPrice(string $price)
    {
        $this->attributes['price'] = str_replace(',', '', $price);
    }


    /**
     * Esse método será utilizado pelo manager para publicar ou não um anúncio
     *
     * @param string $isPublished
     * @return void
     */
    public function setIsPublished(string $isPublished)
    {
        $this->attributes['is_published'] = $isPublished ? true : false;
    }

    /**
     * Recupera um anuncio arquivado
     *
     * @return void
     */
    public function recover()
    {
        $this->attributes['deleted_at'] = null;
    }


    /**
     * Remove a propriedade address, images antes de manda para o banco de dados
     *
     * @return void
     */
    public function unsetAuxiliaryAttributes()
    {
        //unset($this->attributes['address']);
        unset($this->attributes['images']);
    }


    public function image()
    {
        return 'Imagem';
    }

    public function isPublished()
    {
        return $this->attributes['is_published'] ? '<span class="status-btn active-btn">' . lang('Adverts.text_is_published') . '</span>' :
            '<span class="status-btn close-btn">' . lang('Adverts.text_under_analysis') . '</span>';
    }

    public function address()
    {
        return 'Enereço do anúncio';
    }
}
