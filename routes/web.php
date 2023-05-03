<?php
use App\Models\Setting;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\WEB\Admin\LandingPageController;
use App\Models\Cart;
use Illuminate\Support\Carbon;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    Route::get('/failPayment', function () { return view('website.fail');})->name('failPayment');
    Route::get('/successPayment', function () { return view('website.success'); })->name('successPayment');
    Route::get('/payment', function () {  return view('website.payment'); })->name('payment');

    Route::get('forgot/password', 'Auth\ForgotPasswordController@forgotPasswordForm')->name('forgotPasswordForm');
    Route::post('sendResetLinkEmail', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('sendResetLinkEmail');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.new');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::get('/', 'WEB\Site\HomeController@index')->name('home');
    Route::get('/about', 'WEB\Site\HomeController@about')->name('about');
    Route::get('/services', 'WEB\Site\HomeController@services')->name('services');
    Route::get('/projects', 'WEB\Site\HomeController@projects')->name('projects');
    Route::get('/chairman', 'WEB\Site\HomeController@chairman')->name('chairman');
    Route::get('/team', 'WEB\Site\HomeController@team')->name('team');
    Route::get('/partners', 'WEB\Site\HomeController@partners')->name('partners');
    Route::get('/contact', 'WEB\Site\HomeController@contact')->name('contact');
    
    Route::post('/storeQuote', 'WEB\Site\HomeController@storeQuote')->name('storeQuote');


    Route::group(['middleware' => ['auth']], function () {

    });


       //ADMIN AUTH ///
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', function () {
            return route('/login');
        });
        Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login.form');
        Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login');
        Route::get('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
    });


    Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin', 'as' => 'admin.',], function () {
        Route::get('/', function () { return redirect('/admin/home');  });
        Route::post('/changeStatus/{model}', 'WEB\Admin\HomeController@changeStatus');

        Route::get('home', 'WEB\Admin\HomeController@index')->name('admin.home');

        Route::get('/admins/{id}/edit', 'WEB\Admin\AdminController@edit')->name('admins.edit');
        Route::patch('/admins/{id}', 'WEB\Admin\AdminController@update')->name('users.update');
        Route::get('/admins/{id}/edit_password', 'WEB\Admin\AdminController@edit_password')->name('admins.edit_password');
        Route::post('/admins/{id}/edit_password', 'WEB\Admin\AdminController@update_password')->name('admins.edit_password');


        Route::get('/admins', 'WEB\Admin\AdminController@index')->name('admins.all');
        Route::post('/admins/changeStatus', 'WEB\Admin\AdminController@changeStatus')->name('admin_changeStatus');
        Route::delete('admins/{id}', 'WEB\Admin\AdminController@destroy')->name('admins.destroy');
        Route::post('/admins', 'WEB\Admin\AdminController@store')->name('admins.store');
        Route::get('/admins/create', 'WEB\Admin\AdminController@create')->name('admins.create');
        Route::get('/editMyProfile', 'WEB\Admin\AdminController@editMyProfile')->name('admins.editMyProfile');
        Route::post('/updateProfile', 'WEB\Admin\AdminController@updateProfile')->name('admins.updateProfile');
        Route::get('/changeMyPassword', 'WEB\Admin\AdminController@changeMyPassword')->name('admins.changeMyPassword');
        Route::post('/updateMyPassword', 'WEB\Admin\AdminController@updateMyPassword')->name('admins.updateMyPassword');



        Route::get('/users', 'WEB\Admin\UsersController@index')->name('users.all');
        Route::post('/users', 'WEB\Admin\UsersController@store')->name('users.store');
        Route::get('/users/create', 'WEB\Admin\UsersController@create')->name('users.create');
        Route::delete('users/{id}', 'WEB\Admin\UsersController@destroy')->name('users.destroy');
        Route::get('/users/{id}/edit', 'WEB\Admin\UsersController@edit')->name('users.edit');
        Route::get('/users/{id}/show', 'WEB\Admin\UsersController@show')->name('users.show');
        Route::get('/users/{id}/orders', 'WEB\Admin\UsersController@orders')->name('users.orders');
        Route::get('/users/{id}/{order_id}/editOrder', 'WEB\Admin\UsersController@editOrder')->name('users.editOrder');
        Route::patch('/users/{id}', 'WEB\Admin\UsersController@update')->name('users.update');
        Route::get('/users/{id}/edit_password', 'WEB\Admin\UsersController@edit_password')->name('users.edit_password');
        Route::post('/users/{id}/edit_password', 'WEB\Admin\UsersController@update_password')->name('users.edit_password');
        Route::get('/exportUsers', 'WEB\Admin\UsersController@exportUsers');
        Route::get('/pdfUsers', 'WEB\Admin\UsersController@pdfUsers');

        Route::resource('/orders', 'WEB\Admin\OrderController');

        Route::get('getNewOrdersCount/orders','WEB\Admin\OrderController@getNewOrdersCount');
        Route::get('invoice/orders/{id}','WEB\Admin\OrderController@invoice')->name('invoice');
        Route::get('refund/orders/{id}','WEB\Admin\OrderController@refund');
        Route::get('changeOrdersCount/orders','WEB\Admin\OrderController@changeOrdersCount');
        Route::post('/orders/changeStatus/{id}', 'WEB\Admin\OrderController@changeStatus')->name('changeOrderStatus');
        Route::get('/report/orders', 'WEB\Admin\OrderController@report')->name('ordersReport');
        Route::get('/pdfOrders', 'WEB\Admin\OrderController@pdfOrders');
        Route::get('/export/excel/orders', 'WEB\Admin\OrderController@OrdersExportForAdmin');
        Route::get('/OrdersReportForAdmin/excel/orders', 'WEB\Admin\OrderController@OrdersReportForAdmin');


        Route::get('/contacts', 'WEB\Admin\ContactController@index');
        Route::get('/contacts/{id}/show', 'WEB\Admin\ContactController@show');
        Route::patch('/contacts/{id}', 'WEB\Admin\ContactController@update');
        Route::get('/export/excel/contacts', 'WEB\Admin\ContactController@exportExcel');
        Route::get('/pdfContacts', 'WEB\Admin\ContactController@pdfContacts');


        Route::get('settings', 'WEB\Admin\SettingController@index')->name('settings.all');
        Route::post('settings', 'WEB\Admin\SettingController@update')->name('settings.update');

        Route::get('system_maintenance', 'WEB\Admin\SettingController@system_maintenance')->name('system.maintenance');
        Route::post('system_maintenance', 'WEB\Admin\SettingController@update_system_maintenance')->name('update.system.maintenance');


        Route::resource('/pages', 'WEB\Admin\PagesController');
        Route::resource('/roles', 'WEB\Admin\RolesController');
        Route::resource('/notifications', 'WEB\Admin\NotificationsController');
        Route::get('logs', 'WEB\Admin\LogController@index');


    });




    Route::group(['prefix' => 'provider'], function () {
        Route::get('/', function () {
            return route('/login');
        });
        Route::get('/login', 'SubAdminAuth\LoginController@showLoginForm')->name('subadmin.login.form');
        Route::post('/login', 'SubAdminAuth\LoginController@login')->name('subadmin.login');
        Route::get('/logout', 'SubAdminAuth\LoginController@logout')->name('subadmin.logout');

    });
    Route::group(['middleware' => ['web', 'subadmin'], 'prefix' => 'provider', 'as' => 'provider.',], function () {
        Route::get('/', function () {
            return redirect('/provider/home');
        });
        Route::post('/changeStatus/{model}', 'WEB\SubAdmin\HomeController@changeStatus');

        Route::get('home', 'WEB\SubAdmin\HomeController@index')->name('provider.home');


        Route::get('/editMyProfile', 'WEB\SubAdmin\SubAdminController@editMyProfile')->name('provider.editMyProfile');
        Route::post('/updateProfile', 'WEB\SubAdmin\SubAdminController@updateProfile')->name('provider.updateProfile');

        Route::get('/categories/{id}/meals', 'WEB\SubAdmin\CategoryController@meals');
        Route::resource('/categories', 'WEB\SubAdmin\CategoryController');

        Route::get('/report/meals', 'WEB\SubAdmin\MealController@report')->name('mealsReport');
//        Route::get('/export/excel/meals', 'WEB\SubAdmin\MealController@exportExcel');
        Route::get('/MealsReportForProvider/excel/meals', 'WEB\SubAdmin\MealController@MealsReportForProvider');
        Route::resource('/meals', 'WEB\SubAdmin\MealController');
        Route::get('/meals/{id}/options', 'WEB\SubAdmin\MealController@options');
        Route::get('/meals/{id}/createOption', 'WEB\SubAdmin\MealController@createOption');
        Route::post('/meals/{id}/storeOption', 'WEB\SubAdmin\MealController@storeOption');
        Route::get('/meals/{id}/editOption', 'WEB\SubAdmin\MealController@editOption');
        Route::post('/meals/{id}/updateOption', 'WEB\SubAdmin\MealController@updateOption');
        Route::delete('/meals/{id}/deleteOption', 'WEB\SubAdmin\MealController@deleteOption');
        Route::delete('/meals/{id}/deleteOffer', 'WEB\SubAdmin\MealController@deleteOffer');

        Route::resource('/option_values', 'WEB\SubAdmin\OptionValueController');

        Route::get('getNewOrdersCount/orders','WEB\SubAdmin\OrderController@getNewOrdersCount');
        Route::get('invoice/orders/{id}','WEB\SubAdmin\OrderController@invoice')->name('invoice');
        Route::get('refund/orders/{id}','WEB\Admin\OrderController@refund');
        Route::get('changeOrdersCount/orders','WEB\SubAdmin\OrderController@changeOrdersCount');
        Route::post('/orders/changeStatus/{id}', 'WEB\Admin\OrderController@changeStatus')->name('changeOrderStatus');
        Route::get('/report/orders', 'WEB\SubAdmin\OrderController@report')->name('ordersReport');
        Route::get('/pdfOrders', 'WEB\SubAdmin\OrderController@pdfOrders');
        Route::get('/OrdersExportForProvider/excel/orders', 'WEB\SubAdmin\OrderController@exportExcel');
        Route::get('/OrdersReportForProvider/excel/orders', 'WEB\SubAdmin\OrderController@OrdersReportForProvider');
        Route::resource('/orders', 'WEB\SubAdmin\OrderController');

        Route::get('settings', 'WEB\SubAdmin\SettingController@index');
        Route::post('settings', 'WEB\SubAdmin\SettingController@update');

    });

     Route::get('/{id}/{slug}', 'WEB\Site\HomeController@deep')->name('deep');


});

