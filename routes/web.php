<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\StorageLinkController;
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
});

Route::get('/certificate/search', [CertificationController::class, 'showSearchForm'])->name('certificate.searchForm');
Route::post('/certificate/search', [CertificationController::class, 'search'])->name('certificate.search');


// Rutas de autenticación personalizadas
Route::get('/internal/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/internal/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/colaboradores', [App\Http\Controllers\UserController::class, 'users'])->name('admin.users');
    Route::post('/admin/colaboradores', [App\Http\Controllers\UserController::class, 'create'])->name('admin.users.create');

    Route::get('/admin/tokens', [App\Http\Controllers\TokenController::class, 'index'])->name('admin.tokens');
    Route::post('/admin/tokens/add', [App\Http\Controllers\TokenController::class, 'add'])->name('admin.tokens.add');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [App\Http\Controllers\ChangePasswordController::class, 'changePassword']);


    Route::get('/image', [App\Http\Controllers\ImageController::class, 'generateCertifyPDF'])->name('ct');
    Route::get('/qr', [App\Http\Controllers\ImageController::class, 'generateQR'])->name('t2');
    
});


Route::group(['middleware' => ['auth', 'collaborator']], function () {
    Route::get('/collaborators/cursos', [App\Http\Controllers\CoursesController::class, 'index'])->name('collaborators.courses.index');
    Route::get('/collaborators/cursos/create', [App\Http\Controllers\CoursesController::class, 'create'])->name('collaborators.courses.create');
    Route::post('/collaborators/cursos', [App\Http\Controllers\CoursesController::class, 'store'])->name('collaborators.courses.store');
    
    Route::get('/collaborators/alumnos', [App\Http\Controllers\AlumnController::class, 'index'])->name('collaborators.alumns.index');
    Route::get('/collaborators/alumnos/create', [App\Http\Controllers\AlumnController::class, 'create'])->name('collaborators.alumns.create');
    Route::post('/collaborators/alumnos', [App\Http\Controllers\AlumnController::class, 'store'])->name('collaborators.alumns.store');
    
    Route::get('/collaborators/certificados', [App\Http\Controllers\CertificationController::class, 'index'])->name('collaborators.certification.index');
    Route::get('/collaborators/certificados/create', [App\Http\Controllers\CertificationController::class, 'create'])->name('collaborators.certification.create');
    Route::post('/collaborators/certificados', [App\Http\Controllers\CertificationController::class, 'store'])->name('collaborators.certification.store');
    Route::get('/collaborators/my-tokens', [App\Http\Controllers\TokenController::class, 'tokensOfCollaborator'])->name('collaborators.tokens');

});

//Rutas de colaboradores






Route::get('/create-storage-link', [StorageLinkController::class, 'createStorageLink']);
