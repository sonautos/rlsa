<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tags
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Makes
    Route::apiResource('makes', 'MakeApiController');

    // Modeles
    Route::apiResource('modeles', 'ModeleApiController');

    // Versions
    Route::post('versions/media', 'VersionsApiController@storeMedia')->name('versions.storeMedia');
    Route::apiResource('versions', 'VersionsApiController');

    // Colors
    Route::post('colors/media', 'ColorApiController@storeMedia')->name('colors.storeMedia');
    Route::apiResource('colors', 'ColorApiController');

    // Features
    Route::post('features/media', 'FeaturesApiController@storeMedia')->name('features.storeMedia');
    Route::apiResource('features', 'FeaturesApiController');

    // Code Models
    Route::apiResource('code-models', 'CodeModelApiController');

    // Cars
    Route::post('cars/media', 'CarsApiController@storeMedia')->name('cars.storeMedia');
    Route::apiResource('cars', 'CarsApiController');

    // Companies
    Route::post('companies/media', 'CompaniesApiController@storeMedia')->name('companies.storeMedia');
    Route::apiResource('companies', 'CompaniesApiController');

    // Individuals
    Route::post('individuals/media', 'IndividualApiController@storeMedia')->name('individuals.storeMedia');
    Route::apiResource('individuals', 'IndividualApiController');

    // Entities
    Route::apiResource('entities', 'EntityApiController');

    // Addresses
    Route::apiResource('addresses', 'AddressApiController');

    // Tag Contacts
    Route::apiResource('tag-contacts', 'TagContactApiController');

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Shippmentslists
    Route::apiResource('shippmentslists', 'ShippmentslistApiController');

    // Shipp Statuses
    Route::apiResource('shipp-statuses', 'ShippStatusesApiController');

    // Shipp Lines
    Route::apiResource('shipp-lines', 'ShippLinesApiController');

    // Orders Lists
    Route::apiResource('orders-lists', 'OrdersListApiController');

    // Trucks
    Route::post('trucks/media', 'TruckApiController@storeMedia')->name('trucks.storeMedia');
    Route::apiResource('trucks', 'TruckApiController');

    // Order Statuses
    Route::apiResource('order-statuses', 'OrderStatusApiController');

    // Cond Reglements
    Route::apiResource('cond-reglements', 'CondReglementApiController');

    // Mode Reglements
    Route::apiResource('mode-reglements', 'ModeReglementApiController');

    // Shipping Methods
    Route::apiResource('shipping-methods', 'ShippingMethodApiController');

    // Services
    Route::post('services/media', 'ServicesApiController@storeMedia')->name('services.storeMedia');
    Route::apiResource('services', 'ServicesApiController');

    // Order Lines
    Route::apiResource('order-lines', 'OrderLinesApiController');

    // Proforma Lists
    Route::apiResource('proforma-lists', 'ProformaListApiController');

    // Proforma Lines
    Route::apiResource('proforma-lines', 'ProformaLinesApiController');

    // Invoices Lists
    Route::apiResource('invoices-lists', 'InvoicesListApiController');

    // Invoice Lines
    Route::apiResource('invoice-lines', 'InvoiceLinesApiController');

});