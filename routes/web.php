<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\controllers\ClientController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PointageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
});
// redirection apres login==============
Route::get('/dashboard', [AuthController::class, 'redirectToDashboard'])
    ->middleware('auth');
// Espace Admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/clients', [ClientController::class, 'index'])->name('admin.clients.index');
    Route::get('/clients/create', [ClientController::class,'create'])->name('admin.clients.create');
    Route::post('/clients', [ClientController::class,'store'])->name('admin.clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class,'edit'])->name('admin.clients.edit');
    Route::put('/clients/{client}', [ClientController::class,'update'])->name('admin.clients.update');
    Route::delete('/clients/{client}', [ClientController::class,'destroy'])->name('admin.clients.destroy');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('admin.commandes.index'); 
    Route::get('/commandes/create', [CommandeController::class,'create'])->name('admin.commandes.create');
    Route::post('/commandes', [CommandeController::class,'store'])->name('admin.commandes.store');
    Route::get('/commandes/{commande}/edit', [CommandeController::class,'edit'])->name('admin.commandes.edit');
    Route::put('/commandes/{commande}', [CommandeController::class,'update'])->name('admin.commandes.update');
    Route::delete('/commandes/{commande}', [CommandeController::class,'destroy'])->name('admin.commandes.destroy');
});
// Espace Opérateur
Route::prefix('operateur')->middleware(['auth', 'role:operateur'])->group(function () {
    Route::get('/dashboard', [OperateurController::class, 'dashboard'])->name('operateur.dashboard');
    Route::get('/clients', [ClientController::class, 'index'])->name('operateur.clients.index');
    Route::get('/clients/create', [ClientController::class,'create'])->name('operateur.clients.create');
    Route::post('/clients', [ClientController::class,'store'])->name('operateur.clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class,'edit'])->name('operateur.clients.edit');
    Route::put('/clients/{client}', [ClientController::class,'update'])->name('operateur.clients.update');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('operateur.commandes.index'); 
    Route::get('/commandes/create', [CommandeController::class,'create'])->name('operateur.commandes.create');
    Route::post('/commandes', [CommandeController::class,'store'])->name('operateur.commandes.store');
    Route::get('/commandes/{commande}/edit', [CommandeController::class,'edit'])->name('operateur.commandes.edit');
    Route::put('/commandes/{commande}', [CommandeController::class,'update'])->name('operateur.commandes.update');
});
// Espace Ramasseur
Route::prefix('ramasseur')->middleware(['auth', 'role:ramasseur'])->group(function () {
    Route::get('/dashboard', [RamasseurController::class, 'dashboard'])->name('ramasseur.dashboard');
});
// Espace Controleur
Route::prefix('controleur')->middleware(['auth', 'role:controleur'])->group(function () {
    Route::get('/dashboard', [ControleurController::class, 'dashboard'])->name('controleur.dashboard');
});
// Espace Caissier
Route::prefix('caissier')->middleware(['auth', 'role:caissier'])->group(function () {
    Route::get('/dashboard', [CaissierController::class, 'dashboard'])->name('caissier.dashboard');
});


// web.php
Route::get('/pointage', [PointageController::class, 'index'])->name('pointage.index');
Route::get('/pointage/show', [PointageController::class, 'show'])->name('pointage.show');
Route::post('/pointage/store', [PointageController::class, 'store'])->name('pointage.store');
Route::post('/pointage/user/update-etat', [PointageController::class, 'updateEtat'])->name('pointage.user.update_etat');


