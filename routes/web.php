<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\public\HomeController;
use App\Http\Controllers\public\PublicProgramController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\PostController;
// use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Inertia\Inertia;
use App\Http\Controllers\public\ComitteeController;
use App\Http\Controllers\public\PublicPostController;

//Route::inertia('/', 'Welcome')->name('Home');


Route::get('/', [HomeController::class, 'index']);
Route::get('/committees', [ComitteeController::class, 'index']);
Route::get('/committees/{slug}', [ComitteeController::class, 'show']);

Route::get('/posts', [PublicPostController::class, 'index']);
Route::get('/posts/{slug}', [PublicPostController::class, 'show']);

Route::get('/programs', [PublicProgramController::class, 'index']);
Route::get('/programs/{slug}', [PublicProgramController::class, 'show']);


// Route::get('/', fn () => Inertia::render('public/Home'))->name('home');
Route::get('/about', fn() => Inertia::render('public/About'))->name('about');
Route::get('/contact', fn() => Inertia::render('public/Contact'))->name('contact');

// Route::get('/committees', fn () => Inertia::render('public/committees/Index'))->name('committees.index');
// Route::get('/committees/{slug}', fn ($slug) => Inertia::render('public/committees/Show', ['slug' => $slug]))->name('committees.show');

// Route::get('/programs', fn () => Inertia::render('public/programs/Index'))->name('programs.index');
// Route::get('/programs/{slug}', fn ($slug) => Inertia::render('public/programs/Show', ['slug' => $slug]))->name('programs.show');

// Route::get('/posts', fn () => Inertia::render('public/posts/Index'))->name('posts.index');
// Route::get('/posts/{slug}', fn ($slug) => Inertia::render('public/posts/Show', ['slug' => $slug]))->name('posts.show');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-programs', [DashboardController::class, 'Myprograms']);
    Route::get('/my-committees', [DashboardController::class, 'MyCommittees']);
});
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(
        function () {

            Route::get('/dashboard', function () {
                return Inertia::render('admin/dashboard');
            })->name('admin.dashboard');

            Route::resource(
                'committees',
                CommitteeController::class
            );
            Route::resource('programs', ProgramController::class);
            Route::resource('users', UserController::class);
            Route::resource('posts', PostController::class);
            Route::resource('pages', PageController::class);



            Route::post(
                'users/{user}/committees/attach',
                [UserController::class, 'attachCommittee']
            )->name('users.committees.attach');

            Route::delete(
                'users/{user}/committees/detach',
                [UserController::class, 'detachCommittee']
            )->name('users.committees.detach');


            Route::post(
                'users/{user}/programs/attach',
                [UserController::class, 'attachProgram']
            )->name('users.programs.attach');

            Route::delete(
                'users/{user}/programs/detach',
                [UserController::class, 'detachProgram']
            )->name('users.programs.detach');

            
        }

    );
require __DIR__ . '/settings.php';
