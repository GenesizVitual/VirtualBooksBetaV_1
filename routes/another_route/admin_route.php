<?php
use Illuminate\Support\Facades\Route;

Route::get('admin', function(){
    return view('Admin.login');
});

Route::post('login','Apps\Login@cek_authority');

Route::get('admin-dashboard', 'Apps\AdminDashboad@index');

Route::resource('langganan', 'Apps\Langganan');

Route::get('password', function (){
    return bcrypt('Allah Tolong Lah Hambamu ini');
});