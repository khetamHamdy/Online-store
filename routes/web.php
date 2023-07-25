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
use Illuminate\Support\Carbon;

Route::get('/', 'App\Http\Controllers\WEB\Site\HomeController@index')->name('home');
Route::post('/currency-conveter', 'App\Http\Controllers\WEB\Site\CurrencyConverterController@store')->name('currency.store');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
//    Route::get('/failPayment', function () {
//        return view('website.fail');
//    })->name('failPayment');
//    Route::get('/successPayment', function () {
//        return view('website.success');
//    })->name('successPayment');
//    Route::get('/payment', function () {
//        return view('website.payment');
//    })->name('payment');

    Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

    Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegisterForm')->name('register.form');
    Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');


    Route::get('/checkout', 'App\Http\Controllers\WEB\Site\OrderController@index_checkout')->name('checkout');


    Route::get('/order/{token}/pay', 'App\Http\Controllers\WEB\Site\PaymentController@redirectToPayment')->name('orders.payment.create');

    Route::post('/order/{token}/pay/stripe/callback', 'App\Http\Controllers\WEB\Site\PaymentController@postPayment')
        ->name('postPayment');

    Route::post('/order/stripe/failPayment', 'App\Http\Controllers\WEB\Site\PaymentController@failPayment')
        ->name('failPayment');

    Route::get('/order/stripe/successPayment', 'App\Http\Controllers\WEB\Site\PaymentController@successPayment')
        ->name('successPayment');

//    Route::get('forgot/password', 'Auth\ForgotPasswordController@forgotPasswordForm')->name('forgotPasswordForm');
//    Route::post('sendResetLinkEmail', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('sendResetLinkEmail');
//    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.new');
//    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

    Route::get('/', 'App\Http\Controllers\WEB\Site\HomeController@index')->name('home');
    Route::get('/products-all', 'App\Http\Controllers\WEB\Site\HomeController@productAll')->name('products-all');
    Route::get('/search-products', 'App\Http\Controllers\WEB\Site\HomeController@search_products')->name('search.products');
    Route::get('/get-category-products/{id}', 'App\Http\Controllers\WEB\Site\HomeController@category_products');

    Route::resource('/cart', 'App\Http\Controllers\WEB\Site\CartController');
    Route::post('/update-quantity', 'App\Http\Controllers\WEB\Site\CartController@update_quantity');
    Route::post('/contact_store', 'App\Http\Controllers\WEB\Site\HomeController@storeQuote')->name('contact.store');

    Route::get('product-details/{id}', function () {
        return view('website.product-details');
    })->name('product_details');


    Route::get('/pages/{slug}', 'App\Http\Controllers\WEB\Site\HomeController@pages')->name('pages');
//    Route::get('/services', 'App\Http\Controllers\WEB\Site\HomeController@services')->name('services');
//    Route::get('/service/{id}/{slug?}','App\Http\Controllers\WEB\Site\HomeController@service')->name('service');
//
//    Route::get('/projects', 'App\Http\Controllers\WEB\Site\HomeController@projects')->name('projects');
//    Route::get('/chairman', 'App\Http\Controllers\WEB\Site\HomeController@chairman')->name('chairman');
//    Route::get('/team', 'App\Http\Controllers\WEB\Site\HomeController@team')->name('team');
//    Route::get('/partners', 'App\Http\Controllers\WEB\Site\HomeController@partners')->name('partners');
//    Route::get('/contact', 'App\Http\Controllers\WEB\Site\HomeController@contact')->name('contact');

//    Route::post('/storeQuote', 'App\Http\Controllers\WEB\Site\HomeController@storeQuote')->name('storeQuote');


    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('/profile', 'App\Http\Controllers\WEB\Site\UserController@profile')->name('profile');
        Route::post('/profile', 'App\Http\Controllers\WEB\Site\UserController@edit_profile')->name('edit-profile');

        Route::get('/change_password', 'App\Http\Controllers\WEB\Site\UserController@change_password')->name('change_password.form');
        Route::post('/change_password/{id}', 'App\Http\Controllers\WEB\Site\UserController@edit_change_password')->name('change_password');

        Route::get('my_address', function () {
            return view('website.my-address');
        })->name('my_address.form');

        Route::get('/my_address', 'App\Http\Controllers\WEB\Site\UserController@my_address')->name('my_address.form');
        Route::post('/my_address', 'App\Http\Controllers\WEB\Site\UserController@edit_my_address')->name('my_address');

        Route::post('/create_address', 'App\Http\Controllers\WEB\Site\UserController@create_my_address')->name('create_my_address');

//        Route::delete('/userAddress', 'App\Http\Controllers\WEB\Site\UserController@delete_my_address')->name('userAddress');

        Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

        Route::get('/my-order', 'App\Http\Controllers\WEB\Site\UserController@my_order')->name('my_order.form');
        Route::get('/order-details/{id}', 'App\Http\Controllers\WEB\Site\UserController@order_details')->name('order_details');

        Route::post('/changeStatusAddress', 'App\Http\Controllers\WEB\Site\UserController@changeStatusAddress');

        Route::get('/checkout-user', 'App\Http\Controllers\WEB\Site\OrderController@index')->name('checkout-user');
        Route::post('/checkout-user', 'App\Http\Controllers\WEB\Site\OrderController@store')->name('checkout-user.store');
        Route::get("/address/{id}/edit", 'App\Http\Controllers\WEB\Site\UserController@edit_address');
        Route::get("/address/{id}/delete", 'App\Http\Controllers\WEB\Site\UserController@delete_address');

    });

    //ADMIN AUTH ///
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', function () {
            return route('/login');
        });
        Route::get('/login', 'App\Http\Controllers\AdminAuth\LoginController@showLoginForm')->name('admin.login.form');
        Route::post('/login', 'App\Http\Controllers\AdminAuth\LoginController@login')->name('admin.login');
        Route::get('/logout', 'App\Http\Controllers\AdminAuth\LoginController@logout')->name('admin.logout');
    });

    Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin', 'as' => 'admin.',], function () {
        Route::get('/', function () {
            return redirect('/admin/home');
        });
        Route::post('/changeStatus/{model}', 'App\Http\Controllers\WEB\Admin\HomeController@changeStatus');

        Route::get('home', 'App\Http\Controllers\WEB\Admin\HomeController@index')->name('admin.home');
        Route::get('get-data', 'App\Http\Controllers\WEB\Admin\HomeController@getData')->name('getData');
        Route::get('homePage', 'App\Http\Controllers\WEB\Admin\HomePageController@index')->name('homePage.index');
        Route::post('homePage', 'App\Http\Controllers\WEB\Admin\HomePageController@update')->name('homePage.update');

        Route::get('/admins/{id}/edit', 'App\Http\Controllers\WEB\Admin\AdminController@edit')->name('admins.edit');
        Route::patch('/admins/{id}', 'App\Http\Controllers\WEB\Admin\AdminController@update')->name('users.update');
        Route::get('/admins/{id}/edit_password', 'App\Http\Controllers\WEB\Admin\AdminController@edit_password')->name('admins.edit_password');
        Route::post('/admins/{id}/edit_password', 'App\Http\Controllers\WEB\Admin\AdminController@update_password')->name('admins.edit_password');


        Route::get('/admins', 'App\Http\Controllers\WEB\Admin\AdminController@index')->name('admins.all');
        Route::post('/admins/changeStatus', 'App\Http\Controllers\WEB\Admin\AdminController@changeStatus')->name('admin_changeStatus');
        Route::delete('admins/{id}', 'App\Http\Controllers\WEB\Admin\AdminController@destroy')->name('admins.destroy');
        Route::post('/admins', 'App\Http\Controllers\WEB\Admin\AdminController@store')->name('admins.store');
        Route::get('/admins/create', 'App\Http\Controllers\WEB\Admin\AdminController@create')->name('admins.create');
        Route::get('/editMyProfile', 'App\Http\Controllers\WEB\Admin\AdminController@editMyProfile')->name('admins.editMyProfile');
        Route::post('/updateProfile', 'App\Http\Controllers\WEB\Admin\AdminController@updateProfile')->name('admins.updateProfile');
        Route::get('/changeMyPassword', 'App\Http\Controllers\WEB\Admin\AdminController@changeMyPassword')->name('admins.changeMyPassword');
        Route::post('/updateMyPassword', 'App\Http\Controllers\WEB\Admin\AdminController@updateMyPassword')->name('admins.updateMyPassword');

        Route::resource('/product', 'App\Http\Controllers\WEB\Admin\ProductController');
        Route::get('/order-export', 'App\Http\Controllers\WEB\Admin\UsersController@exportExcel');

        Route::get('/product-export', 'App\Http\Controllers\WEB\Admin\ProductController@exportProducts');

        Route::get('/product-trash', 'App\Http\Controllers\WEB\Admin\ProductController@trash');
        Route::get('/product-forceDelete/{id}', 'App\Http\Controllers\WEB\Admin\ProductController@forceDelete');
        Route::get('/product-restore/{id}', 'App\Http\Controllers\WEB\Admin\ProductController@restore');

        Route::resource('/colors', 'App\Http\Controllers\WEB\Admin\ColorsController');
        Route::resource('/sizes', 'App\Http\Controllers\WEB\Admin\SizesController');
        Route::resource('/extra', 'App\Http\Controllers\WEB\Admin\ExtraController');
        Route::get('/product-image/{product_image_id}/delete', [\App\Http\Controllers\WEB\Admin\ProductController::class, 'deleteProductImage']);
        Route::get('/additions-delete/{id}', [\App\Http\Controllers\WEB\Admin\ProductController::class, 'deleteProductAdditions']);

        Route::get('/contacts', 'App\Http\Controllers\WEB\Admin\ContactController@index');
        Route::get('/contacts/{id}/show', 'App\Http\Controllers\WEB\Admin\ContactController@show');
        Route::patch('/contacts/{id}', 'App\Http\Controllers\WEB\Admin\ContactController@update');
        Route::get('/export/excel/contacts', 'App\Http\Controllers\WEB\Admin\ContactController@exportExcel');
        Route::get('/pdfContacts', 'App\Http\Controllers\WEB\Admin\ContactController@pdfContacts');


        Route::get('settings', 'App\Http\Controllers\WEB\Admin\SettingController@index')->name('settings.all');
        Route::post('settings', 'App\Http\Controllers\WEB\Admin\SettingController@update')->name('settings.update');

        Route::get('system_maintenance', 'App\Http\Controllers\WEB\Admin\SettingController@system_maintenance')->name('system.maintenance');
        Route::post('system_maintenance', 'App\Http\Controllers\WEB\Admin\SettingController@update_system_maintenance')->name('update.system.maintenance');

        Route::resource('/categories', 'App\Http\Controllers\WEB\Admin\CategoryController');
        Route::get('/category-products/{category_id}', 'App\Http\Controllers\WEB\Admin\CategoryController@category_products');

        Route::get('/categories-trash', 'App\Http\Controllers\WEB\Admin\CategoryController@trash');
        Route::get('/categories-forceDelete/{id}', 'App\Http\Controllers\WEB\Admin\CategoryController@forceDelete');
        Route::get('/categories-restore/{id}', 'App\Http\Controllers\WEB\Admin\CategoryController@restore');

        Route::resource('/offers', 'App\Http\Controllers\WEB\Admin\OffersController');
        Route::resource('/brand', 'App\Http\Controllers\WEB\Admin\BrandController');

        Route::resource('/pages', 'App\Http\Controllers\WEB\Admin\PagesController');
        Route::resource('/roles', 'App\Http\Controllers\WEB\Admin\RolesController');
        Route::resource('/notifications', 'App\Http\Controllers\WEB\Admin\NotificationsController');
        Route::get('logs', 'App\Http\Controllers\WEB\Admin\LogController@index');

        Route::get('/orders', 'App\Http\Controllers\WEB\Admin\UsersController@order_all');
        Route::get('/orders/{order_id}/edit', 'App\Http\Controllers\WEB\Admin\UsersController@edit_orders');
        Route::get('/orders/{order_id}/update', 'App\Http\Controllers\WEB\Admin\UsersController@update_orders');


        Route::get('/users', 'App\Http\Controllers\WEB\Admin\UsersController@index')->name('users.all');
        Route::post('/users', 'App\Http\Controllers\WEB\Admin\UsersController@store')->name('users.store');
        Route::get('/users/create', 'App\Http\Controllers\WEB\Admin\UsersController@create')->name('users.create');
        Route::delete('users/{id}', 'App\Http\Controllers\WEB\Admin\UsersController@destroy')->name('users.destroy');
        Route::get('/users/{id}/edit', 'App\Http\Controllers\WEB\Admin\UsersController@edit')->name('users.edit');
        Route::get('/users/{id}/orders', 'App\Http\Controllers\WEB\Admin\UsersController@orders')->name('users.orders');
        Route::patch('/orders/{id}', 'App\Http\Controllers\WEB\Admin\UsersController@update_order');

        Route::get('/orders-delivery/{order}', 'App\Http\Controllers\WEB\Admin\OrdersDeliveryController@show');

        Route::get('generate-invoice-pdf/{order_id}/{user_id}', 'App\Http\Controllers\WEB\Admin\UsersController@generateInvoicePDF');

        //"{{url(getLocal().'/admin/users/'.$item->id.'/'.$one->id.'/editOrder')}}"
        Route::get('/users/{user_id}/{order_id}/editOrder', 'App\Http\Controllers\WEB\Admin\UsersController@editOrder')->name('users.editOrder');

        Route::post('/users/{id}/changeOrderStatus', 'App\Http\Controllers\WEB\Admin\UsersController@changeOrderStatus')->name('changeOrderStatus');
        Route::get('/users/{id}/subscriptions', 'App\Http\Controllers\WEB\Admin\UsersController@subscriptions')->name('users.subscriptions');
        Route::get('/users/{id}/show', 'App\Http\Controllers\WEB\Admin\UsersController@show')->name('users.show');
        Route::patch('/users/{id}', 'App\Http\Controllers\WEB\Admin\UsersController@update')->name('users.update');
        Route::get('/users/{id}/edit_password', 'App\Http\Controllers\WEB\Admin\UsersController@edit_password')->name('users.edit_password');
        Route::get('/users/{id}/edit_password', 'App\Http\Controllers\WEB\Admin\UsersController@edit_password')->name('users.edit_password');

        Route::get('getItems/{req}/{product_id}', 'App\Http\Controllers\WEB\Admin\ProductController@getItems');

        Route::resource('permission', 'App\Http\Controllers\WEB\Admin\PermissionsController');
        Route::resource('/sliders', 'App\Http\Controllers\WEB\Admin\SliderController');
        Route::resource('/country', 'App\Http\Controllers\WEB\Admin\CountryController');
        Route::resource('/city', 'App\Http\Controllers\WEB\Admin\CityController');
        Route::resource('/promoCodes', 'App\Http\Controllers\WEB\Admin\PromoCodesController');


    });

});
