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


    /**
     * Método que retorna a imagem ou caminho conforme se fizer necessário
     *
     * @param string $classImage
     * @param string $sizeImage
     * @return mixed
     */
    public function image(string $classImage = '', string $sizeImage = 'regular')
    {
        if (empty($this->attributes['images'])) {
            return $this->handleWithEmptyImage($classImage);
        }

        if (is_string($this->attributes['images'])) {
            return $this->handleWithSingleImage($classImage, $sizeImage);
        }

        if (url_is('api/adverts*')) {
            return $this->handleWithImagesForAPI();
        }
    }



    public function isPublished()
    {
        return $this->attributes['is_published'] ? '<span class="status-btn active-btn">' . lang('Adverts.text_is_published') . '</span>' :
            '<span class="status-btn close-btn">' . lang('Adverts.text_under_analysis') . '</span>';
    }


    /**
     * Retorna o endereço formatado
     *
     * @return void
     */
    public function address()
    {
        $number = !empty($this->attributes['number']) ? $this->attributes['number'] : 'N/A';
        return "{$this->attributes['street']} Nº {$number}, {$this->attributes['neighborhood']} CEP: {$this->attributes['zipcode']} - {$this->attributes['city']}/{$this->attributes['state']}";
    }



    /////////////////////  Métodos privados /////////////////////////

    /**
     * Retorna a no-image
     *
     * @param string $classImage
     * @return string
     */
    private function handleWithEmptyImage(string $classImage): string
    {
        if (url_is('api/adverts*')) {
            return site_url('image/advert-no-image.png');
        }

        return img(
            [
                'src'       => route_to('web.image', 'advert-no-image.png', 'regular'),
                'alt'       => 'No image yet',
                'title'     => 'No image yet',
                'class'     => $classImage,
            ]
        );
    }


    /**
     * Retorna uma imagem e seus atributos
     *
     * @param string $classImage
     * @param string $sizeImage
     * @return string
     */
    private function handleWithSingleImage(string $classImage, string $sizeImage): string
    {
        if (url_is('api/adverts*')) {
            return $this->buildRouteForImageAPI($this->attributes['images']);
        }

        return img(
            [
                'src'       => route_to('web.image', $this->attributes['images'], $sizeImage),
                'alt'       => $this->attributes['title'],
                'title'     => $this->attributes['title'],
                'class'     => $classImage,
            ]
        );
    }


    /**
     * Retorna um Array de imagem
     *
     * @return array
     */
    private function handleWithImagesForAPI(): array
    {
        $images = [];

        foreach ($this->attributes['images'] as $image) {
            $images[] = $this->buildRouteForImageAPI($image->image);
        }

        return $images;
    }


    private function buildRouteForImageAPI(string $image): string
    {
        return route_to('web.image', $image, 'small');
    }
}
