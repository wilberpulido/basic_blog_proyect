@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear articulo</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form 
                        action="{{ route('posts.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Título *</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="file">Imagen</label>
                            <input type="file" name="file">
                        </div>
                        <div class="form-group">
                            <label for="body">Contenido</label>
                            <textarea name="body" rows="6" class="form-control" placeholder="Escribir el Contenido" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="iframe">Contenido embebido</label>
                            <textarea name="iframe" class="form-control" placeholder="Escriba contenido embebido"></textarea>
                        </div>
                        <div class="form-group">
                            @csrf
                            <input type="submit" value="Enviar" class="btn btn-sm btn-primary">
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
