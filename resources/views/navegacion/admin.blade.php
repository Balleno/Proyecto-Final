@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Lista de Usuarios</h1>
                    @foreach($usuarios as $usuario)       
                    <form method="POST" action="{{ url('usuarios/eliminar') }}">
                    @csrf

                    @method('POST')
                        <table class="tablausuario">
                            <tr>Nombre usuario: {{ $usuario->name }} </tr>
                            <tr>
                                <button type="submit" class="btn btn-danger">
                                    Eliminar
                                </button>
                            </tr>
                        </table>

                        <div class="form-group">
                            <input type="text" name="id_usuario" value= {{ $usuario->id }} hidden>
                        </div>
                    </form>
                    @endforeach
                    
        </div>
    </div>
</div>

@endsection