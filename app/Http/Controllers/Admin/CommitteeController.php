<?php

namespace App\Http\Controllers\Admin;

use App\Models\Committee;
use App\Http\Requests\StoreCommitteeRequest;
use App\Http\Requests\UpdateCommitteeRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Controller;

class CommitteeController extends Controller
{
    public function __construct()
    {
               // $this->middleware(EnsureUserIsAdmin::class)->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // dd(Committee::with('parent')->get());
    //     $committees = Committee::with('parent')->get();
    //     return Inertia::render('committee/index', [
    //         'committees' => $committees,
    //     ]);
    // }

    public function index()
    {
        $committees = Committee::with('childrenRecursive')
        ->whereNull('parent_id')
        ->get();
        
        // dd($committees->toArray());
        return Inertia::render('admin/committee/index', [
            'committees' => $committees,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/committee/create', [
            'parents' => Committee::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommitteeRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['updated_by'] = Auth::id();

        Committee::create($data);

        return redirect()->route('admin/committee.index')->with('success', 'Committee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Committee $committee)
    {
        return Inertia::render('admin/committee/show', [
            'committee' => $committee->load('parent'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Committee $committee)
    {
        return Inertia::render('admin/committee/edit', [
            'committee' => $committee,
            'parents' => Committee::where('id', '!=', $committee->id)
                ->select('id', 'name')
                ->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeRequest $request, Committee $committee)
    {
        $data = $request->validated();
        $data['updated_by'] = Auth::id();

        $committee->update($data);

        return redirect()->route('admin/committee/index')->with('success', 'Committee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Committee $committee)
    {
        $committee->delete();

        return redirect()->route('admin/committee.index')->with('success', 'Committee deleted successfully.');
    }
}
