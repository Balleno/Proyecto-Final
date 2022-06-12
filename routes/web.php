<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
// route to show the login form
Route::get('login', array(
    'uses' => 'MainController@showLogin'
  ));
  // route to process the form
Route::post('login', array(
'uses' => 'MainController@doLogin'
));
Route::get('logout', array(
'uses' => 'MainController@doLogout'
));
Route::get('/',
function ()
{
return view('auth.login');
});

Route::get('productos',
  function ()
    {
    return view('navegacion/productos');
    });

Route::get('lista',
  function ()
    {
    return view('navegacion/lista');
    });

Route::get('admin',
    function ()
      {
      return view('navegacion/admin');
      });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('productos', ProductoController::class, ['parameters'
=> ['{busqueda}' => 'texto_buscar']]);

Route::post('productos/buscar', [ProductoController::class, 'store']);

Route::post('productos/seguir', [ProductoController::class, 'seguir']);

Route::get('lista', [ProductoController::class, 'listar']);

Route::get('admin', [ProductoController::class, 'administrar']);

Route::post('productos/borrar', [ProductoController::class, 'borrar']);