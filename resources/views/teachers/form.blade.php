@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">
            {{ $isEdit ? 'Editar profesor' : 'Crear profesor' }}
        </h1>
        <p class="text-slate-500 mt-2">
            Gestión de profesores del cliente Laravel.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-4 text-red-700">
            <p class="font-semibold mb-2">Revisa los campos del formulario:</p>
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8">
        <form
            method="POST"
            action="{{ $isEdit ? route('teachers.update', $teacher['id']) : route('teachers.store') }}"
            class="space-y-6"
        >
            @csrf
            @if ($isEdit)
                @method('PUT')
            @endif

            <div>
                <label for="id" class="block text-sm font-semibold text-slate-700 mb-2">ID</label>
                <input
                    type="number"
                    id="id"
                    name="id"
                    value="{{ old('id', $teacher['id'] ?? '') }}"
                    placeholder="Ej. 1"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-500"
                >
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nombre</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $teacher['name'] ?? '') }}"
                    placeholder="Ej. Marta Pérez"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-500"
                >
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $teacher['email'] ?? '') }}"
                    placeholder="usuario@clientschool.test"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 outline-none focus:border-slate-500"
                >
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black transition">
                    {{ $isEdit ? 'Guardar cambios' : 'Crear profesor' }}
                </button>

                <a href="{{ route('teachers.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Volver al listado
                </a>
            </div>
        </form>
    </div>
</div>
@endsection