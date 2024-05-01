<div class="card-libro">
    <h2 class="card-titulo">{{ $libro->titulo }}</h2>
    <p class="card-descripcion">{{ $libro->descripcion }}</p>
    <img class="card-portada" src="{{ asset('img/' . $libro->portada) }}" alt="{{ $libro->titulo }}">
    <p class="card-autor"><strong>Autor:</strong> {{ $libro->autor }}</p>
    <p class="card-publicacion"><strong>Publicación:</strong> {{ $libro->publicacion }}</p>
    <p class="card-genero"><strong>Género:</strong> {{ $libro->genero }}</p>
    <hr>


    @auth
        @if(auth()->user()->name==$libro->usuario)
            <form action="{{ route('libros.editarPage', $libro->id) }}" method="get" class="btn-editar">
                <input type="submit" value="Editar">
            </form>
            <form action='{{ route('libros.estado', $libro->id) }}' method='post' class='btn-subir'>
                @csrf
                @if (!$libro['finalizado'])
                    <input type='submit' value='Subir libro'>
                @else
                    <input type='submit' value='Volver a desarrollo'>
                @endif
            </form>
            <form action='{{ route('libros.eliminar', $libro->id) }}' method='delete' class='btn-eliminar'>
                @csrf
                <input type='submit' value='Eliminar libro'>
            </form>
        @endif
    @endauth

    <p class="card-usuario card-info-usuario">Subido por {{ $libro->usuario }}</p>
    <p class="card-fecha card-info-fecha">{{ $libro->updated_at }}</p>

    @auth
        @php
            $libro['finalizado'] ? ($estado = 'Finalizaado') : ($estado = 'En proceso');
        @endphp
        <p class="card-info-estado">Estado: {{ $estado }}</p>
    @endauth
</div>
