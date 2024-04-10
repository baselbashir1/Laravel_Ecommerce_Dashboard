<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use Exception;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.users', ['title' => __('trans.users')], ['users' => $users]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.users', ['title' => __('trans.users')], ['users' => $users]);
    }

    public function viewSignUp()
    {
        if (app()->getLocale() == 'en')
            return view('pages.authentication.boxed.signup', ['title' => 'SignUp']);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.authentication.boxed.signup', ['title' => 'SignUp']);
    }

    public function register(UserRequest $request)
    {
        try {
            $this->userService->register($request);

            if (app()->getLocale() == 'en')
                return redirect('/dashboard');
            if (app()->getLocale() == 'ar')
                return redirect('/rtl/dashboard');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function viewSignIn()
    {
        if (app()->getLocale() == 'en')
            return view('pages.authentication.boxed.signin', ['title' => 'SignIn']);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.authentication.boxed.signin', ['title' => 'SignIn']);
    }

    public function login(Request $request)
    {
        try {
            $formFields = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user =$this->userService->getUserByEmail($formFields['email']);

            if (auth()->attempt($formFields) && $user->is_admin == 1) {
                $request->session()->regenerate();

                if (app()->getLocale() == 'en')
                    return redirect('/dashboard');
                if (app()->getLocale() == 'ar')
                    return redirect('/rtl/dashboard');
            }

            if ($user->is_admin == 0) {
                return back()->withErrors(['email' => 'This user not authorized'])->onlyInput('email');
            }

            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->userService->logout($request);

            if (app()->getLocale() == 'en')
                return redirect('/sign-in');
            if (app()->getLocale() == 'ar')
                return redirect('/rtl/sign-in');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function profile()
    {
        if (app()->getLocale() == 'en')
            return view('pages.user.profile', ['title' => 'Profile']);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.user.profile', ['title' => 'Profile']);
    }

    public function create()
    {
        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.add-user', ['title' => __('trans.add_user')]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.add-user', ['title' => __('trans.add_user')]);
    }

    public function store(Request $request)
    {
        try {
            $this->userService->store($request);
            return redirect('/users');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        if (app()->getLocale() == 'en')
            return view('pages.app.ecommerce.edit-user', ['title' => __('trans.edit_user')], ['user' => $user]);
        if (app()->getLocale() == 'ar')
            return view('pages-rtl.app.ecommerce.edit-user', ['title' => __('trans.edit_user')], ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->userService->update($request, $id);
            return redirect('/users');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userService->destroy($id);
            return redirect('/users');
        } catch (Exception $e) {
            return back()->withException($e);
        }
    }
}
