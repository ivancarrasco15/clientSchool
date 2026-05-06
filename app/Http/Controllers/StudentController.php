<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(private readonly StudentService $studentService)
    {
    }

    public function index(Request $request): View
    {
        $students = $this->studentService->getAll();
        $searchId = trim((string) $request->query('search_id', ''));
        $foundStudent = null;

        if ($searchId !== '') {
            $foundStudent = $this->studentService->getById((int) $searchId);
        }

        return view('students.index', [
            'students' => $students,
            'searchId' => $searchId,
            'foundStudent' => $foundStudent,
        ]);
    }

    public function create(): View
    {
        return view('students.form', [
            'student' => null,
            'isEdit' => false,
        ]);
    }

    public function edit(int $id): View
    {
        $student = $this->studentService->getById($id);

        abort_unless($student, 404);

        return view('students.form', [
            'student' => $student,
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
                ->route('students.create')
                ->withErrors($validator)
                ->withInput();
        }

        $created = $this->studentService->create($validator->validated());

        if (! $created) {
            return redirect()
                ->route('students.index')
                ->with('error', 'No se ha podido crear el estudiante.');
        }

        return redirect()
            ->route('students.index')
            ->with('success', 'Estudiante creado correctamente.');
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
                ->route('students.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $updated = $this->studentService->update($id, $validator->validated());

        if (! $updated) {
            return redirect()
                ->route('students.index')
                ->with('error', 'No se ha podido actualizar el estudiante.');
        }

        return redirect()
            ->route('students.index')
            ->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->studentService->delete($id);

        if (! $deleted) {
            return redirect()
                ->route('students.index')
                ->with('error', 'No se ha podido eliminar el estudiante.');
        }

        return redirect()
            ->route('students.index')
            ->with('success', 'Estudiante eliminado correctamente.');
    }
}