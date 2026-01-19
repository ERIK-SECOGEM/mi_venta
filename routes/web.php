<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PublicChatController;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:vendedor'])->group(function () {
    // Rutas protegidas para vendedores
    Route::resource('/vehicle', VehicleController::class);
    // Otras rutas específicas para vendedores pueden ir aquí
    Route::get('/vehicle/{vehicle}/qr-pdf', [VehicleController::class, 'generarPdfQr'])->name('vehiculos.qr.pdf');
    Route::post('/imagenes/eliminar', [ImageController::class, 'ajaxDelete'])->name('images.ajax.delete');
});

//ruta publica para ver ficha de vehículo
Route::get('/v/{vehicle}', [VehicleController::class, 'fichaPublica'])->name('vehiculo.publico');
Route::post('/v/{vehicle}/chat', [PublicChatController::class, 'store'])->name('public.chat.store');

require __DIR__.'/auth.php';
