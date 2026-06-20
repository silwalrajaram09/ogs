<?php

namespace App\Http\Controllers\public;

 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
//use Inertia\Controller;

class HomeController extends Controller
{
    public function index(){
        return Inertia::render('public/Home');
    }
}
