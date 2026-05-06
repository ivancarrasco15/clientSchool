@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-slate-900 mb-3">
        Panel principal
    </h1>

    <p class="text-slate-500 mb-8">
        Panel principal del cliente Laravel. Desde aquí puedes acceder a profesores, estudiantes y asignaturas.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h2 class="text-xl font-semibold mb-2">Profesores</h2>
            <p class="text-slate-500 mb-4">
                Gestiona los registros de profesores desde el cliente.
            </p>
            <a href="{{ route('teachers.index') }}" class="text-slate-900 font-semibold hover:underline">
                Abrir
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h2 class="text-xl font-semibold mb-2">Estudiantes</h2>
            <p class="text-slate-500 mb-4">
                Gestiona los registros de estudiantes desde el cliente.
            </p>
            <a href="{{ route('students.index') }}" class="text-slate-900 font-semibold hover:underline">
                Abrir
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h2 class="text-xl font-semibold mb-2">Asignaturas</h2>
            <p class="text-slate-500 mb-4">
                Gestiona los registros de asignaturas desde el cliente.
            </p>
            <a href="{{ route('subjects.index') }}" class="text-slate-900 font-semibold hover:underline">
                Abrir
            </a>
        </div>
    </div>
</div>
@endsection