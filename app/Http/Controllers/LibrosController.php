<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LibrosController extends Controller
{
    public function index()
    {

        $finalizados = Libro::where('finalizado', True)->orderby('id', 'desc')->get();
        $enProceso = Libro::where('finalizado', False)->orderby('id', 'desc')->get();

        return view('libros.index', compact('finalizados'), compact('enProceso'));
    }

    public function create()
    {
        $nro1 = rand(0, 9);
        $nro2 = rand(0, 9);
        $nro3 = rand(0, 9);
        $letra = ['a', 'h', 'g', 'l', 'd', 'm', 'k'];
        $simbolo = ['%', '$', '/', '@', '#'];
        $mezcla_letra = rand(0, 6);
        $mezcla_simbolo = rand(0, 4);

        session()->put('codigo_captcha', $nro1 . $letra[$mezcla_letra] . $nro2 . $simbolo[$mezcla_simbolo] . $nro3);

        return  view('libros.create');
    }

    public function agregar(Request $request)
    {

        if ($request->captcha == Session::get('codigo_captcha')) {

            $libro = new Libro();

            $libro->usuario = Session::get('admin');
            $libro->titulo = $request->titulo;
            $libro->autor = $request->autor;
            $libro->genero = $request->genero;
            $libro->descripcion = $request->descripcion;

            $fechaIngresada = $request->fechaPublicacion;
            $fechaArray = explode("-", $fechaIngresada);
            $fechaFormateada = implode("-", array_reverse($fechaArray));
            $libro->publicacion = $fechaFormateada;

            $portadaNombre = $_FILES['portada']['name'];
            $portadaTamanio = $_FILES['portada']['size'];
            $portadaTipo = $_FILES['portada']['type'];
            $portadaTemporal = $_FILES['portada']['tmp_name'];

            $destinoImg = "../public/img/" . $portadaNombre;

            if ($request->portada) {
                if (($portadaTipo != 'image/jpeg' && $portadaTipo != 'image/jpg' && $portadaTipo != 'image/png' && $portadaTipo != 'image/webp') || $portadaTamanio > 2097152) {
                    return redirect(route('libros.create') . '?status=error_archivo');
                } else {
                    move_uploaded_file($portadaTemporal, $destinoImg);

                    $libro->portada = $portadaNombre;
                }
            }

            $libro->save();

            return redirect(route('libros.create') . '?status=ok');
        } else {
            return redirect(route('libros.create') . '?status=error_codigo');
        }
    }

    public function editarPage($id)
    {
        $libro = Libro::find($id);

        if(Session::get('admin')!==$libro->usuario){
            return redirect(route('login'));
        }

        $nro1 = rand(0, 9);
        $nro2 = rand(0, 9);
        $nro3 = rand(0, 9);
        $letra = ['a', 'h', 'g', 'l', 'd', 'm', 'k'];
        $simbolo = ['%', '$', '/', '@', '#'];
        $mezcla_letra = rand(0, 6);
        $mezcla_simbolo = rand(0, 4);

        session()->put('codigo_captcha', $nro1 . $letra[$mezcla_letra] . $nro2 . $simbolo[$mezcla_simbolo] . $nro3);

        $publicacion = $libro->publicacion;
        $fecha = Carbon::createFromFormat('d-m-Y', $publicacion)->format('Y-m-d');

        return view('libros.editar', compact('libro'), compact('fecha'));
    }

    public function editar(Request $request, $id)
    {
        $libro = Libro::find($id);

        if ($request->captcha == Session::get('codigo_captcha')) {

            $libro->finalizado = false;

            $libro->titulo = $request->titulo;
            $libro->autor = $request->autor;
            $libro->genero = $request->genero;
            $libro->descripcion = $request->descripcion;

            $fechaIngresada = $request->fechaPublicacion;
            $fechaArray = explode("-", $fechaIngresada);
            $fechaFormateada = implode("-", array_reverse($fechaArray));
            $libro->publicacion = $fechaFormateada;

            if ($request->portada) {
                $portadaNombre = $_FILES['portada']['name'];
                $portadaTamanio = $_FILES['portada']['size'];
                $portadaTipo = $_FILES['portada']['type'];
                $portadaTemporal = $_FILES['portada']['tmp_name'];

                $destinoImg = "../public/img/" . $portadaNombre;

                if (($portadaTipo != 'image/jpeg' && $portadaTipo != 'image/jpg' && $portadaTipo != 'image/png' && $portadaTipo != 'image/webp') || $portadaTamanio > 2097152) {
                    return redirect(route('libros.editarPage', $libro) . '?status=error_archivo');
                } else {
                    move_uploaded_file($portadaTemporal, $destinoImg);
                    $libro->portada = $portadaNombre;
                }
            }

            $libro->save();

            return redirect(route('libros.editarPage', $libro) . '?status=ok');
        } else {
            return redirect(route('libros.editarPage', $libro) . '?status=error_codigo');
        }
    }

    public function eliminarLibro($id)
    {
        $libro = Libro::find($id);

        if(Session::get('admin')!==$libro->usuario){
            return redirect(route('login'));
        }

        $libro->delete();

        return redirect(route('libros.index'));
    }

    public function cambiarEstado($id)
    {
        $libro = Libro::find($id);

        if(Session::get('admin')!==$libro->usuario){
            return redirect(route('login'));
        }

        if ($libro->finalizado) {
            $libro->finalizado = false;
        } else {
            $libro->finalizado = true;
        }
        $libro->save();

        return redirect(route('libros.index'));
    }
}
