<?php

/**
 * @atenção: Não esquecer de habilitar a nossa classe criada em app\Config\Validation.php
 *
 * @see: https://codeigniter4.github.io/userguide/libraries/validation.html?highlight=validation#creating-custom-rules
 */

namespace App\Validations;

class Customized
{
    /**
     * @param string $error
     */
    public function validate_cpf(string $cpf, string &$error = null): bool
    {
        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (11 != strlen($cpf) || '00000000000' == $cpf || '11111111111' == $cpf || '22222222222' == $cpf || '33333333333' == $cpf || '44444444444' == $cpf || '55555555555' == $cpf || '66666666666' == $cpf || '77777777777' == $cpf || '88888888888' == $cpf || '99999999999' == $cpf) {
            $error = 'Por favor digite um CPF válido';

            return false;
        }

        for ($t = 9; $t < 11; ++$t) {
            for ($d = 0, $c = 0; $c < $t; ++$c) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $error = 'Por favor digite um CPF válido';

                return false;
            }
        }

        return true;
    }

    /**
     * @see https://gist.github.com/boliveirasilva/c927811ff4a7d43a0e0c
     *
     * @param string $error
     */
    public function validate_phone(string $phone, string &$error = null): bool
    {
        $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

        if (false == preg_match($regex, $phone)) {
            // O número não foi validado.
            $error = 'O telefone deve estar no formato: <b>(XX) 9XXXX-XXXX</b>';

            return false;
        }

        // Telefone válido.
        return true;
    }
}
