<x-plantilla>
    @section('titulo', 'Agregar registro')

    <section>

        <h1>Agrega un nuevo registro</h1>

        <form action="{{ route('libros.agregar') }}" method="POST" class="formulario" enctype="multipart/form-data">
            @csrf

            @if (isset($_GET['status']))
                @switch($_GET['status'])
                    @case('error_codigo')<h3 class='r-incorrecto'>El captcha ingresado no es correcto</h3>@break
                    @case('error_archivo')<h3 class='r-incorrecto'>Imagen no soportada</h3>@break
                    @case('ok')<h3 class='r-exitoso'>Registro exitoso</h3>@break
                @endswitch
            @endif

            <div class="form-titulo">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" placeholder="Ej: El Hobbit" title="Ingrese el título del libro" autofocus>
            </div>

            <div class="form-autor">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" placeholder="Ej: J. R. R. Tolkien" title="Ingrese el nombre del autor del libro">
            </div>

            <div class="form-fecha">
                <label for="fechaPublicacion">Fecha de publicación:</label>
                <input type="date" name="fechaPublicacion" title="Ingrese la fecha de publicacion del libro">
            </div>

            <div class="form-genero">
                <label for="genero">Género:</label>
                <input type="text" name="genero" placeholder="Ej: Fantasía"
                    title="Ingrese el género literario del libro">
            </div>

            <div class="form-descripcion">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" cols="30" rows="10"
                    placeholder="Ej: Un hobbit llamado Bilbo Bolsón es arrastrado a una búsqueda de un tesoro guardado por un dragón..."
                    title="Proporcione una breve descripción del libro">
                </textarea>
            </div>

            <div class="form-portada">
                <label for="portada">Portada:</label>
                <p>No debe exceder los 2MB. Solo se aceptan los formatos jpg, png y webp.</p>
                <input type="file" name="portada">
            </div>
            <hr>
            <div class="form-captcha">
                <label for="captcha">Escriba el texto de la imagen</label>
                <img src="{{ route('captcha.create') }}" alt="captcha" class="captcha">
                <input type="text" name="captcha" placeholder="Ingrese el captcha">
            </div>
            <hr>

            <input class="form-boton btn-borrar" type="reset" value="Vaciar campos">
            <input class="form-boton btn-enviar" type="submit" value="Enviar">

        </form>
    </section>
</x-plantilla>
