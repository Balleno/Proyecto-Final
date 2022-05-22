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
return view('welcome');
});

Route::get('productos',
  function ()
    {
    return view('navegacion/productos');
    });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('productos', ProductoController::class, ['parameters'
=> ['{busqueda}' => 'texto_buscar']]);

Route::post('productos/buscar', [ProductoController::class, 'store']);

Route::post('productos/seguir', [ProductoController::class, 'seguir']);