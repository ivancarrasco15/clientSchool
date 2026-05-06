<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'clientSchool' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen">
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-slate-900">
                clientSchool
            </a>

            <nav class="flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="text-slate-600 hover:text-slate-900">Registro</a>
                <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-slate-900">Panel</a>
            </nav>
        </div>
    </header>

    @yield('content')
</body>
</html>