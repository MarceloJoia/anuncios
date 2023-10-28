<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Plan extends Entity
{
    private const INTERVAL_MONTHLY          = 1; // MENSAL
    private const INTERVAL_QUARTERLY        = 3; // TRIMESTRE
    private const INTERVAL_SEMESTER         = 6; // SEMESTER
    private const INTERVAL_YEARLY           = 12; // ANUAL


    public const OPTION_MONTHLY          = 'monthly'; // MENSAL
    public const OPTION_QUARTERLY        = 'quarterly'; // TRIMESTRE
    public const OPTION_SEMESTER         = 'semester'; // SEMESTER
    public const OPTION_YEARLY           = 'yearly'; // ANUAL

    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];


    protected $casts   = [
        'plan_id'           => 'integer',
        'adverts'           => '?integer', // pode ou não estar null
        'is_highlighted'    => 'boolean',
    ];


    /**
     * Se existirl algum valor na variável $value remove as ( , ) Virgulas
     *
     * @param string $value
     * @return void
     */
    public function setValue(string $value)
    {
        $this->attributes['value'] = str_replace(',', '', $value);
        return $this;
    }

    /**
     * Se a variável $adverts conter algum valor, converter o valor para (INT)
     *
     * @param string $adverts
     * @return void
     */
    public function setAdverts(string $adverts)
    {
        $this->attributes['adverts'] = $adverts ? (int) $adverts : null;
        return $this;
    }

    /**
     * Se existirl um conteúdo destacado converte em bool
     *
     * @param string $isHighlighted
     * @return void
     */
    public function setIsHighlighted(string $isHighlighted)
    {
        $this->attributes['is_highlighted'] = (bool) $isHighlighted;
        return $this;
    }

    /**
     * Define o formato de recorrencia do plano escolhido
     *
     * @return void
     */
    public function setIntervalRepeats()
    {
        // Gerencianet envia a cobrança para o anunciante até que o plano seja cancelado ($this->repeats = null)
        $this->repeats = null;

        $this->attributes['interval'] = match ($this->attributes['recorrence']) {
            'monthly'          => self::INTERVAL_MONTHLY,
            'quarterly'        => self::INTERVAL_QUARTERLY,
            'semester'         => self::INTERVAL_SEMESTER,
            'yearly'           => self::INTERVAL_YEARLY,
            default            => throw new \InvalidArgumentException("Unsupported {$this->attributes['recorrence']}")
        };

        return $this;
    }


    /**
     * Recupera os planos arquivados
     *
     * @return void
     */
    public function recover()
    {
        $this->attributes['deleted_at'] = null;
    }


    /**
     * Verifica se o plano está destacado
     *
     * @return boolean
     */
    public function isHighlighted()
    {
        return $this->attributes['is_highlighted'] ? lang('Plans.text_is_highlighted') : lang('Plans.text_no_highlighted');
    }


    /**
     * Verifica se existe algum anúncio
     *
     * @return void
     */
    public function adverts()
    {
        return $this->attributes['adverts'] ?? lang('Plans.text_unlimited_adverts');
    }


    public function details()
    {
        /**
         * @todo alterar para exibir conforme o idioma
         */

        return number_to_currency($this->value, 'BRL', 'pt-BR', 2) . ' /' . $this->recorrence;
    }
}
