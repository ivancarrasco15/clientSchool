<?php

namespace App\Http\Controllers;

use App\Services\TeacherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct(private readonly TeacherService $teacherService)
    {
    }

    public function index(Request $request): View
    {
        $teachers = $this->teacherService->getAll();
        $searchId = trim((string) $request->query('search_id', ''));
        $foundTeacher = null;

        if ($searchId !== '') {
            $foundTeacher = $this->teacherService->getById((int) $searchId);
        }

        return view('teachers.index', [
            'teachers' => $teachers,
            'searchId' => $searchId,
            'foundTeacher' => $foundTeacher,
        ]);
    }

    public function create(): View
    {
        return view('teachers.form', [
            'teacher' => null,
            'isEdit' => false,
        ]);
    }

    public function edit(int $id): View
    {
        $teacher = $this->teacherService->getById($id);

        abort_unless($teacher, 404);

        return view('teachers.form', [
            'teacher' => $teacher,
            'isEdit' => true,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
        ], [], [
            'id' => 'ID',
            'name' => 'Nombre',
            'email' => 'Email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('teachers.create')
                ->withErrors($validator)
                ->withInput();
        }

        $created = $this->teacherService->create($validator->validated());

        if (! $created) {
            return redirect()
                ->route('teachers.index')
                ->with('error', 'No se ha podido crear el profesor.');
        }

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Profesor creado correctamente.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
        ], [], [
            'id' => 'ID',
            'name' => 'Nombre',
            'email' => 'Email',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('teachers.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $updated = $this->teacherService->update($id, $validator->validated());

        if (! $updated) {
            return redirect()
                ->route('teachers.index')
                ->with('error', 'No se ha podido actualizar el profesor.');
        }

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Profesor actualizado correctamente.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->teacherService->delete($id);

        if (! $deleted) {
            return redirect()
                ->route('teachers.index')
                ->with('error', 'No se ha podido eliminar el profesor.');
        }

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Profesor eliminado correctamente.');
    }
}