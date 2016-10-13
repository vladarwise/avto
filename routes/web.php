<?php
Route::group(['domain' => config('app.domain'), 'middleware' => 'web'], function () {
    Route::get('/', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);
    
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'AdminsController@index');

    Route::get('/zapros', 'AdminsController@zaprosPage');
    Route::get('/zaprosApi', 'AdminsController@zaprosApi');
    Route::post('/zaprosApi/edit', 'AdminsController@zaprosEdit');
    Route::post('/zaprosApi/delete/{id}', 'AdminsController@zaprosDelete');

    Route::get('/device', 'AdminsController@devicePage');
    Route::get('/deviceApi', 'AdminsController@deviceApi');
    Route::post('/deviceApi/edit', 'AdminsController@deviceEdit');
    Route::post('/deviceApi/delete/{id}', 'AdminsController@deviceDelete');


    Route::get('/auto', 'AdminsController@autoPage');
    Route::get('/autoApi', 'AdminsController@autoApi');
    Route::get('/autoApi/my', 'AdminsController@autoApiMy');
    Route::post('/autoApi/edit', 'AdminsController@autoEdit');
    Route::post('/autoApi/delete/{id}', 'AdminsController@autoDelete');
    Route::get('/marks_with', 'AdminsController@apiMarksWithModels');

    Route::get('/print/{type}/{id?}', 'AdminsController@printPage');
});
Route::group(['middleware' => 'admin'], function () {
    Route::get('/users', 'AdminsController@users');
    Route::get('/models', 'AdminsController@models');
    Route::get('/info', 'AdminsController@info');
    Route::post('/info', 'AdminsController@postInfo');
    Route::get('/main_text', 'AdminsController@getMainText');
    Route::post('/main_text', 'AdminsController@postMainText');
});
Route::group(['middleware' => 'admin', 'prefix' => 'api'], function () {
    Route::get('/users', 'AdminsController@apiUsers');
    Route::get('/mod_mark', 'AdminsController@apiModMark');
    Route::post('/marks/delete/{id}', 'AdminsController@DeleteMarks');
    Route::post('/models/delete/{id}', 'AdminsController@DeleteModels');
    Route::post('/user/delete/{id}', 'AdminsController@deleteUser');
    Route::post('/user/edit', 'AdminsController@EditUser');
    Route::post('/marks/edit', 'AdminsController@EditMarks');
    Route::post('/models/edit', 'AdminsController@EditModels');
});
});