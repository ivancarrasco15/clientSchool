<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View|RedirectResponse
    {
        if (session()->has('client_user')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Introduce un email válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $validator->validated();

        $expectedEmail = env('CLIENT_AUTH_EMAIL', 'admin@school.test');
        $expectedPassword = env('CLIENT_AUTH_PASSWORD', '1234');
        $displayName = env('CLIENT_AUTH_NAME', 'Iván Carrasco');

        if (
            $credentials['email'] !== $expectedEmail ||
            $credentials['password'] !== $expectedPassword
        ) {
            return back()
                ->withInput(['email' => $credentials['email']])
                ->with('error', 'Credenciales incorrectas.');
        }

        session([
            'client_user' => [
                'name' => $displayName,
                'email' => $credentials['email'],
            ],
        ]);
        session()->save();

        return redirect()->route('dashboard')->with('success', 'Sesión iniciada correctamente.');
    }

    public function logout(): RedirectResponse
    {
        session()->forget(['client_user']);
        session()->save();

        return redirect()->route('login')->with('success', 'Has cerrado sesión.');
    }
}
