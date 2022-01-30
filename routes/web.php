<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\OrganizationAssociationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get("/dashboard", [UserController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function () {
    Route::post("/profile/{user}/update", [UserController::class, 'updateProfile'])->name('profile.update');

    Route::group(['prefix' => 'experience', 'as' => 'experience.'], function () {
        Route::get('/create', [ExperienceController::class, 'create'])->name('create');
        Route::post('/store', [ExperienceController::class, 'store'])->name('store');
        Route::get('/{experience}/edit', [ExperienceController::class, 'edit'])->name("edit");
        Route::post('/{experience}/update', [ExperienceController::class, 'update'])->name("update");
        Route::get('/{experience}/delete', [ExperienceController::class, 'destroy'])->name("destroy");
    });

    Route::group(['prefix' => 'org-association', 'as' => 'org.association.'], function () {
        Route::get('/create', [OrganizationAssociationController::class, 'create'])->name('create');
        Route::post('/store', [OrganizationAssociationController::class, 'store'])->name('store');
        Route::get('/{organization}/edit', [OrganizationAssociationController::class, 'edit'])->name("edit");
        Route::post('/{organization}/update', [OrganizationAssociationController::class, 'update'])->name("update");
        Route::get('/{organization}/delete', [OrganizationAssociationController::class, 'destroy'])->name("destroy");
    });

});

require __DIR__ . '/auth.php';
