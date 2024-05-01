<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function create()
    {
        header('Context-type:image/jpeg');

        $imagen_captcha = imagecreate(100,30);
        $fondo = imagecolorallocate($imagen_captcha, 137, 83, 53);
        $texto = imagecolorallocate($imagen_captcha, 255, 230, 150);
        imagestring($imagen_captcha, 5, 27, 7, Session::get('codigo_captcha'), $texto);
        imagejpeg($imagen_captcha);
    }
}
