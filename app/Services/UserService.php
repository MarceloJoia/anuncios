<?php

namespace App\Services;

use App\Models\UserModel;
use CodeIgniter\Config\Factories;


class UserService
{
    private $userModel;
    private $user;

    public function __construct()
    {
        $this->userModel = Factories::models(UserModel::class);
        $this->user      = service('auth')->user();
    }


    public function userDataIsComplete(): bool
    {
        if (
            is_null($this->user->name) ||
            is_null($this->user->last_name) ||
            is_null($this->user->cpf) ||
            is_null($this->user->birth) ||
            is_null($this->user->phone)
        ) {
            return false;
        }

        return true;
    }


    public function tryUpdateProfile(array $request)
    {
        try {
            $request = (object) $request;

            $this->user->name               =     $request->name;
            $this->user->last_name          =     $request->last_name;
            $this->user->cpf                =     $request->cpf;
            $this->user->email              =     $request->email;
            $this->user->phone              =     $request->phone;
            $this->user->birth              =     $request->birth;
            $this->user->display_phone      =     $request->display_phone;

            // dd($this->user);

            if ($this->user->hasChanged()) {
                $this->userModel->save($this->user);
            }
        } catch (\Exception $e) {

            log_message('error', '[ERROR] {exception}', ['exception' => $e]);

            die('Não foi possível atualizar o perfil');
        }
    }

}
