<?php
// CUSTOM ROUTE trong RouteServiceProvider.php
Route::group([
    'prefix' => 'backend',
    'as' => 'backend.',
    'namespace' => 'backend'
], function(){
    Route::get('/', 'LoginController@index')->name('login.index');
});
