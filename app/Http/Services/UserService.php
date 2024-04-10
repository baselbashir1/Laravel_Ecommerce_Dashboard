<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Http\Request;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function getUserByEmail($email)
    {
        return $this->userRepository->getUserByEmail($email);
    }

    public function register(UserRequest $request)
    {
        try {
            $formFields = $request->all();
            $formFields['password'] = bcrypt($formFields['password']);
            $formFields['is_admin'] = 1;

            $user = $this->userRepository->createUser($formFields);
            auth()->login($user);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function logout(Request $request)
    {
        try {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function store(Request $request)
    {
        try {
            $formFields = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'is_admin' => 'required'
            ]);

            $formFields['password'] = bcrypt($formFields['password']);
            $this->userRepository->createUser($formFields);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function edit($id)
    {
        $user = $this->userRepository->getUserById($id);
        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.edit-user', ['title' => __('trans.edit_user')], ['user' => $user]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.edit-user', ['title' => __('trans.edit_user')], ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        try {
            $formFields = $request->all();

            $formFields['password'] = bcrypt($formFields['password']);
            $user = $this->userRepository->getUserById($id);

            $user->update($formFields);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->deleteUser($id);
        } catch (Exception $e) {
            throw $e;
        }
    }
}
