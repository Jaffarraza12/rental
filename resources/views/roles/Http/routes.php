<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */

    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Registration routes...
    Route::get('/register', 'Auth\AuthController@getRegister');
    Route::post('/register', 'Auth\AuthController@postRegister');

    Route::group( ['middleware' => 'auth' ], function()
    {
        Route::get('/', 'Common\DashboardController@index');
        //User Roles
        Route::get('/roles', 'User\RolesController@index');
        Route::get('/role/data', 'User\RolesController@getData');
        Route::get('/role/add', 'User\RolesController@getAddRole');
        Route::post('/role/add', 'user\RolesController@AddRole');
        Route::get('/role/edit/{role}', 'User\RolesController@getEditRole');
        Route::post('/role/edit/{role}', 'User\RolesController@EditRole');
        Route::post('/role/remove/{role}', 'User\RolesController@Destroy');

        //Attribute_group
        Route::get('/attribute_groups', 'Attribute\AttributeGroupController@index');
        Route::get('/attribute_groups/data', 'Attribute\AttributeGroupController@getData');
        Route::get('/attribute_groups/add', 'Attribute\AttributeGroupController@getAdd');
        Route::post('/attribute_groups/add', 'Attribute\AttributeGroupController@Add');
        Route::get('/attribute_groups/edit/{role}', 'Attribute\AttributeGroupController@getEdit');
        Route::post('/attribute_groups/edit/{role}', 'Attribute\AttributeGroupController@Edit');
        Route::post('/attribute_groups/remove/{role}', 'Attribute\AttributeGroupController@Destroy');

        //Attributes
        Route::get('/attribute', 'Attribute\AttributeController@index');
        Route::get('/attribute/data', 'Attribute\AttributeController@getData');
        Route::get('/attribute/add', 'Attribute\AttributeController@getAdd');
        Route::post('/attribute/add', 'Attribute\AttributeController@Add');
        Route::get('/attribute/edit/{role}', 'Attribute\AttributeController@getEdit');
        Route::post('/attribute/edit/{role}', 'Attribute\AttributeController@Edit');
        Route::post('/attribute/remove/{role}', 'Attribute\AttributeController@Destroy');


    });





  });
