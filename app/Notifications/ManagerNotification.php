<?php

namespace App\Notifications;

use CodeIgniter\Config\Services;
use CodeIgniter\Email\Email;
use CodeIgniter\I18n\Time;

class ManagerNotification
{
    /** @var string */
    protected $message;

    /** @var Email */
    protected $service;

    /**
     * Instance verification notification.
     */
    public function __construct(string $message)
    {
        $this->message   = $message;
        $this->service = Services::email();
    }

    /**
     * SNotifica o usuário manager para verificar se possíveis anúnios e/ou atualização dos anúncios
     *
     * @return bool
     */
    public function send()
    {
        $this->service->setFrom('no-reply@vemprobairro.com.br', env('APP_NAME'));
        $this->service->setTo(get_superadmin()->email);
        $this->service->setSubject(env('APP_NAME'));
        $this->service->setMessage($this->message);
        $this->service->setMailType('html');

        if (!$this->service->send()) {
            log_message('error', $this->service->printDebugger());
            return false;
        }

        return true;
    }
}
