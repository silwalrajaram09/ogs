<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicPostController extends Controller
{
    public function index(){
        return Inertia::render('public/posts/Index');
    }
    public function show(){
        return Inertia::render('public/posts/Show');
    }
}
