<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanelControl\DashboardController;
use App\Http\Controllers\PanelControl\FavoriteController;
use App\Http\Controllers\PanelControl\MovieController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Switch Language
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', function ($locale) {

    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
        App::setLocale($locale);
    }

    return redirect()->back();

})->name('language.switch');



Route::get('/', [AuthController::class, 'index'])
    ->name('login');

Route::get('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register_process'])
    ->name('signup');

Route::post('/login', [AuthController::class, 'login'])
    ->name('signin');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('signout');



Route::prefix('controlpanel')
    ->middleware('checkLogin')
    ->group(function () {

        Route::get('/dashboard', [
            DashboardController::class,
            'index'
        ])->name('dashboard');



        Route::get('/movies', [
            MovieController::class,
            'index'
        ])->name('movies.search');

        Route::get('/movies/{imdbId}', [
            MovieController::class,
            'detail'
        ])
        ->where('imdbId', 'tt[0-9]+')
        ->name('movies.detail');



        Route::get('/favorites', [
            FavoriteController::class,
            'index'
        ])->name('favorites.index');

        Route::post('/favorites', [
            FavoriteController::class,
            'store'
        ])->name('favorites.store');

        Route::delete('/favorites/{imdbId}', [
            FavoriteController::class,
            'destroy'
        ])
        ->where('imdbId', 'tt[0-9]+')
        ->name('favorites.destroy');
    });