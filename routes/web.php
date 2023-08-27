<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('dashboard.index');
});*/

//Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
//Route::resource('contacts', ContactController::class);
/*Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
Route::patch('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   

    Route::get('/', [
        'as' => 'home',
        'uses' => function () {
            if (Auth::check()) {
                return Redirect::route('dashboard.index');
            } else {
                return Redirect::route('login.show');
            }
        }
    ]);

    Route::group(['middleware' => ['guest']], function() {

        /**
        * Register Routes
        */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
        * Login Routes
        */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {

        /**
         * Dashboard Routes
         */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index'); //->middleware('auth');
        
        /**
         * Contacts Routes
         */
        
        Route::resource('contacts', ContactController::class); //->middleware('auth');

        // Apply the custom middleware to these routes
        Route::group(['middleware' => ['checkRole:admin']], function() {
            Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
            Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
            Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
            Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
            Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
        });

        /**
        * Logout Routes
        */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

    })->middleware('auth');
    
});