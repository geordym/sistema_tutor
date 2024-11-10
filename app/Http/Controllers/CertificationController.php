<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCertificate;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumn;
use App\Models\Collaborator;
use App\Models\Course;
use Carbon\Carbon;
use FPDF;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{

    private $imageController;

    public function __construct()
    {
        $this->imageController = new ImageController();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAuthenticatedId = Auth::id();

        $certifications = CourseCertificate::where('collaborator_id', $userAuthenticatedId)->get();
        return view('collaborators.certifications.index')->with('certifications', $certifications);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userAuthenticatedId = Auth::id();

        $courses = Course::where('collaborator_id', $userAuthenticatedId)->get();
        $alumns = Alumn::where('collaborator_id', $userAuthenticatedId)->get();
        return view('collaborators.certifications.create')->with('alumns', $alumns)->with('courses', $courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $courseId = $request->input('course');
        $alumns = $request->input('alumnos');
        $fechaActual = Carbon::now();

        $course = Course::find($courseId);

        $certifications = [];
        foreach ($alumns as $alumnId) {
            $alumn = Alumn::find($alumnId);
            $collaboratorId = $course->collaborator_id;
            $collaborator = Collaborator::find($collaboratorId);

            $courseCertificate = CourseCertificate::create([
                'certify_code' => "PENDING",
                'student_fullname' => $alumn->fullname,
                'student_curp' => $alumn->curp,
                'course_name' => $course->name,
                'course_hour_load' => $course->hour_load,
                'issue_date' => $fechaActual,
                'instructor_name' => $collaborator->name,
                'collaborator_id' => $collaborator->id
            ]);

            $certifyCode = $this->generateCertifyCode(
                $course->name,
                $course->hour_load,
                $collaboratorId,
                $alumnId,
                $courseCertificate->id,
                $fechaActual
            );

            $courseCertificate->certify_code = $certifyCode;
            $courseCertificate->update();

            $imagePath = $this->imageController->generateCertifyPDF(
                $courseCertificate->certify_code,
                $courseCertificate->student_fullname,
                $courseCertificate->issue_date->format('d/m/Y'),
                $courseCertificate->course_name
            );

            $certifyPdfTempPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('imagen_', true) . '.pdf';
            $this->imageToPdf($imagePath, $certifyPdfTempPath);
            $pdfContent = file_get_contents($certifyPdfTempPath);
            $storagePath = 'images/' . basename($certifyPdfTempPath);
            Storage::disk('public')->put($storagePath, $pdfContent);

            $courseCertificate->certify_path = $storagePath;
            $courseCertificate->update();

            $certifications[] = $courseCertificate;
        }

        return view('collaborators.certifications.show')->with('certifications', $certifications);
    }

    function imageToPdf($imagePath, $pdfPath)
    {
        // Crear una instancia de FPDF con orientación horizontal ('L')
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
    
        // Dimensiones de la página A4 en orientación horizontal (A4 landscape)
        $pageWidth = 297; // Ancho de A4 en landscape
        $pageHeight = 210; // Alto de A4 en landscape
    
        // Insertar la imagen en el PDF para que ocupe toda la página
        $pdf->Image($imagePath, 0, 0, $pageWidth, $pageHeight);
    
        // Guardar el PDF en la ruta especificada
        $pdf->Output('F', $pdfPath);
    }
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generateCertifyCode($courseName, $courseHourLoad, $collaboratorId, $alumnId, $certifyId, $certifyAt)
    {
        // Extraer las primeras tres letras del nombre del curso y hacerlas mayúsculas
        $courseCode = strtoupper(substr($courseName, 0, 3));

        // Formatear la fecha de certificación para usarla en el código (ejemplo: YYYYMMDD)
        $dateCode = date('Ymd', strtotime($certifyAt));

        // Combinar los datos en un formato único
        $certifyCode = $courseCode . '' . $courseHourLoad . '' . $collaboratorId . '' . $alumnId . '' . $certifyId . '' . $dateCode;

        return $certifyCode;
    }
}
