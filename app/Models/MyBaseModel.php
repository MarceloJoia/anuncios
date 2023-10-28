<?php

namespace App\Models;

use CodeIgniter\Model;

class MyBaseModel extends Model
{
    public function __construct()
    {
        parent::__construct(); // Construtor da Model
    }


    /**
     * Escapa dados para inclusão em páginas da web, para ajudar a prevenir ataques XSS. Isso usa a biblioteca Laminas Escaper para lidar com a filtragem real dos dados.  Se $data for uma string, então ele simplesmente escapa e a retorna. 
     * Se $data for um array, então ele faz um loop sobre ele, escapando de cada 'valor' dos pares chave/valor. 
     * Valores de contexto válidos: html, js, css, url, attr,raw
     *
     * @param array $data
     * @return void
     */
    protected function escapeDataXSS(array $data)
    {
        return esc($data);
    }



    /**
     * Permite agrupamentos especiais de registro 
     *
     * @return void
     */
    protected function setSQLModel()
    {
        $this->db->simpleQuery("set session sql_mode=''");
    }
}
