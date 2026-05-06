@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Profesores</h1>
            <p class="text-slate-500 mt-2">Gestión de profesores del cliente Laravel.</p>
        </div>

        <a href="{{ route('teachers.create') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black transition">
            Crear profesor
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-8">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Buscar por ID</h2>

        <form method="GET" action="{{ route('teachers.index') }}" class="flex flex-col md:flex-row gap-4">
            <input
                type="number"
                name="search_id"
                value="{{ $searchId }}"
                placeholder="Introduce un ID"
                class="w-full md:w-64 rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-500"
            >

            <div class="flex gap-3">
                <button type="submit" class="rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black transition">
                    Buscar
                </button>

                <a href="{{ route('teachers.index') }}" class="rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Limpiar
                </a>
            </div>
        </form>

        @if ($searchId !== '')
            <div class="mt-6">
                @if ($foundTeacher)
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <h3 class="font-semibold text-slate-900 mb-3">Resultado encontrado</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <div><span class="font-semibold">ID:</span> {{ $foundTeacher['id'] ?? '—' }}</div>
                            <div><span class="font-semibold">Nombre:</span> {{ $foundTeacher['name'] ?? '—' }}</div>
                            <div><span class="font-semibold">Email:</span> {{ $foundTeacher['email'] ?? '—' }}</div>
                        </div>
                    </div>
                @else
                    <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-700">
                        No se ha encontrado ningún profesor con ese ID.
                    </div>
                @endif
            </div>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-900">Listado de profesores</h2>
        </div>

        @if (count($teachers) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Nombre</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">
                        @foreach ($teachers as $teacher)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $teacher['id'] ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $teacher['name'] ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $teacher['email'] ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('teachers.edit', $teacher['id']) }}" class="text-sm font-semibold text-slate-900 hover:underline">
                                            Editar
                                        </a>

                                        <form method="POST" action="{{ route('teachers.destroy', $teacher['id']) }}" onsubmit="return confirm('¿Seguro que quieres eliminar este profesor?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-sm font-semibold text-red-600 hover:underline">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-8 text-slate-500">
                No hay profesores disponibles.
            </div>
        @endif
    </div>
</div>
@endsection