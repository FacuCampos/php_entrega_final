@section('titulo', 'Registrarse')

<x-plantilla>

    <section>
        <form action="{{ route('register') }}" method="post" class="formulario" id="registroUsuario">
            @csrf

            <h1 class="form-titulo">Regístrate</h1>
            <hr>
            <div class="form-componente emailComponente">
                <label for="emailInput">Email:</label>
                <input type="email" id="emailInput" name="email" required>
            </div>

            <div class="form-componente">
                <label for="userInput">Nombre de usuario:</label>
                <input type="text" id="userInput" name="name" required>
            </div>

            <div class="form-componente">
                <label for="passwordInput">Contraseña:</label>
                <input type="password" name="password" id="passwordInput" required>
            </div>

            <hr>

            <input type="submit" value="Registrarse" class="btn-ingresar">

        </form>
    </section>

</x-plantilla>
