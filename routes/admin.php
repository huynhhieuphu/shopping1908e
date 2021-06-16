<?php

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'admin'
], function () {
    Route::get('/login', 'LoginController@index')->middleware('is.admin.login')->name('login.index');
    Route::post('/handle-login', 'LoginController@handleLogin')->name('login.handle.login');
    Route::post('/logout', 'LoginController@logout')->name('login.logout');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['web' , 'check.login.admin']
], function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    //brands
    Route::get('/brand', 'BrandController@index')->name('brand.index');
    Route::get('/brand/add', 'BrandController@add')->name('brand.add');
    Route::post('/brand/handle-add', 'BrandController@handleAdd')->name('brand.handle.add');
    Route::post('/brand/handle-delete', 'BrandController@handleDelete')->name('brand.handle.delete');
    Route::get('/brand/{slug}~{id}', 'BrandController@edit')->name('brand.edit');
    Route::post('/brand/handle-update', 'BrandController@handleUpdate')->name('brand.handle.update');

    //categories
    Route::get('/category', 'CategoryController@index')->name('category.index');
    Route::post('/category/handle-add', 'CategoryController@handleAdd')->name('category.handle.add');

    //products

});
