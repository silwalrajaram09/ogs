<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Committee;
use App\Models\Program;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->type === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $user = auth()->user()->load(['committees.parent', 'programs']);

        $stats = [
            'total_committees' => $user->committees->count(),
            'total_programs' => $user->programs->count(),
            'total_posts' => Post::count(),
            'total_users' => User::count(),
        ];

        return Inertia::render('Dashboard', [
            'auth_user' => $user,
            'stats' => $stats,
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function MyPrograms()
    {
        $user = auth()->user()->load('programs');

        return Inertia::render('users/MyPrograms', [
            'programs' => $user->programs,
            'auth_user' => $user,
        ]);
    }

    public function MyCommittees()
    {
        $user = auth()->user()->load(['committees.parent']);

        return Inertia::render('users/MyCommittees', [
            'committees' => $user->committees,
            'auth_user' => $user,
        ]);
    }
}