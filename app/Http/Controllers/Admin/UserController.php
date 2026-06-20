<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\Program;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    // public function index(Request $request)
    // {
    //     $perPage= $request->input('per_page',10);
    //     $users = User::latest()
    //         ->withCount(['committees', 'programs'])
    //         ->paginate($perPage);

    //     return Inertia::render('admin/users/index', [
    //         'users' => $users,
    //     ]);
    // }
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->integer('per_page', 10);

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->withCount(['committees', 'programs'])
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('admin/users/index', [
            'users' => $users,
            'filters' => [
                'search' => $search,
                'per_page' => $perPage,
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/users/create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['slug'] = \Illuminate\Support\Str::slug($data['full_name']) . '-' . uniqid();
        $data['address'] = $data['address'] ?? 'N/A';
        $data['fb_link'] = $data['fb_link'] ?? '#';
        $data['youtube_link'] = $data['youtube_link'] ?? '#';
        $data['tiktok_link'] = $data['tiktok_link'] ?? '#';
        $data['photo_path'] = $data['photo_path'] ?? 'default.jpg';
        $data['start_date'] = $data['start_date'] ?? now();
        $data['end_date'] = $data['end_date'] ?? now()->addYear();

        User::create($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        $user->load(['committees.parent', 'programs']);

        $allCommittees = Committee::orderBy('name')->get(['id', 'name']);
        $allPrograms = Program::orderBy('name')->get(['id', 'name']);

        return Inertia::render('admin/users/show', [
            'user' => $user,
            'allCommittees' => $allCommittees,
            'allPrograms' => $allPrograms,
        ]);
    }

    public function edit(User $user)
    {
        return Inertia::render('admin/users/edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }



    public function attachCommittee(Request $request, User $user)
    {
        $request->validate([
            'committee_id' => ['required', 'exists:committee,id'],
        ]);

        // sync without detaching so duplicates are avoided
        $user->committees()->syncWithoutDetaching([$request->committee_id]);

        return back()->with('success', 'Committee attached.');
    }

    public function detachCommittee(Request $request, User $user)
    {
        $request->validate([
            'committee_id' => ['required', 'exists:committee,id'],
        ]);

        $user->committees()->detach($request->committee_id);

        return back()->with('success', 'Committee detached.');
    }



    public function attachProgram(Request $request, User $user)
    {
        $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
        ]);

        $user->programs()->syncWithoutDetaching([$request->program_id]);

        return back()->with('success', 'Program attached.');
    }

    public function detachProgram(Request $request, User $user)
    {
        $request->validate([
            'program_id' => ['required', 'exists:programs,id'],
        ]);

        $user->programs()->detach($request->program_id);

        return back()->with('success', 'Program detached.');
    }
}