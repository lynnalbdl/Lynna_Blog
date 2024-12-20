<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Routes accessibles par le rôle 'user'
    // En supposant que 'user' puisse voir et modifier son propre profil
    Route::get('/user/profile', [UserController::class, 'profile'])->middleware('permission:view own profile');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->middleware('permission:edit own profile');

    // Routes pour les administrateurs
    Route::middleware(['role:admin|super admin'])->group(function () {
        Route::apiResource("users", UserController::class)->except(['store', 'show']);

        // Autres routes pour les administrateurs ici
    });

    // Routes spécifiques au super administrateur
    Route::middleware(['role:super admin'])->group(function () {
        // Routes spécifiques au super admin, si nécessaire
        // Ceci est juste un exemple. Ajustez selon vos permissions réelles
        Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->middleware('permission:delete users');
    });
});