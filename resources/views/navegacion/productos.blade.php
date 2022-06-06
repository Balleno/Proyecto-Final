@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Búsqueda de productos</h1>
            <form method="POST" action="{{ url('productos/buscar') }}" id="formulariobusqueda" class="form">
            @csrf

            @method('POST')
            <div class="form-group">
                <input type="text" id="busqueda" name="busqueda">
            </div>
                <button type="submit" class="btn btn-primary">
                    Buscar
                </button>
            </form>
            @if(isset($tiendas))
                @foreach($tiendas as $tienda)
                    @if(isset($tienda['imagen']))
                    <form method="POST" action="{{ url('productos/seguir') }}">
                    @csrf

                    @method('POST')
                        <table class="tablaproducto">
                            <tr>
                                <img src={{ $tienda['imagen'] }} >
                            </tr>
                            <tr>{{ $tienda['nombreTienda'] }}</tr>
                            <tr>{{ $tienda['price'] }}</tr>
                            <tr>
                                <button type="submit" class="btn btn-primary">
                                    Seguir
                                </button>
                            </tr>
                        </table>

                        <div class="form-group">
                            <input type="text" name="urlproducto" value= {{ $tienda['urlproducto'] }} hidden>
                        </div>

                        
                    </form>
                        
                    @endif
                @endforeach
            @endif
            
        </div>
    </div>
</div>
@endsection