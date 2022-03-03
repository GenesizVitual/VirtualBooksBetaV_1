<?php

use App\Http\Resources\InstansiResource;
use App\Http\Resources\ProvinsiResource;
use App\Model\Persediaan\Instansi;
use App\Model\Apps\Provinsi;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registrasi', 'Persediaan\Api\UsersApi@register');
Route::get('data-user', 'Persediaan\Api\UsersApi@index');
Route::post('login', 'Persediaan\Api\UsersApi@login');
Route::resource('data-barang', 'Persediaan\Api\TestBarang');

Route::get('gudang', 'Persediaan\Api\TestBarang@barangAuth')->middleware('jwt.verify');
Route::get('user', 'Persediaan\Api\UsersApi@getAuthenticatedUser')->middleware('jwt.verify');
Route::get('data-users', 'Persediaan\Api\UsersApi@data_user');
