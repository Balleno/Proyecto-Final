@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
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
                               <td><img src={{ $tienda['imagen'] }} ></td>
                            <td>{{ $tienda['nombreTienda'] }}</td>
                            <td>{{ $tienda['price'] }}</td>
                            <td>
                                <button type="submit" class="btn btn-primary">
                                    Seguir
                                </button>
                            </td>
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
