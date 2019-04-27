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

Route::group(['middlewareGroups' => ['web']], function () {
    /**
     * Show Task Dashboard
     */


   
    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
    //Route::get('auth/logout', 'Auth\AuthController@getLogout');
    Route::get('/logout','Common\DashboardController@Logout');

// Registration routes...
    Route::get('/register', 'Auth\AuthController@getRegister');


    Route::post('/register', 'Auth\AuthController@postRegister');

    Route::get('/check_user/{email}', 'Auth\AuthController@checkUser');
    Route::post('/create_user', 'Auth\AuthController@createUser');

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


        //Building
        Route::get('/building', 'Property\BuildingController@index');
        Route::get('/temp', 'Property\BuildingController@CheckTemp');
        Route::get('/building/data', 'Property\BuildingController@getData');
        Route::get('/building/add', 'Property\BuildingController@getAdd');
        Route::post('/building/add', 'Property\BuildingController@Add');
        Route::get('/building/edit/{building}', 'Property\BuildingController@getEdit');
        Route::post('/building/edit/{building}', 'Property\BuildingController@Edit');
        Route::post('/building/remove/{building}', 'Property\BuildingController@Destroy');
        Route::post('/building/remove-contact/{building_contact_id}', 'Property\BuildingController@DestroyContact');
        Route::get('/building/get/{building}/{unit}', 'Property\BuildingController@getBuilding');

        Route::get('/building/switch/{building}', 'Property\BuildingController@SwitchBuilding');

        //Unit
        Route::get('/unit', 'Property\UnitController@index');
        Route::get('/unit/data/{building}', 'Property\UnitController@getData');
        Route::get('/unit/add', 'Property\UnitController@getAdd');
        Route::post('/unit/add/{building}', 'Property\UnitController@Add');
        Route::post('/unit/duplicate/{unit_id}', 'Property\UnitController@Duplicate');
        Route::get('/unit/total/{building}', 'Property\UnitController@getAdd');
        Route::get('/unit/edit/{unit_id}', 'Property\UnitController@getEdit');
        Route::post('/unit/edit/{unit_id}', 'Property\UnitController@Edit');
        Route::post('/unit/remove/{unit_id}', 'Property\UnitController@Destroy');
        Route::get('/unit/get/{building}', 'Property\UnitController@getUnits');



        //Work Order
        Route::get('/work_order', 'Property\WorkOrderController@index');
        Route::get('/work_order/data', 'Property\WorkOrderController@getData');
        Route::get('/work_order/add', 'Property\WorkOrderController@getAdd');
        Route::post('/work_order/add', 'Property\WorkOrderController@Add');
        Route::get('/work_order/view/{work_order_id}', 'Property\WorkOrderController@getView');
        Route::get('/work_order/edit/{work_order_id}', 'Property\WorkOrderController@getEdit');
        Route::post('/work_order/edit/{work_order_id}', 'Property\WorkOrderController@Edit');
        Route::post('/work_order/remove/{work_order_id}', 'Property\WorkOrderController@Destroy');
        Route::post('/work_order/auth/add', 'Property\WorkOrderController@ApiAdd');
        Route::get('/work_order/pdf', 'Property\WorkOrderController@getPdf');

        //Add Sub Users
        Route::get('/sub_users','User\UserController@index');
        Route::get('/sub_users/data', 'User\UserController@getData');
        Route::get('/sub_users/add', 'User\UserController@getAdd');
        Route::post('/sub_users/store','User\UserController@store');
        Route::post('/sub_users/remove/{id}', 'User\UserController@Destroy');
        Route::get('/sub_users/edit/{id}', 'User\UserController@getEdit');
        Route::post('/sub_users/edit/{id}', 'User\UserController@edit');
        Route::get('/sub_users/view/{id}', 'User\UserController@getView');
       // Route::get('/sub_users/data', 'SubUserController@getData');
       // Route::post('/sub_users/Add', 'SubUserController@@Add');

        //inventory
        Route::get('/inventory','Inventory\InventoryControllers@index');
        Route::get('/inventory/add','Inventory\InventoryControllers@getAdd');
        Route::post('/inventory/store','Inventory\InventoryControllers@store');
        Route::get('/inventory/data', 'Inventory\InventoryControllers@getData');
        Route::get  ('/inventory/remove/{id}', 'Inventory\InventoryControllers@destroy');
        Route::get('/inventory/view/{id}', 'Inventory\InventoryControllers@getView');
        Route::post('/inventory/edit/{id}', 'Inventory\InventoryControllers@edit');
        Route::get('/inventory/edit/{id}', 'Inventory\InventoryControllers@getEdit');

        //Expense
        Route::get('/expense/data/{work_order_id}', 'Property\ExpenseController@getData');
        Route::get('/expense/add/{work_order_id}', 'Property\ExpenseController@getAdd');
        Route::post('/expense/add', 'Property\ExpenseController@Add');
        Route::get('/expense/edit/{building}', 'Property\ExpenseController@getEdit');
        Route::post('/expense/edit/{building}', 'Property\ExpenseController@Edit');
        Route::post('/expense/remove/{building}', 'Property\ExpenseController@Destroy');



        //Tenants
        Route::get('/tenants', 'Applicant\TenantController@index');
        Route::get('/tenants/data', 'Applicant\TenantController@getData');
        Route::get('/tenant/add', 'Applicant\TenantController@getAdd');
        Route::post('/tenant/add', 'Applicant\TenantController@Add');
        Route::get('/tenant/view/{tenant_id}', 'Applicant\TenantController@getView');
        Route::get('/tenant/edit/{tenant_id}', 'Applicant\TenantController@getEdit');
        Route::post('/tenant/edit/{tenant_id}', 'Applicant\TenantController@Edit');
        Route::post('/tenant/remove/{tenant_id}', 'Applicant\TenantController@Destroy');
        Route::post('/tenants/auth', 'Applicant\TenantController@getAuth');

        //Applicant
        Route::get('/applicant', 'Applicant\ApplicantController@index');
        Route::get('/applicant/data', 'Applicant\ApplicantController@getData');
        Route::get('/applicant/add', 'Applicant\ApplicantController@getAdd');
        Route::post('/applicant/add', 'Applicant\ApplicantController@Add');
        Route::get('/applicant/view/{tenant_id}', 'Applicant\ApplicantController@getView');
        Route::get('/applicant/edit/{tenant_id}', 'Applicant\ApplicantController@getEdit');
        Route::get('/applicant/detail/{applicant_id}', 'Applicant\ApplicantController@Detail');
        Route::post('/applicant/edit/{tenant_id}', 'Applicant\ApplicantController@Edit');
        Route::post('/applicant/remove/{tenant_id}', 'Applicant\ApplicantController@Destroy');


        //LEASE
        Route::get('/lease', 'Transaction\LeaseController@getLease');
        Route::post('/lease', 'Transaction\LeaseController@Lease');


        //Payment
		Route::get('/payment/data', 'Transaction\PaymentController@getData');
	    Route::get('/payment', 'Transaction\PaymentController@index');
        Route::get('/payment/{lease_id}', 'Transaction\PaymentController@getLeasePayment');
        Route::post('/payment/{lease_id}', 'Transaction\PaymentController@paymentDone');
        Route::get('/Noofday/{payment_id}', 'Transaction\PaymentController@NoOfdays');
		Route::get('/notification/{lease_id}', 'Transaction\PaymentController@SendNotification');
        Route::get('/payment/add/{id}', 'Transaction\AddPayment@getAdd');
        Route::post('/transaction/store', 'Transaction\AddPayment@store');
        Route::get('payment/view/{id}', 'Transaction\PaymentController@getPaymentHistory');
        Route::get('/payment/add/{payment_id}', 'Transaction\PaymentController@getAdd');


        Route::resource('rentroll', 'Transaction\RentRollController');
        Route::get('/prospect/data', 'Applicant\ProspectController@getData');
        Route::get('applicants/{id}/modify', 'Applicant\ProspectController@manualForm');
        Route::get('applicants/{id}/notification', 'Applicant\ProspectController@sendNotification');
        Route::get('applicants/new-rental-application', 'Applicant\ProspectController@application');
        Route::resource('applicants', 'Applicant\ProspectController');
        Route::get('outstanding-balance/data', 'Transaction\OutstandingBalanceController@getData');
        Route::resource('outstanding-balance', 'Transaction\OutstandingBalanceController');
        Route::get('vendors/data', 'Inventory\VendorController@getData');
        Route::resource('vendors', 'Inventory\VendorController');
        Route::get('vendors-category/data', 'Inventory\VendorCategoryController@getData');
        Route::resource('vendors-category', 'Inventory\VendorCategoryController');
        Route::get('account/data', 'System\AccountController@getData');
        Route::get('show-building', 'Common\DashboardController@showBuilding');
        Route::resource('account', 'System\AccountController');
        //task
        Route::get('task/data', 'Common\TaskController@getData');
        Route::get('{type}-task', 'Common\TaskController@index');
        Route::get('{type}-task/create', 'Common\TaskController@create');
        Route::get('{type}-task/{id}/edit', 'Common\TaskController@edit');

        Route::resource('task', 'Common\TaskController');



    });
 });
/*            Mail::send('emails.test', ['user' => 'jaffaraza@gmail.com'], function ($m) {
                $m->from('hello@app.com', 'Your Application');

                $m->to('jaffaraza@gmail.com', 'raza')->subject('Your Reminder!');
            });*/