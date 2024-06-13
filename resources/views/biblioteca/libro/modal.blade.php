@extends('layouts.admin')
@section('contenido')
    <div class="modal fade" id="modalShowBook" tabindex="-1" role="dialog" aria-labelledby="modalShowBookLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalShowBookLabel">Detalle del Libro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <p>{{ $libro->titulo }}</p>
                    </div>
                    <div class="form-group">
                        <label for="autor">Autor</label>
                        <p>{{ $libro->autor }}</p>
                    </div>
                    <div class="form-group">
                        <label for="numpaginas">Número de Páginas</label>
                        <p>{{ $libro->numpaginas }}</p>
                    </div>
                    <div class="form-group">
                        <label for="portada">Portada</label>
                        @if ($libro->portada)
                            <img src="{{ asset('img/libros/' . $libro->portada) }}" alt="{{ $libro->titulo }}" width="100">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
