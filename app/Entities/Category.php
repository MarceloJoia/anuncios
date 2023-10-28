<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Category extends Entity
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Seta o atributo NULL em um registro tornado o mesmo disponível para ser utilizado pelo usuário
     *
     * @return void
     */
    public function recover()
    {
        $this->attributes['deleted_at'] = null;
    }
}
