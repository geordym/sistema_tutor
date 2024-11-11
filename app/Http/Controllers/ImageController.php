<?php

namespace App\Http\Controllers;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Illuminate\Http\Request;

use Intervention\Image\Laravel\Facades\Image;


use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class ImageController extends Controller
{
    //

    public function generateCertifyPDF2()
    {
        $certificadoImagePath = 'C:\laragon\www\ep_sistema3\storage\EP sistema\certificado_template.png';
        $image = Image::read($certificadoImagePath);

        // Agregar texto
        $image->text('GEORDY MONTENEGRO MOSQUERA', 1500, 1210, function ($font) {
            $font->file('C:\Windows\Fonts\times.ttf');
            $font->size(100);
            $font->color('#1C1B17'); // Color del texto
            $font->align('center');
            $font->valign('top');
        });

        // Guardar en el directorio temporal de Windows
        $tmpPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'nueva_imagen.png';
        $image->save($tmpPath);

        // Retornar la imagen como respuesta HTTP y eliminar el archivo temporal después de enviarlo
        return response()->file($tmpPath)->deleteFileAfterSend(true);
    }


    public function generateCertifyPDF($code, $alumnName, $finishCourseDate, $courseName)
    {
        $certificadoImagePath = 'C:\laragon\www\ep_sistema3\storage\EP sistema\certificado_template_oficial2.jpg';
        $image = Image::read($certificadoImagePath);

        $qrPathImage = $this->generateQRCode($code);

        // Cargar la imagen del código QR
        $qrImage = Image::read($qrPathImage);

        $qrX = 780; // Posición X
        $qrY = 150; // Posición Y

        // Insertar e código QR en la imagen principal
        $image->place($qrImage, 'top-left', $qrX, $qrY);

        // Agregar texto a la imagen
        $image->text($alumnName, 500, 330, function ($font) {
            $font->file('C:\Windows\Fonts\times.ttf');
            $font->size(35);
            $font->color('#1C1B17'); // Color del texto
            $font->align('center');
            $font->valign('top');
        });

        $image->text($finishCourseDate, 500, 390, function ($font) {
            $font->file('C:\Windows\Fonts\times.ttf');
            $font->size(30);
            $font->color('#1C1B17'); // Color del texto
            $font->align('center');
            $font->valign('top');
        });

        $image->text($courseName, 490, 515, function ($font) {
            $font->file('C:\Windows\Fonts\times.ttf');
            $font->size(34);
            $font->color('#1C1B17'); // Color del texto
            $font->align('center');
            $font->valign('top');
        });

        // Guardar la imagen editada en un directorio temporal
        $tmpPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('imagen_', true) . '.png';
        $image->save($tmpPath);

        // Retornar la imagen como respuesta HTTP y eliminar el archivo temporal después de enviarlo
        // return response()->file($tmpPath)->deleteFileAfterSend(true);
        return $tmpPath;
    }


    public function generateQRCode($codeText)
    {
        // Crear el objeto QrCode con el texto proporcionado
        $qrCode = new QrCode($codeText);

        // Ajustar el tamaño del QR (por ejemplo, 150 px en lugar de 300 px)
        $qrCode->setSize(120); // Cambia el valor según lo que necesites para hacerlo más pequeño

        // Crear el escritor para guardar la imagen como PNG
        $writer = new PngWriter();

        $label = new Label(
            text: $codeText,  // El texto que quieres agregar debajo del QR
            textColor: new Color(0, 0, 255)
        );

        // Definir la ruta temporal donde se guardará el archivo QR
        $tempDir = sys_get_temp_dir();
        $qrCodePath = $tempDir . DIRECTORY_SEPARATOR . 'qr_code_' . uniqid() . '.png';

        // Generar y guardar el código QR como un archivo
        $result = $writer->write($qrCode, null, $label);
        $result->saveToFile($qrCodePath);

        // Retornar la ruta del archivo generado
        return $qrCodePath;
    }
}
