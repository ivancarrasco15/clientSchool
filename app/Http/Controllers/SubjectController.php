<?php

namespace App\Http\Controllers;

use App\Services\SubjectService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SubjectController extends Controller
{
    public function __construct(private readonly SubjectService $subjectService)
    {
    }

    public function index(Request $request): View
    {
        $subjects = $this->subjectService->getAll();
        $searchId = trim((string) $request->query('search_id', ''));
        $foundSubject = null;

        if ($searchId !== '') {
            $foundSubject = $this->subjectService->getById((int) $searchId);
        }

        return view('subjects.index', [
            'subjects' => $subjects,
            'searchId' => $searchId,
            'foundSubject' => $foundSubject,
        ]);
    }

    public function create(): View
    {
        return view('subjects.form', [
            'subject' => null,
            'isEdit' => false,
        ]);
    }

    public function edit(int $id): View
    {
        $subject = $this->subjectService->getById($id);

        abort_unless($subject, 404);

        return view('subjects.form', [
            'subject' => $subject,
            'isEdit' => true,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:160'],
            'teacher_id' => ['nullable', 'integer'],
        ], [], [
            'id' => 'ID',
            'name' => 'Nombre',
            'teacher_id' => 'ID del profesor',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('subjects.create')
                ->withErrors($validator)
                ->withInput();
        }

        $created = $this->subjectService->create($validator->validated());

        if (! $created) {
            return redirect()
                ->route('subjects.index')
                ->with('error', 'No se ha podido crear la asignatura.');
        }

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Asignatura creada correctamente.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:160'],
            'teacher_id' => ['nullable', 'integer'],
        ], [], [
            'id' => 'ID',
            'name' => 'Nombre',
            'teacher_id' => 'ID del profesor',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('subjects.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $updated = $this->subjectService->update($id, $validator->validated());

        if (! $updated) {
            return redirect()
                ->route('subjects.index')
                ->with('error', 'No se ha podido actualizar la asignatura.');
        }

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Asignatura actualizada correctamente.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $deleted = $this->subjectService->delete($id);

        if (! $deleted) {
            return redirect()
                ->route('subjects.index')
                ->with('error', 'No se ha podido eliminar la asignatura.');
        }

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Asignatura eliminada correctamente.');
    }
}