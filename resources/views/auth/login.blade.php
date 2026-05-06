@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-73px)] flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">
            Iniciar sesión
        </h1>

        <p class="text-slate-500 mb-8">
            Accede al cliente de la escuela con tu cuenta.
        </p>

        <form action="#" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                    Correo electrónico
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="usuario@clientschool.test"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-500"
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                    Contraseña
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-500"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-slate-900 hover:bg-black text-white font-semibold rounded-xl px-4 py-3 transition"
            >
                Entrar
            </button>
        </form>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-200"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-3 text-sm text-slate-400">o continuar con</span>
            </div>
        </div>

        <div class="space-y-3">
            <button
                type="button"
                class="w-full border border-slate-300 rounded-xl px-4 py-3 font-medium hover:bg-slate-50 flex items-center justify-center gap-3"
            >
                <svg class="w-5 h-5" viewBox="0 0 48 48" aria-hidden="true">
                    <path fill="#FFC107" d="M43.6 20.5H42V20H24v8h11.3C33.6 32.7 29.2 36 24 36c-6.6 0-12-5.4-12-12S17.4 12 24 12c3 0 5.7 1.1 7.8 3l5.7-5.7C34 6.1 29.3 4 24 4 12.9 4 4 12.9 4 24s8.9 20 20 20 20-8.9 20-20c0-1.3-.1-2.4-.4-3.5z"/>
                    <path fill="#FF3D00" d="M6.3 14.7l6.6 4.8C14.7 15 18.9 12 24 12c3 0 5.7 1.1 7.8 3l5.7-5.7C34 6.1 29.3 4 24 4c-7.7 0-14.3 4.3-17.7 10.7z"/>
                    <path fill="#4CAF50" d="M24 44c5.2 0 9.9-2 13.4-5.2l-6.2-5.2C29.2 35.1 26.7 36 24 36c-5.2 0-9.6-3.3-11.3-8l-6.5 5C9.5 39.5 16.2 44 24 44z"/>
                    <path fill="#1976D2" d="M43.6 20.5H42V20H24v8h11.3c-1.1 3.1-3.3 5.5-6.1 7l6.2 5.2C39 36.9 44 31 44 24c0-1.3-.1-2.4-.4-3.5z"/>
                </svg>
                Continuar con Google
            </button>

            <button
                type="button"
                class="w-full border border-slate-300 rounded-xl px-4 py-3 font-medium hover:bg-slate-50 flex items-center justify-center gap-3"
            >
                <svg class="w-5 h-5 fill-current text-slate-900" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 .5C5.6.5.5 5.7.5 12.2c0 5.2 3.4 9.6 8.1 11.1.6.1.8-.3.8-.6v-2.1c-3.3.7-4-1.4-4-1.4-.5-1.4-1.3-1.8-1.3-1.8-1.1-.8.1-.8.1-.8 1.2.1 1.9 1.3 1.9 1.3 1.1 1.9 2.9 1.4 3.6 1.1.1-.8.4-1.4.8-1.7-2.7-.3-5.5-1.4-5.5-6.1 0-1.3.5-2.5 1.3-3.4-.1-.3-.6-1.6.1-3.2 0 0 1.1-.4 3.5 1.3 1-.3 2.1-.4 3.2-.4s2.2.1 3.2.4c2.4-1.7 3.5-1.3 3.5-1.3.7 1.6.2 2.9.1 3.2.8.9 1.3 2.1 1.3 3.4 0 4.7-2.8 5.7-5.5 6.1.4.4.9 1.1.9 2.3v3.4c0 .3.2.7.8.6 4.7-1.6 8.1-6 8.1-11.1C23.5 5.7 18.4.5 12 .5z"/>
                </svg>
                Continuar con GitHub
            </button>

            <button
                type="button"
                class="w-full border border-slate-300 rounded-xl px-4 py-3 font-medium hover:bg-slate-50 flex items-center justify-center gap-3"
            >
                <svg class="w-5 h-5" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="#7FBA00" d="M2 2h9v9H2z"/>
                    <path fill="#F25022" d="M13 2h9v9h-9z"/>
                    <path fill="#00A4EF" d="M2 13h9v9H2z"/>
                    <path fill="#FFB900" d="M13 13h9v9h-9z"/>
                </svg>
                Continuar con Microsoft
            </button>

            <button
                type="button"
                class="w-full border border-slate-300 rounded-xl px-4 py-3 font-medium hover:bg-slate-50 flex items-center justify-center gap-3"
            >
                <svg class="w-5 h-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M4 12a8 8 0 0 1 8-8"/>
                    <path d="M20 12a8 8 0 0 1-8 8"/>
                    <path d="M12 4a8 8 0 0 1 8 8"/>
                    <path d="M12 20a8 8 0 0 1-8-8"/>
                </svg>
                Continuar con OAuth
            </button>
        </div>

        <p class="text-sm text-slate-500 mt-6 text-center">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="font-semibold text-slate-900 hover:underline">
                Crear cuenta
            </a>
        </p>
    </div>
</div>
@endsection