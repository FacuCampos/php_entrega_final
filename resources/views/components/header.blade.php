<header class="header">
    <h1 class="titulo-principal"><a href="{{ route('home') }}">Compartiendo historias</a></h1>
    <nav class="navegador">
        <ul>
            <li><a href="{{ route('libros.index') }}">Ver registro</a></li>

            @auth
                <li><a href="{{ route('libros.create') }}">Agregar registro</a></li>            
            @endauth
            
            @guest
                <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
            @else
                <li>
                    <form method="POST" action="{{ route('cerrar-sesion') }}">
                        @csrf
                        <a href="#" onclick="this.closest('form').submit()">Cerrar sesión</a>
                    </form>
                </li>
            @endguest
        </ul>
    </nav>
</header>
