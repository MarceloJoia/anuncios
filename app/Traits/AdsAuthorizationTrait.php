<?php

namespace App\Traits;

use Fluent\Auth\Config\Services;

trait AdsAuthorizationTrait
{

    public function isSuperadmin(): bool
    {
        $builder = Services::auth()
            ->getProvider()
            ->instance()
            ->join('superadmins', 'superadmins.user_id = users.id')
            ->where('superadmins.user_id', $this->id);

        return $builder->first() !== null;
    }
}
