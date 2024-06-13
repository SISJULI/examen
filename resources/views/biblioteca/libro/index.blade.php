@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Listado de Libros</h3>
                    <div class="card-tools">
                        <form action="{{ url('biblioteca/libro') }}" method="GET" class="form-inline">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="texto" class="form-control float-right" placeholder="Buscar por título o autor" value="{{ $texto }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <a href="{{ url('biblioteca/libro/create') }}" class="btn btn-primary ml-2">
                                        <i class="fas fa-plus"></i> Nuevo Libro
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Número de Páginas</th>
                                <th>Portada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($libros as $libro)
                                <tr>
                                    <td>{{ $libro->id }}</td>
                                    <td>{{ $libro->titulo }}</td>
                                    <td>{{ $libro->autor }}</td>
                                    <td>{{ $libro->numpaginas }}</td>
                                    <td>
                                        @if ($libro->portada)
                                            <img src="http://localhost:8080/libreria/public/img/libros/{{ $libro->portada }}" alt="{{ $libro->titulo }}" width="50">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('libro.show', $libro->id) }}" class="btn btn-info">Ver</a>
                                        <a href="{{ route('libro.edit', $libro->id) }}" class="btn btn-warning">Editar</a>
                                        <form action="{{ route('libro.destroy', $libro->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $libros->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
