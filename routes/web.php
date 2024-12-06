<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StorageLinkController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');


Route::get('/internal/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/internal/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//Rutas de registro
Route::get('/register-estudiante', [RegisterController::class, 'registrarEstudianteVista'])->name('register.estudiante');
Route::post('/register-estudiante', [RegisterController::class, 'registrarEstudianteGuardar'])->name('register.estudiante.store');

Route::get('/register-tutor', [RegisterController::class, 'registrarTutorVista'])->name('register.tutor');
Route::post('/register-tutor', [RegisterController::class, 'registrarTutorGuardar'])->name('register.tutor.store');

Route::get('/cuenta-pendiente', [PublicController::class, 'index'])->name('cuenta_pendiente.index');


Route::get('/tutores', [PublicController::class, 'tutores'])->name('public.tutores');

Route::get('/tutorias', [PublicController::class, 'tutorias'])->name('public.tutorias');
Route::get('/tutorias/materia/{materiaId}', [PublicController::class, 'tutoriasPorMateria'])->name('public.tutorias.porMateriaId');


Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/admin/usuarios', [AdminController::class, 'indexUsuarios'])->name('admin.usuarios.index');
    Route::get('/admin/usuarios/desactivar/{id}', [AdminController::class, 'desactivarUsuario'])->name('admin.usuarios.desactivar');
    Route::get('/admin/usuarios/activar/{id}', [AdminController::class, 'activarUsuario'])->name('admin.usuarios.activar');
});


Route::group(['middleware' => ['auth', 'tutor']], function () {
    Route::get('/tutor/home', [App\Http\Controllers\TutorController::class, 'home'])->name('tutor.home');
    Route::get('/tutor/agenda', [App\Http\Controllers\TutorController::class, 'agenda'])->name('tutor.agenda');
    Route::get('/tutor/espacio', [App\Http\Controllers\TutorController::class, 'createEspacio'])->name('tutor.createEspacio');
    Route::get('/tutor/citas', [App\Http\Controllers\TutorController::class, 'citas'])->name('tutor.citas');
    Route::get('/tutor/saldo', [App\Http\Controllers\TutorController::class, 'vistaSaldo'])->name('tutor.saldo');


    Route::post('/tutor/espacio', [App\Http\Controllers\EspacioController::class, 'store'])->name('espacios.store');
});

Route::group(['middleware' => ['auth', 'estudiante']], function () {
    Route::get('/agendar/clase/{id}', [App\Http\Controllers\AgendaController::class, 'agendarVista'])->name('agendar.tutor');
    Route::post('/agendar/confirmacion', [App\Http\Controllers\AgendaController::class, 'agendarConfirmacion'])->name('agendar.tutor.confirmacion');
    Route::post('/agendar/finalizar', [App\Http\Controllers\AgendaController::class, 'finalizarAgendamiento'])->name('agendar.tutor.finalizar');

    Route::get('/estudiante/citas', [App\Http\Controllers\EstudianteController::class, 'citas'])->name('estudiantes.citas');

    Route::get('/estudiante/facturas', [App\Http\Controllers\FacturaController::class, 'mostrarVistaFacturas'])->name('estudiantes.facturas');
    Route::get('/estudiante/facturas/{id}', [App\Http\Controllers\FacturaController::class, 'verFactura'])->name('estudiantes.facturas_visualizar');


    Route::get('/estudiante/home', [App\Http\Controllers\EstudianteController::class, 'home'])->name('estudiantes.home');
});







