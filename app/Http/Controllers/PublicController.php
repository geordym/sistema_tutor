<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{


    public function tutoriasPorMateria($materiaId)
    {
        $areas = DB::select('
        SELECT 
            areas.id as area_id,
            areas.nombre as area_name,
            materias.id as materia_id,
            materias.nombre as materia_name
        FROM areas
        LEFT JOIN materias ON areas.id = materias.area_id
        ORDER BY areas.nombre, materias.nombre
    ');

        $areasList = [];

        foreach ($areas as $row) {
            // Si el área aún no ha sido agregada, inicializamos su estructura
            if (!isset($areasList[$row->area_id])) {
                // Eliminar acentos del nombre del área
                $areaNameSinAcento = $this->removeAccents($row->area_name);

                $areasList[$row->area_id] = [
                    'nombre' => $areaNameSinAcento,
                    'materias' => []
                ];
            }

            // Si la materia existe (puede ser null en el caso de áreas sin materias)
            if ($row->materia_name) {
                // Eliminar acentos del nombre de la materia
                $materiaNameSinAcento = $this->removeAccents($row->materia_name);

                // Agregamos la materia a la lista de materias del área
                $areasList[$row->area_id]['materias'][] = [
                    'nombre' => $materiaNameSinAcento,
                    'id' => $row->materia_id
                ];
            }
        }


        $tutores = DB::select("
        SELECT 
            tutores.*, 
            users.name as user_name, 
            users.email as user_email 
        FROM tutores
        INNER JOIN users ON tutores.user_id = users.id
        WHERE tutores.materia_id = :materia_id
    ", ['materia_id' => $materiaId]);



        return view('public.tutorias')->with('areasList', $areasList)->with('tutores', $tutores);
    }

    public function index()
    {
        return view('public.cuenta_pendiente');
    }

    public function tutorias()
    {
        $areas = DB::select('
        SELECT 
            areas.id as area_id,
            areas.nombre as area_name,
            materias.id as materia_id,
            materias.nombre as materia_name
        FROM areas
        LEFT JOIN materias ON areas.id = materias.area_id
        ORDER BY areas.nombre, materias.nombre
    ');

        $areasList = [];

        foreach ($areas as $row) {
            // Si el área aún no ha sido agregada, inicializamos su estructura
            if (!isset($areasList[$row->area_id])) {
                // Eliminar acentos del nombre del área
                $areaNameSinAcento = $this->removeAccents($row->area_name);

                $areasList[$row->area_id] = [
                    'nombre' => $areaNameSinAcento,
                    'materias' => []
                ];
            }

            // Si la materia existe (puede ser null en el caso de áreas sin materias)
            if ($row->materia_name) {
                // Eliminar acentos del nombre de la materia
                $materiaNameSinAcento = $this->removeAccents($row->materia_name);

                // Agregamos la materia a la lista de materias del área
                $areasList[$row->area_id]['materias'][] = [
                    'nombre' => $materiaNameSinAcento,
                    'id' => $row->materia_id
                ];
            }
        }

        return view('public.tutorias')->with('areasList', $areasList);
    }

    public function removeAccents($string)
    {
        // Usamos una función de PHP para eliminar los acentos
        $accentedCharacters = ['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'à', 'è', 'ù', 'ì', 'ò', 'á', 'ü'];
        $unaccentedCharacters = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'a', 'e', 'u', 'i', 'o', 'a', 'u'];
        return str_replace($accentedCharacters, $unaccentedCharacters, $string);
    }


    public function tutores()
    {
        $tutores = DB::select('
        SELECT 
            tutores.*, 
            users.name as user_name, 
            users.email as user_email,
            areas.nombre as area_name,
            materias.nombre as materia_name
        FROM tutores
        INNER JOIN users ON tutores.user_id = users.id
        INNER JOIN materias ON tutores.materia_id = materias.id
        INNER JOIN areas ON materias.area_id = areas.id
    ');


        return view('public.tutores')->with('tutores', $tutores);
    }
}
