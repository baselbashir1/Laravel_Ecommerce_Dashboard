<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::find($id);
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getLastUser()
    {
        return User::latest()->first();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(array $data, $id)
    {
        return User::whereId($id)->update($data);
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }
}
