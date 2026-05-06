<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME', 'clientSchool') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
            <div>
                <p class="text-xs uppercase tracking-[0.25em] text-slate-500">Laravel client</p>
                <h1 class="text-2xl font-bold text-slate-900">{{ env('APP_NAME', 'clientSchool') }}</h1>
            </div>

            <nav class="flex items-center gap-2">
                @if(session('client_user'))
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                    <x-nav-link :href="route('teachers.index')" :active="request()->routeIs('teachers.*')">Teachers</x-nav-link>
                    <x-nav-link :href="route('students.index')" :active="request()->routeIs('students.*')">Students</x-nav-link>
                    <x-nav-link :href="route('subjects.index')" :active="request()->routeIs('subjects.*')">Subjects</x-nav-link>
                    <form action="{{ route('logout') }}" method="POST" class="ml-2">
                        @csrf
                        <button type="submit" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            Logout
                        </button>
                    </form>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">Login</x-nav-link>
                @endif
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @include('partials.flash')
        {{ $slot }}
    </main>
</body>
</html>
