<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\controllers\ClientController;
use App\Http\Controllers\OperateurController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\CaissierController;
use App\Http\Controllers\ControleController;
use App\Http\Controllers\RamasseurController;


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
    Route::get('/pointage', [PointageController::class, 'index'])->name('admin.pointage.index');
    Route::get('/pointage/show', [PointageController::class, 'show'])->name('admin.pointage.show');
    Route::post('/pointage/store', [PointageController::class, 'store'])->name('admin.pointage.store');
    Route::post('/pointage/user/update-etat', [PointageController::class, 'updateEtat'])->name('admin.pointage.user.update_etat');
    Route::get('/admin/pointages/commande/{id}', [PointageController::class, 'historique'])->name('admin.pointage.historique');

    
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
    Route::get('/pointage', [PointageController::class, 'index'])->name('operateur.pointage.index');
Route::get('/pointage/show', [PointageController::class, 'show'])->name('operateur.pointage.show');
Route::post('/pointage/store', [PointageController::class, 'store'])->name('operateur.pointage.store');
Route::post('/pointage/user/update-etat', [PointageController::class, 'updateEtat'])->name('operateur.pointage.user.update_etat');

});
// Espace Ramasseur
Route::prefix('ramasseur')->middleware(['auth', 'role:ramasseur'])->group(function () {
    Route::get('/dashboard', [RamasseurController::class, 'dashboard'])->name('ramasseur.dashboard');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('ramasseur.commandes.index');
    Route::get('/pointage', [PointageController::class, 'index'])->name('ramasseur.pointage.index');
Route::get('/pointage/show', [PointageController::class, 'show'])->name('ramasseur.pointage.show');
Route::post('/pointage/store', [PointageController::class, 'store'])->name('ramasseur.pointage.store');
Route::post('/pointage/user/update-etat', [PointageController::class, 'updateEtat'])->name('ramasseur.pointage.user.update_etat');


});
// Espace Controleur
Route::prefix('controleur')->middleware(['auth', 'role:controleur'])->group(function () {
    Route::get('/dashboard', [ControleController::class, 'dashboard'])->name('controleur.dashboard');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('controleur.commandes.index');
    Route::get('/pointage', [PointageController::class, 'index'])->name('controleur.pointage.index');
Route::get('/pointage/show', [PointageController::class, 'show'])->name('controleur.pointage.show');
Route::post('/pointage/store', [PointageController::class, 'store'])->name('controleur.pointage.store');
Route::post('/pointage/user/update-etat', [PointageController::class, 'updateEtat'])->name('controleur.pointage.user.update_etat');


});
// Espace Caissier
Route::prefix('caissier')->middleware(['auth', 'role:caissier'])->group(function () {
    Route::get('/dashboard', [CaissierController::class, 'dashboard'])->name('caissier.dashboard');
    Route::get('/commandes', [CommandeController::class, 'index'])->name('caissier.commandes.index');
    Route::get('/pointage', [PointageController::class, 'index'])->name('caissier.pointage.index');
Route::get('/pointage/show', [PointageController::class, 'show'])->name('caissier.pointage.show');
Route::post('/pointage/store', [PointageController::class, 'store'])->name('caissier.pointage.store');
Route::post('/pointage/user/update-etat', [PointageController::class, 'updateEtat'])->name('caissier.pointage.user.update_etat');
Route::post('/paiement', [CaissierController::class, 'enregistrerPaiement'])->name('caissier.paiement');


});


Route::get('/notification/read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->findOrFail($id);
    $notification->markAsRead();
    return redirect()->back();
})->name('notification.read');

