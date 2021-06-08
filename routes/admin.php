<?php
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
], function(){
    Route::get('/login', 'LoginController@index')->name('login.index');
    Route::post('/handle-login', 'LoginController@handleLogin')->name('login.handle.login');
    Route::post('/logout', 'LoginController@logout')->name('login.logout');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    //brands
    Route::get('/brand', 'BrandController@index')->name('brand.index');

    //categories

    //products

});
