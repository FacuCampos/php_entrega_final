<x-plantilla>
    @section('titulo', 'Editar libro')

    <section>

        <h1>Editar libro</h1>

        <form action="{{ route('libros.editar', $libro->id) }}" method="POST" class="formulario" enctype="multipart/form-data">
            @csrf

            @if (isset($_GET['status']))
                @switch($_GET['status'])
                    @case('error_codigo')
                        <h3 class='r-incorrecto'>El captcha ingresado no es correcto</h3>
                    @break

                    @case('error_archivo')
                        <h3 class='r-incorrecto'>Imagen no soportada</h3>
                    @break

                    @case('ok')
                        <h3 class='r-exitoso'>Edicion exitosa</h3>
                    @break
                @endswitch
            @endif

            <div class="form-titulo">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" placeholder="Ej: El Hobbit" title="Ingrese el título del libro"
                    autofocus value="{{ $libro->titulo }}">
            </div>

            <div class="form-autor">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" placeholder="Ej: J. R. R. Tolkien"
                    title="Ingrese el nombre del autor del libro " value="{{ $libro->autor }}">
            </div>

            <div class="form-fecha">
                <label for="fechaPublicacion">Fecha de publicación:</label>
                <input type="date" name="fechaPublicacion" title="Ingrese la fecha de publicacion del libro" value="{{ $fecha }}">
            </div>

            <div class="form-genero">
                <label for="genero">Género:</label>
                <input type="text" name="genero" placeholder="Ej: Fantasía"
                    title="Ingrese el género literario del libro" value="{{ $libro->genero }}">
            </div>

            <div class="form-descripcion">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" cols="30" rows="10" placeholder="Ej: Un hobbit llamado Bilbo Bolsón es arrastrado a una búsqueda de un tesoro guardado por un dragón..." title="Proporcione una breve descripción del libro">{{ $libro->descripcion }}</textarea>
            </div>

            <div class="form-portada">
                <div>
                    <label for="portada">Portada:</label>
                    <p>No debe exceder los 2MB. Solo se aceptan los formatos jpg, png y webp.</p>
                    <input type="file" name="portada" value="{{ $libro->portada }}">
                </div>
                <div>
                    <label>Portada actual</label>
                    <img src="{{ asset('img/' . $libro->portada) }}" alt="portada actual">
                </div>
            </div>
            <hr>
            <div class="form-captcha">
                <label for="captcha">Escriba el texto de la imagen</label>
                <img src="{{ route('captcha.create') }}" alt="captcha" class="captcha">
                <input type="text" name="captcha" placeholder="Ingrese el captcha">
            </div>
            <hr>

            <input class="form-boton btn-borrar" type="reset" value="Vaciar campos">
            <input class="form-boton btn-enviar" type="submit" value="Editar">

        </form>
    </section>

</x-plantilla>
