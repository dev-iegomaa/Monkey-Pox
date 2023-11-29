<?php

namespace App\Http\Traits\User;

trait UserTrait
{
    private function getUsers()
    {
        return $this->userModel::get(['id', 'name', 'email']);
    }

    private function findUser($user_id)
    {
        return $this->userModel::find($user_id);
    }
}
