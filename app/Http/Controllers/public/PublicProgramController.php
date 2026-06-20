<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicProgramController extends Controller
{
    public function index(){
        return Inertia::render('public/programs/Index');
    }

    public function show(){
        return Inertia::render('public/programs/Show');
    }
}
