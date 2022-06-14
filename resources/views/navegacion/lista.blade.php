@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>Lista de Seguimiento</h1>
                    @foreach($productos as $producto)       
                    <form method="POST" action="{{ url('productos/borrar') }}">
                    @csrf

                    @method('POST')
                        <table class="tablaproducto">
                            <tr><a href={{ $producto->url_producto }} target="_blank">{{ $producto->url_producto }}</a></tr>
                            <tr>
                                <button type="submit" class="btn btn-primary">
                                    Borrar
                                </button>
                            </tr>
                        </table>

                        <div class="form-group">
                            <input type="text" name="id_seguimiento" value= {{ $producto->id }} hidden>
                        </div>
                    </form>
                    @endforeach
                    
        </div>
    </div>
</div>

@endsection