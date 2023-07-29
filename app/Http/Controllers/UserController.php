<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.users', ['title' => __('trans.users')], ['users' => $users]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.users', ['title' => __('trans.users')], ['users' => $users]);
    }

    public function viewSignUp()
    {
        if (app()->getLocale() == 'en') return view('pages.authentication.boxed.signup', ['title' => 'SignUp']);
        if (app()->getLocale() == 'ar') return view('pages-rtl.authentication.boxed.signup', ['title' => 'SignUp']);
    }

    public function register(UserRequest $request)
    {
        $formFields = $request->all();
        $formFields['password'] = bcrypt($formFields['password']);
        $formFields['is_admin'] = 1;

        $user = User::create($formFields);
        auth()->login($user);

        if (app()->getLocale() == 'en') return redirect('/dashboard');
        if (app()->getLocale() == 'ar') return redirect('/rtl/dashboard');
    }

    public function viewSignIn()
    {
        if (app()->getLocale() == 'en') return view('pages.authentication.boxed.signin', ['title' => 'SignIn']);
        if (app()->getLocale() == 'ar') return view('pages-rtl.authentication.boxed.signin', ['title' => 'SignIn']);
    }

    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $formFields['email'])->first();

        if (auth()->attempt($formFields) && $user->is_admin == 1) {
            $request->session()->regenerate();

            if (app()->getLocale() == 'en') return redirect('/dashboard');
            if (app()->getLocale() == 'ar') return redirect('/rtl/dashboard');
        }

        if ($user->is_admin == 0) {
            return back()->withErrors(['email' => 'This user not authorized'])->onlyInput('email');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (app()->getLocale() == 'en') return redirect('/sign-in');
        if (app()->getLocale() == 'ar') return redirect('/rtl/sign-in');
    }

    public function profile()
    {
        if (app()->getLocale() == 'en') return view('pages.user.profile', ['title' => 'Profile']);
        if (app()->getLocale() == 'ar') return view('pages-rtl.user.profile', ['title' => 'Profile']);
    }

    public function create()
    {
        return view('pages.app.ecommerce.add-user', ['title' => 'Add User']);
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'is_admin' => 'required'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        User::create($formFields);

        return redirect('/users');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if (app()->getLocale() == 'en') return view('pages.app.ecommerce.edit-user', ['title' => __('trans.edit_user')], ['user' => $user]);
        if (app()->getLocale() == 'ar') return view('pages-rtl.app.ecommerce.edit-user', ['title' => __('trans.edit_user')], ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->all();

        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::where('id', $id)->first();

        $user->update($formFields);

        return redirect('/users');
    }

    public function destroy($id)
    {
        User::where('id', $id)->first()->delete();
        return redirect('/users');
    }
}
