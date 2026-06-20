<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Committee;
use Inertia\Inertia;

class ComitteeController extends Controller
{
    public function index(){
        return Inertia::render('public/committees/Index');
    }
    public function show(string $slug)
    {
        // $committee = Committee::where('slug', $slug)
        //     ->firstOrFail();

        // return Inertia::render('public/committees/Show', [
        //     'committee' => $committee,
        // ]);
        return Inertia::render('public/committees/Show');
    }
}
