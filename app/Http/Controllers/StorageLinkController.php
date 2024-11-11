<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class StorageLinkController extends Controller
{
    public function createStorageLink()
    {
        // Ejecutar el comando para crear el storage link
        Artisan::call('storage:link');

        return response()->json([
            'message' => 'Enlace simbólico creado exitosamente.',
        ]);
    }
}
