@extends('layouts.admin')
@section('contenido')
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Libro</h3>
            </div>
            <form action="{{ route('libro.update', $libro->id) }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $libro->titulo }}" placeholder="Ingresa el título del libro">
                    </div>
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <input type="text" class="form-control" name="autor" id="autor" value="{{ $libro->autor }}" placeholder="Ingresa el autor del libro">
                    </div>
                    <div class="form-group">
                        <label for="numpaginas">Número de Páginas</label>
                        <input type="number" class="form-control" name="numpaginas" id="numpaginas" value="{{ $libro->numpaginas }}" placeholder="Ingresa el número de páginas">
                    </div>
                    <div class="form-group">
                        <label for="portada">Portada</label>
                        <input type="file" class="form-control" id="portada" name="portada">
                        @if ($libro->portada)
                            <img src="{{ asset('img/libros/' . $libro->portada) }}" alt="{{ $libro->titulo }}" width="100">
                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success me-1 mb-1">Actualizar</button>
                        <button onclick="window.location.href='http://localhost:8080/libreria/public/biblioteca/libro'" type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
