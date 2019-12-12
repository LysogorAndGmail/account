<?php

Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginLogoutController@login');
Route::post('/token/validator', 'TokenValidatorController@validateAuthorization');

Route::group(['prefix' => 'workforce'], function () {
    Route::post('/user/create', 'WorkforceUserController@create');
    Route::put('/user/update', 'WorkforceUserController@update');
    Route::delete('/user/destroy', 'WorkforceUserController@destroy');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'LoginLogoutController@logout');
    Route::get('/user', 'UserController@getUser');
    Route::post('/log-to-workforce', 'LoginLogoutController@loginToWorkforce');

    Route::group(['prefix' => 'profile'], function () {
        Route::put('/update', 'ProfileController@update');
        Route::put('/update-password', 'ProfileController@updatePassword');
    });

    Route::group(['prefix' => 'organization'], function () {
        Route::get('/', 'OrganizationController@index');
        Route::get('/{org}/show', 'OrganizationController@show');
        Route::put('/{org}/update', 'OrganizationController@update');
        Route::post('/store', 'OrganizationController@store');
    });

    Route::group(['prefix' => 'module'], function () {
        Route::get('/', 'ModuleController@index');
        Route::post('/buy', 'ModuleController@buyModule');
        Route::post('/{sub}/cancel', 'ModuleController@cancelModule');
    });
});
