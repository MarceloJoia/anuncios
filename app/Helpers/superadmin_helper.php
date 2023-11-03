<?php

use App\Models\UserModel;
use CodeIgniter\Config\Factories;

if (!function_exists('get_superadmin')) {

    // Retorna o superAdmin
    function get_superadmin()
    {
        return Factories::models(UserModel::class)->getSuperadmin();
    }
}
