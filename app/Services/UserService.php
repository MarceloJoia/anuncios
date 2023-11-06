<?php

namespace App\Services;

use App\Models\UserModel;
use CodeIgniter\Config\Factories;
use Fluent\Auth\Facades\Hash;

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


    // public function tryUpdateProfile(array $request)
    // {

    //     try {

    //         $request = (object) $request;

    //         $this->user->name               =     $request->name;
    //         $this->user->last_name          =     $request->last_name;
    //         $this->user->cpf                =     $request->cpf;
    //         $this->user->email              =     $request->email;
    //         $this->user->phone              =     $request->phone;
    //         $this->user->birth              =     $request->birth;
    //         $this->user->display_phone      =     $request->display_phone;

    //         if ($this->user->hasChanged()) {

    //             $this->userModel->save($this->user);
    //         }
    //     } catch (\Exception $e) {

    //         die('Não foi possível atualizar o perfil');
    //     }
    // }


    // public function currentPasswordIsValid(string $currentPassword): bool
    // {
    //     return Hash::check($currentPassword, $this->user->password);
    // }


    // public function tryUpdateAccess(string $newPassword)
    // {

    //     try {

    //         $this->user->password = $newPassword;

    //         if ($this->user->hasChanged()) {

    //             $this->userModel->save($this->user);
    //         }
    //     } catch (\Exception $e) {

    //         die('Não foi possível atualizar o seu acesso');
    //     }
    // }


    // public function deleteUserAccount()
    // {

    //     try {

    //         $gerencianetService = Factories::class(GerencianetService::class);

    //         // User tem assinatura?
    //         if ($gerencianetService->userHasSubscription()) {

    //             /// Sim... então removemos na gerencianet também
    //             $gerencianetService->cancelSubscription();
    //         }

    //         // Removemos da nossa base
    //         $this->userModel->deleteUserAccount();

    //         // Destruímos a sessão
    //         service('auth')->logout();
    //     } catch (\Exception $e) {

    //         die('Não foi possível atualizar o seu acesso');
    //     }
    // }


    // public function getUserByCriteria(array $criteria = [])
    // {

    //     $user = $this->userModel->getUserByCriteria($criteria);

    //     if (is_null($user)) {

    //         throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('User Not Found');
    //     }

    //     return $user;
    // }
}
