<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('parent')->latest()->get();

        return Inertia::render('admin/programs/index', [
            'programs' => $programs
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/programs/create');
    }

    public function store(StoreProgramRequest $request)
    {
        Program::create($request->validated());

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program created successfully.');
    }

    public function show(Program $program)
    {
        return Inertia::render('admin/programs/show', [
            'program' => $program->load('parent', 'children')
        ]);
    }

    public function edit(Program $program)
    {
        return Inertia::render('admin/programs/edit', [
            'program' => $program
        ]);
    }

    public function update(UpdateProgramRequest $request, Program $program)
    {
        $program->update($request->validated());

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()
            ->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }
}