@section('titulo', 'Ingresar')

<x-plantilla>

    <section class="contenedor_ingresar">

        <form action="{{ route('iniciar-sesion') }}" method="post" class="formulario">
            @csrf

            <h1 class="form-titulo">Ingresar</h1>

            <hr>

            @if ($errors->any())
                <ul class="errores">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="form-componente">
                <label for="usuarioInput">Usuario:</label>
                <input type="text" name="name" id="usuarioInput" placeholder="Usuario" required autofocus>
            </div>

            <div class="form-componente">
                <label for="passwordInput">Contraseña:</label>
                <input type="password" name="password" id="passwordInput" placeholder="Contraseña" required>
            </div>

            <div class="form-componente" id="mantenerSesion">
                <input type="checkbox" name="remember" id="rememberCheck">
                <label for="rememberCheck">Mantener sesión iniciada</label>
            </div>

            <hr>

            <div class="form-componente" id="crearCuenta">
                <p>¿No tienes cuenta? <a href="{{ route('signup') }}">Regístrate</a></p>
            </div>

            <hr>

            <input type="submit" value="Ingresar" class="btn-ingresar">

        </form>

    </section>

</x-plantilla>
