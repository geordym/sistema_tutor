<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Espacio;
use App\Models\Estudiante;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{

    private $facturaController;

    public function __construct()
    {
        $this->facturaController = new FacturaController();
    }

    public function agendarVista($id)
    {
        $sql = 'SELECT * FROM tutores WHERE id = ?';
        $tutor = DB::select($sql, [$id])[0];


        $sqlEspacios = 'SELECT * FROM espacios WHERE tutor_id = ?';
        $espacios = DB::select($sqlEspacios, [$tutor->id]);

        $mesActual = date('m');
        $anioActual = date('Y'); 

        $diasTotales = cal_days_in_month(CAL_GREGORIAN, $mesActual, $anioActual);

        // Generar una lista de días del mes con cargaUtil y nombreVisible
        $diasDelMes = [];
        for ($i = 1; $i <= $diasTotales; $i++) {
            // Formatear el día en el formato "2024-12-01"
            $fecha = \Carbon\Carbon::create($anioActual, $mesActual, $i)->format('Y-m-d');

            // Obtener el nombre visible del mes (3 primeras letras + número)
            $nombreVisible = \Carbon\Carbon::create($anioActual, $mesActual, $i)->format('M') . ' ' . $i;

            // Agregar el día con los valores correspondientes
            $diasDelMes[] = [
                'cargaUtil' => $fecha,
                'nombreVisible' => $nombreVisible,
            ];
        }

        // Pasar los días y el tutor a la vista
        return view('estudiantes.agendar', compact('diasDelMes'))->with('tutor', $tutor)->with('espacios', $espacios);
    }


    public function agendarConfirmacion(Request $request)
    {
        // Obtén los valores del formulario
        $tutorId = $request->input('tutor_id');
        $tipoSesion = $request->input('tipo_sesion');
        $espacioId = $request->input('espacio_id');
        $cantidadPersonas = $request->input('cantidad_personas');
        $costoTotal = $request->input('costo_total'); // Asegúrate de que esta entrada sea correcta

        // Encuentra al tutor y el espacio según sus IDs
        $tutorSql = 'SELECT * FROM tutores WHERE id = ?';
        $tutor = DB::select($tutorSql, [$tutorId])[0];

        $espacioSql = 'SELECT * FROM espacios WHERE id = ?';
        $espacio = DB::select($espacioSql, [$espacioId])[0];

        return view('estudiantes.agendar_confirmacion')
            ->with('tutor', $tutor)
            ->with('espacio', $espacio)
            ->with('costoTotal', $costoTotal)
            ->with('cantidadPersonas', $cantidadPersonas)
            ->with('tipoSesion', $tipoSesion);
    }



    public function finalizarAgendamiento(Request $request)
    {
        if (!$this->comprobarPago()) {
            return redirect()->back()->with('error', 'El pago no se ha procesado correctamente.');
        }

        $userId = Auth::id();
        $estudianteSql = 'SELECT * FROM estudiantes WHERE user_id = ? LIMIT 1';
        $estudiante = DB::select($estudianteSql, [$userId])[0];


        $tutorId = $request->input('tutor_id');
        $tutorSql = 'SELECT * FROM tutores WHERE id = ? LIMIT 1';
        $tutor = DB::select($tutorSql, [$tutorId])[0];

        $sql = 'INSERT INTO citas (tutor_id, espacio_id, cantidad_personas, costo_total, fecha, estudiante_id, hora_inicio, hora_fin, estado, tipo) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

        DB::insert($sql, [
            $request->input('tutor_id'),
            $request->input('espacio_id'),
            $request->input('cantidad_personas'),
            $request->input('costo_total'),
            $request->input('fecha'),
            $estudiante->id,
            $request->input('hora_inicio'),
            $request->input('hora_fin'),
            'pendiente', // Estado por defecto
            $request->input('tipo')
        ]);

        $citaId = DB::getPdo()->lastInsertId();

        $sql = 'SELECT * FROM citas WHERE id = ?';
        $cita = DB::selectOne($sql, [$citaId]);

        DB::update(
            'UPDATE espacios SET espacioTomado = 1 WHERE id = ?',
            [$request->input('espacio_id')]
        );

        $facturaItem = [
            [
                'descripcion' => "Cita con tutor {$tutor->name} el {$cita->fecha}",
                'cantidad' => 1,
                'precio_unitario' => $cita->costo_total,
            ]
        ];

        $facturaCreada = $this->facturaController->crearFactura($userId, $facturaItem);
        return view('estudiantes.agradecimiento')->with('cita', $cita)->with('tutor', $tutor);
    }



    private function comprobarPago()
    {
        return true;
    }
}
