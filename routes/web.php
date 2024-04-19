<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ComplaintController;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('sections', SectionController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('themes', ThemeController::class);
    Route::resource('messages', MessagesController::class);

    Route::get('sections/{sections}/branches', [SectionController::class, 'branchIndex']);
    Route::get('sections/{sections}/branches_except/{branch}', [SectionController::class, 'branchIndexExcept']);

    Route::get('branches/{branch}/theme/create', [BranchController::class, 'themeCreate'])->name('branches.themes.create');

    Route::post('messages/{message}/likes', [MessagesController::class, 'toggleLikes']);
    Route::post('messages/{messages}/complaints', [MessagesController::class, 'storeComplains'])->name('message.complains.store');

    Route::patch('images', [ImageController::class, 'store'])->name('images.store');

    Route::get('users/personal', [UserController::class, 'personal'])->name('users.personal');
    Route::patch('/users/avatar', [UserController::class, 'update']);

    Route::get('/admin', [MainController::class, 'index'])->name('admin.main.index');
    Route::get('/admin/complaint', [ComplaintController::class, 'index'])->name('admin.complaints.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
