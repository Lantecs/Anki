<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;


class AuthManager extends Controller
{
    function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }

        return view('auth/login');

    }

    function register()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('auth/register');
    }



    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // $token = $user->createToken($user->email)->plainTextToken;

            return redirect()->intended(route('home'));

        }

        return redirect(route('login'))->with("error", "Login details are not valid");
    }

    function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            // Return the validation errors along with the modal flag
            return redirect(route('register'))
                ->withErrors($validator)
                ->withInput()
                ->with("error", "Registration failed, try again.");
        }

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_token' => Str::random(40),
        ];

        $user = User::create($data);

        if (!$user) {
            return redirect(route('register'))->with("error", "Registration failed, try again.");
        }

        // Mail::send("emails.verify_email", ['token' => $data['verification_token']], function ($message) use ($request) {
        //     $message->to($request->email);
        //     $message->subject("Verify Email");
        // });

        return redirect(route('login'))->with("success", "Registration Success! We have sent a link to verify your email.");
    }

    function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $request->session()->regenerateToken();
        $request->session()->invalidate();
        Session::flush();
        Auth::logout();

        return redirect(route('login'));
    }

}
