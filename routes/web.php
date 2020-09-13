<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();


//RUTAS PUBLICA PRINCIPAL DE LA WEB

Route::get('/', 'WebController@index')->name('index');
Route::get('categorias', 'WebController@categories')->name('categorias');
Route::get('contactos', 'WebController@contact')->name('contactos');
Route::post('enviar-mensaje', 'WebController@senMessage')->name('enviar-mensaje');
Route::get('descargar-aplicacion','HomeController@downloadapk')->name('descargar-aplicacion');


//RUTAS PARA LAS SOLICITUDES DEL EMPRESARIO Y REPARTIDOR
Route::get('empresa', 'RequestForm@createMerchant')->name('empresa');
Route::get('repartidor', 'RequestForm@createdeliveryMan')->name('repartidor');
Route::post('store-merchant', 'RequestForm@storeMarchant')->name('store-merchant');
Route::post('store-deliveryman', 'RequestForm@storeDeliveryMan')->name('store-deliveryman');
Route::get('download-pdf-request-merchant/{id}', 'RequestForm@downloadpdf')->name('download-pdf-request-merchant');
Route::get('download-pdf-request-delivery/{id}', 'RequestForm@downloadpdfReuestDelivery')->name('download-pdf-request-delivery');
Route::get('merchant', function () {
    return view('forms.merchant');
});
Route::get('deliveryman', function () {
    return view('forms.deliveryman');
});

Route::get('download-pdf-convenio/{id}', 'admin\ConvenioController@downloadpdf')->name('download-pdf-convenio');
Route::get('download-word-convenio/{id}', 'admin\ConvenioController@downloadword')->name('download-word-convenio');



Route::middleware('auth')->group(function () {

    Route::get('admin', 'HomeController@index')->name('admin');
    Route::get('/home', 'HomeController@index')->name('home');


    //RUTAS PARA VER LOS MENSAJES
    Route::get('get-messages', 'WebController@getMessages')->name('get-messages');
///RUTAS PARA GESTIONAR LOS ROLES Y PERMISOS
    Route::get('roles', 'admin\RoleController@getRoles')->name('roles');
    Route::get('permissions/{id}', 'admin\RoleController@getPermissions')->name('permissions');
    Route::get('get-roles', 'admin\RoleController@index')->name('get-roles')->middleware('permission:crear rol|leer rol|modificar rol|eliminar rol');
    Route::get('create-roles', 'admin\RoleController@create')->name('create-role');
    Route::post('store-role', 'admin\RoleController@store')->name('store-role');
    Route::get('edit-role/{id}', 'admin\RoleController@edit')->name('edit-role');
    Route::put('update-role/{id}', 'admin\RoleController@update')->name('update-role');
    Route::delete('delete-role/{id}', 'admin\RoleController@deleteRole')->name('delete-role');
    Route::put('deactivate-role', 'admin\RoleController@deactivateRole')->name('deactivate-role');


//RUTAS PARA LAS CATEGORIAS
    Route::get('categories/{id}', 'admin\CategoryController@getCategories')->name('categories');
    Route::get('get-category', 'admin\CategoryController@index')->name('get-category');
    Route::get('edit-category/{id}', 'admin\CategoryController@edit')->name('edit-category');
    Route::post('store-category', 'admin\CategoryController@store')->name('store-category');
    Route::put('update-category/{id}', 'admin\CategoryController@update')->name('update-category');
    Route::delete('delete-category/{id}', 'admin\CategoryController@update')->name('delete-category');
    Route::put('deactivate-category', 'admin\CategoryController@deactivate')->name('deactivate-category');


//RUTAS PARA LAS SUBCATEGORIAS
    Route::get('subcategories', 'admin\SubCategoryController@getCategories')->name('subcategories');
    Route::get('get-subcategory', 'admin\SubCategoryController@index')->name('get-subcategory');
    Route::get('edit-subcategory/{id}', 'admin\SubCategoryController@edit')->name('edit-subcategory');
    Route::post('store-subcategory', 'admin\SubCategoryController@store')->name('store-subcategory');
    Route::put('update-subcategory/{id}', 'admin\SubCategoryController@update')->name('update-subcategory');
    Route::delete('delete-subcategory/{id}', 'admin\SubCategoryController@update')->name('delete-subcategory');
    Route::put('deactivate-subcategory', 'admin\SubCategoryController@deactivate')->name('deactivate-subcategory');


//RUTAS PARA LOS PRODUCTOS
    Route::get('products/{id}', 'admin\ProductController@getProducts')->name('products');
    Route::get('create-product', 'admin\ProductController@create')->name('create-product');
    Route::get('get-product', 'admin\ProductController@index')->name('get-product');
    Route::get('edit-product/{id}', 'admin\ProductController@edit')->name('edit-product');
    Route::post('store-product', 'admin\ProductController@store')->name('store-product');
    Route::put('update-product/{id}', 'admin\ProductController@update')->name('update-product');
    Route::delete('delete-product/{id}', 'admin\ProductController@update')->name('delete-product');
    Route::put('deactivate-product', 'admin\ProductController@deactivate')->name('deactivate-product');
    Route::get('get-form-product/{id}', 'admin\ProductController@getForm')->name('get-form-product');


//RUTAS PARA LOS USUARIOS
    Route::get('users', 'admin\UserController@getUsers')->name('users');
    Route::get('create-user', 'admin\UserController@create')->name('create-user');
    Route::get('profile', 'admin\UserController@show')->name('profile');
    Route::put('update-profile/{id}', 'admin\UserController@updateProfile')->name('update-profile');
    Route::put('update-password/{id}', 'admin\UserController@updatePassword')->name('update-password');
    Route::get('get-user', 'admin\UserController@index')->name('get-user');
    Route::get('edit-user/{id}', 'admin\UserController@edit')->name('edit-user');
    Route::post('store-user', 'admin\UserController@store')->name('store-user');
    Route::put('update-user/{id}', 'admin\UserController@update')->name('update-user');
    Route::delete('delete-user/{id}', 'admin\UserController@update')->name('delete-user');
    Route::put('deactivate-user', 'admin\UserController@deactivate')->name('deactivate-user');


    ///RUTAS CLIENTES
    Route::get('customers', 'admin\UserController@getCustomers')->name('customers');

//RUTAS PARA LOS EMPRESARIOS
    Route::get('get-request-merchants', 'admin\MerchantController@getRequestMerchants')->name('get-request-merchants');
    Route::get('show-request-merchants/{id}', 'admin\MerchantController@showRequest')->name('show-request-merchants');
    Route::post('store-request-merchants/{id}', 'admin\MerchantController@store')->name('store-request-merchants');
    Route::get('get-merchants', 'admin\MerchantController@index')->name('get-merchants');
    Route::get('create-merchant-profile/{id}', 'admin\MerchantController@createProfile')->name('create-merchant-profile');

//RUTAS PARA LAS COMPANIAS
    Route::get('edit-company-merchant/{id}', 'admin\CompanyController@edit')->name('edit-company-merchant');
    Route::put('update-company-merchant/{id}', 'admin\CompanyController@update')->name('update-company-merchant');
    Route::get('get-table-companies/{id}', 'admin\CompanyController@getCompanies')->name('get-table-companies');
    Route::put('deactivate-company-merchant', 'admin\CompanyController@deactivate')->name('deactivate-company-merchant');
    Route::get('download-pdf-company/{id}', 'admin\CompanyController@downloadpdf')->name('download-pdf-company');
//RUTAS PARA LOS REPARTIDORES
    Route::get('get-request-deliverymen', 'admin\DeliveryManController@getRequestDeliveryMen')->name('get-request-deliverymen');
    Route::get('show-request-delivery/{id}', 'admin\DeliveryManController@showRequest')->name('show-request-delivery');
    Route::post('store-request-delivery/{id}', 'admin\DeliveryManController@store')->name('store-request-delivery');
    Route::get('get-deliverymen', 'admin\DeliveryManController@index')->name('get-deliverymen');
    Route::get('get-deliveryman/{id}', 'admin\DeliveryManController@edit')->name('get-deliveryman');
    Route::put('update-deliveryman/{id}', 'admin\DeliveryManController@update')->name('update-deliveryman');


//RUTAS PARA LAS TIPOS DE EMPRESAS
    Route::get('companies', 'admin\CompanyTypeController@getCompanies')->name('companies');
    Route::get('get-company', 'admin\CompanyTypeController@index')->name('get-company');
    Route::get('edit-company/{id}', 'admin\CompanyTypeController@edit')->name('edit-company');
    Route::post('store-company', 'admin\CompanyTypeController@store')->name('store-company');
    Route::put('update-company/{id}', 'admin\CompanyTypeController@update')->name('update-company');
    Route::delete('delete-company/{id}', 'admin\CompanyTypeController@update')->name('delete-company');
    Route::put('deactivate-company', 'admin\CompanyTypeController@deactivate')->name('deactivate-company');


//RUTAS PARA LAS TIPOS DE VEHICULOS
    Route::get('vehicles', 'admin\VehicleTypeController@getVehicles')->name('vehicles');
    Route::get('get-vehicle', 'admin\VehicleTypeController@index')->name('get-vehicle');
    Route::get('edit-vehicle/{id}', 'admin\VehicleTypeController@edit')->name('edit-vehicle');
    Route::post('store-vehicle', 'admin\VehicleTypeController@store')->name('store-vehicle');
    Route::put('update-vehicle/{id}', 'admin\VehicleTypeController@update')->name('update-vehicle');
    Route::delete('delete-vehicle/{id}', 'admin\VehicleTypeController@update')->name('delete-vehicle');
    Route::put('deactivate-vehicle', 'admin\VehicleTypeController@deactivate')->name('deactivate-vehicle');


    //RUTAS PARA LAS CONFIGURACION DE LA WEB
    Route::get('web-index', 'admin\SliderController@index')->name('web-index');
    Route::get('create-web', 'admin\SliderController@create')->name('create-web');
    Route::post('store-web', 'admin\SliderController@store')->name('store-web');
    Route::get('edit-web/{id}', 'admin\SliderController@edit')->name('edit-web');
    Route::put('update-web/{id}', 'admin\SliderController@update')->name('update-web');
    Route::put('delete-web', 'admin\SliderController@delete')->name('delete-web');
    Route::put('change-status-web', 'admin\SliderController@ChangeStatus')->name('change-status-web');
    Route::get('get-sliders', 'admin\SliderController@getSliders')->name('get-sliders');
    Route::get('order-slider', 'admin\SliderController@changeOrder')->name('order-slider');
    Route::put('update-order-slider', 'admin\SliderController@updateOrder')->name('update-order-slider');

    ///RUTAS PARA LOS CONVENIOS
    Route::get('create-convenio', 'admin\ConvenioController@create')->name('create-convenios');
    Route::post('store-convenio', 'admin\ConvenioController@store')->name('create-store');
    Route::put('update-convenio/{id}', 'admin\ConvenioController@update')->name('update-convenios');
    Route::post('delete-convenio', 'admin\ConvenioController@delete')->name('delete-convenios');
    Route::get('index-convenio', 'admin\ConvenioController@index')->name('index-convenios');
    Route::get('edit-convenio/{id}', 'admin\ConvenioController@edit')->name('edit-convenio');
    Route::get('get-convenios', 'admin\ConvenioController@getConvenio')->name('get-convenios');
    Route::get('show-convenio/{id}', 'admin\ConvenioController@show')->name('show-convenio');

    ///RUTAS ORDENES
    Route::get('get-pdf-order/{id}', 'admin\OrderController@generatePDFOrder')->name('get-pdf-order');
    Route::get('get-company-orders','admin\OrderController@index')->name('get-company-orders');


    ///URL REPORTES
    Route::get('get-pdf-users', 'admin\UserController@getPdfUsers')->name('get-pdf-users');
    Route::get('get-pdf-customers', 'admin\UserController@getPdfCustomers')->name('get-pdf-customers');
    Route::get('get-pdf-merchants', 'admin\MerchantController@getPdfMerchant')->name('get-pdf-merchants');
    Route::get('get-pdf-companies', 'admin\MerchantController@getPdfCompanies')->name('get-pdf-companies');
    Route::get('get-pdf-deliveryman', 'admin\DeliveryManController@getPdfDeliveryMan')->name('get-pdf-deliveryman');
    Route::get('get-pdf-products', 'admin\ProductController@getPdfCompaniesProducts')->name('get-pdf-products');
    Route::get('get-report-orders', 'admin\ReportController@index')->name('get-report-orders');
    Route::get('get-pdf-report-orders', 'admin\ReportController@getPdf')->name('get-pdf-report-orders');
    Route::get('get-request-products', 'admin\RequestProductController@create')->name('get-request-products');
   


   
});

//RUTAS PARA LAS SOLICITUDES DE PRODUCTOS
    Route::get('solicitud-productos','admin\RequestProductController@index')->name('solicitud-productos');
    Route::post('send-request-product','admin\RequestProductController@store')->name('send-request-product');
    Route::get('download-image-request-product/{id}','admin\RequestProductController@downloadImage')->name('download-image-request-product');
