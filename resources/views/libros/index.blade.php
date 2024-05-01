<x-plantilla>

    @section('titulo', 'Registro')

    <h1>Registro</h1>

    <section class="contenedor-libros">

        <div class='contenedorEstado'>

            @auth<h2>Libros subidos</h2>@endauth

            <div class='lista-libros'>
                @foreach ($finalizados as $libro)
                    @include('components.card')
                @endforeach
            </div>
        </div>

        @auth
            <div class='contenedorEstado'>
                <h2>En desarrollo</h2>
                <div class='lista-libros'>
                    @foreach ($enProceso as $libro)
                        @include('components.card')
                    @endforeach
                </div>
            </div>
        @endauth
    </section>
</x-plantilla>
