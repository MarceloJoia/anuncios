<?php

namespace App\Requests;

class GerencianetRequest extends MyBaseRequest
{
    public function validateBeforeSave(string $paymentMethod, bool $respondWithRedirect = false)
    {
        $this->validate($this->setRuleGroup($paymentMethod), $respondWithRedirect);
    }


    private function setRuleGroup(string $paymentMethod)
    {
        return $paymentMethod == 'billet' ? 'gerencianet_billet' : 'gerencianet_credit';
    }
}
