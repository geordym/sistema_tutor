<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    //

    public function mostrarVistaFacturas()
    {
        $user = auth()->user();
        $userId = $user->id;

        $facturas = DB::select('SELECT * FROM facturas WHERE usuario_id = ?', [$userId]);

        return view('estudiantes.facturas')->with('facturas', $facturas);
    }

    public function verFactura($id)
    {
        $factura = DB::select('SELECT * FROM facturas WHERE id = ?', [$id]);
        return view('estudiantes.facturas_visualizar')->with('factura', $factura);
    }

    public function crearFactura($userId, $items)
    {
        // Iniciar una transacción para asegurar consistencia
        DB::beginTransaction();

        try {
            // Calcular el total de la factura
            $total = 0;
            foreach ($items as $item) {
                $total += $item['cantidad'] * $item['precio_unitario'];
            }

            // Crear la factura usando SQL puro
            $sqlFactura = "
                INSERT INTO facturas (usuario_id, fecha_emision, total, estado, created_at, updated_at) 
                VALUES (:usuario_id, :fecha_emision, :total, :estado, :created_at, :updated_at)
            ";
            DB::insert($sqlFactura, [
                'usuario_id' => $userId,
                'fecha_emision' => now(),
                'total' => $total,
                'estado' => 'pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener el ID de la factura creada
            $facturaId = DB::getPdo()->lastInsertId();

            // Crear los ítems de la factura
            $sqlItem = "
                INSERT INTO facturas_items (factura_id, descripcion, cantidad, precio_unitario, subtotal, created_at, updated_at) 
                VALUES (:factura_id, :descripcion, :cantidad, :precio_unitario, :subtotal, :created_at, :updated_at)
            ";

            foreach ($items as $item) {
                DB::insert($sqlItem, [
                    'factura_id' => $facturaId,
                    'descripcion' => $item['descripcion'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal' => $item['cantidad'] * $item['precio_unitario'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            // Retornar el ID de la factura creada
            return $facturaId;
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Manejar la excepción (puedes registrar el error o lanzarlo de nuevo)
            throw $e;
        }
    }
}
