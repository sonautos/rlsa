<?php

use App\Http\Controllers\Admin\Api\GetCarApiController;
use App\Http\Controllers\Admin\ShippDocsController;
use App\Http\Controllers\Admin\ShippmentslistController;
use App\Http\Controllers\Admin\CarsMassImport;


Route::view('/', 'front.index');

Auth::routes(['register' => false]);

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.', 
    'namespace' => 'Admin', 
    'middleware' => ['auth', 'admin']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/parse-csv-import', 'ProductCategoryController@parseCsvImport')->name('product-categories.parseCsvImport');
    Route::post('product-categories/process-csv-import', 'ProductCategoryController@processCsvImport')->name('product-categories.processCsvImport');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tags
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::post('product-tags/parse-csv-import', 'ProductTagController@parseCsvImport')->name('product-tags.parseCsvImport');
    Route::post('product-tags/process-csv-import', 'ProductTagController@processCsvImport')->name('product-tags.processCsvImport');
    Route::resource('product-tags', 'ProductTagController');

    // Products
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // Makes
    Route::delete('makes/destroy', 'MakeController@massDestroy')->name('makes.massDestroy');
    Route::post('makes/parse-csv-import', 'MakeController@parseCsvImport')->name('makes.parseCsvImport');
    Route::post('makes/process-csv-import', 'MakeController@processCsvImport')->name('makes.processCsvImport');
    Route::resource('makes', 'MakeController');

    // Modeles
    Route::delete('modeles/destroy', 'ModeleController@massDestroy')->name('modeles.massDestroy');
    Route::post('modeles/parse-csv-import', 'ModeleController@parseCsvImport')->name('modeles.parseCsvImport');
    Route::post('modeles/process-csv-import', 'ModeleController@processCsvImport')->name('modeles.processCsvImport');
    Route::resource('modeles', 'ModeleController');

    // Versions
    Route::delete('versions/destroy', 'VersionsController@massDestroy')->name('versions.massDestroy');
    Route::post('versions/media', 'VersionsController@storeMedia')->name('versions.storeMedia');
    Route::post('versions/ckmedia', 'VersionsController@storeCKEditorImages')->name('versions.storeCKEditorImages');
    Route::post('versions/parse-csv-import', 'VersionsController@parseCsvImport')->name('versions.parseCsvImport');
    Route::post('versions/process-csv-import', 'VersionsController@processCsvImport')->name('versions.processCsvImport');
    Route::resource('versions', 'VersionsController');

    // Colors
    Route::delete('colors/destroy', 'ColorController@massDestroy')->name('colors.massDestroy');
    Route::post('colors/media', 'ColorController@storeMedia')->name('colors.storeMedia');
    Route::post('colors/ckmedia', 'ColorController@storeCKEditorImages')->name('colors.storeCKEditorImages');
    Route::post('colors/parse-csv-import', 'ColorController@parseCsvImport')->name('colors.parseCsvImport');
    Route::post('colors/process-csv-import', 'ColorController@processCsvImport')->name('colors.processCsvImport');
    Route::resource('colors', 'ColorController');

    // Features
    Route::delete('features/destroy', 'FeaturesController@massDestroy')->name('features.massDestroy');
    Route::post('features/media', 'FeaturesController@storeMedia')->name('features.storeMedia');
    Route::post('features/ckmedia', 'FeaturesController@storeCKEditorImages')->name('features.storeCKEditorImages');
    Route::post('features/parse-csv-import', 'FeaturesController@parseCsvImport')->name('features.parseCsvImport');
    Route::post('features/process-csv-import', 'FeaturesController@processCsvImport')->name('features.processCsvImport');
    Route::resource('features', 'FeaturesController');

    // Code Models
    Route::delete('code-models/destroy', 'CodeModelController@massDestroy')->name('code-models.massDestroy');
    Route::post('code-models/parse-csv-import', 'CodeModelController@parseCsvImport')->name('code-models.parseCsvImport');
    Route::post('code-models/process-csv-import', 'CodeModelController@processCsvImport')->name('code-models.processCsvImport');
    Route::resource('code-models', 'CodeModelController');

    // Cars
    Route::delete('cars/destroy', 'CarsController@massDestroy')->name('cars.massDestroy');
    Route::post('cars/media', 'CarsController@storeMedia')->name('cars.storeMedia');
    Route::post('cars/ckmedia', 'CarsController@storeCKEditorImages')->name('cars.storeCKEditorImages');
    Route::resource('cars', 'CarsController');
    Route::get('cars/modif', 'CarsController@massModif')->name('cars.mass-modif');
    Route::post('courses/active', 'CarsController@massActive')->name('cars.massPublish');
    Route::post('courses/test', 'CarsController@test')->name('cars.test');
    // Documents
    Route::post('cars/fiche', 'CarsController@ficheProduct')->name('car-fiche.pdf');

    // Cars Mass Import
    Route::get('cars/mass-import', 'CarsMassImport@index')->name('cars.massImport');
    Route::post('cars/parse-csv-import', 'CarsMassImport@parseImport')->name('cars.parseCsvImport');
    Route::post('cars/process-csv-import', 'CarsMassImport@processImport')->name('cars.processImport');
    Route::post('cars/code_color', 'CarsMassImport@codeColor')->name('bulk-color');
    Route::post('cars/code_options', 'CarsMassImport@codeOptions')->name('bulk-options');

    // Companies
    Route::delete('companies/destroy', 'CompaniesController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompaniesController@storeMedia')->name('companies.storeMedia');
    Route::post('companies/ckmedia', 'CompaniesController@storeCKEditorImages')->name('companies.storeCKEditorImages');
    Route::post('companies/parse-csv-import', 'CompaniesController@parseCsvImport')->name('companies.parseCsvImport');
    Route::post('companies/process-csv-import', 'CompaniesController@processCsvImport')->name('companies.processCsvImport');
    Route::resource('companies', 'CompaniesController');
    Route::post('companies/active', 'CompaniesController@massActive')->name('companies.massActive');

    // Individuals
    Route::delete('individuals/destroy', 'IndividualController@massDestroy')->name('individuals.massDestroy');
    Route::post('individuals/media', 'IndividualController@storeMedia')->name('individuals.storeMedia');
    Route::post('individuals/ckmedia', 'IndividualController@storeCKEditorImages')->name('individuals.storeCKEditorImages');
    Route::post('individuals/parse-csv-import', 'IndividualController@parseCsvImport')->name('individuals.parseCsvImport');
    Route::post('individuals/process-csv-import', 'IndividualController@processCsvImport')->name('individuals.processCsvImport');
    Route::resource('individuals', 'IndividualController');

    // Entities
    Route::delete('entities/destroy', 'EntityController@massDestroy')->name('entities.massDestroy');
    Route::post('entities/parse-csv-import', 'EntityController@parseCsvImport')->name('entities.parseCsvImport');
    Route::post('entities/process-csv-import', 'EntityController@processCsvImport')->name('entities.processCsvImport');
    Route::resource('entities', 'EntityController');

    // Addresses
    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::post('addresses/parse-csv-import', 'AddressController@parseCsvImport')->name('addresses.parseCsvImport');
    Route::post('addresses/process-csv-import', 'AddressController@processCsvImport')->name('addresses.processCsvImport');
    Route::resource('addresses', 'AddressController');

    // Tag Contacts
    Route::delete('tag-contacts/destroy', 'TagContactController@massDestroy')->name('tag-contacts.massDestroy');
    Route::post('tag-contacts/parse-csv-import', 'TagContactController@parseCsvImport')->name('tag-contacts.parseCsvImport');
    Route::post('tag-contacts/process-csv-import', 'TagContactController@processCsvImport')->name('tag-contacts.processCsvImport');
    Route::resource('tag-contacts', 'TagContactController');

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::post('task-statuses/parse-csv-import', 'TaskStatusController@parseCsvImport')->name('task-statuses.parseCsvImport');
    Route::post('task-statuses/process-csv-import', 'TaskStatusController@processCsvImport')->name('task-statuses.processCsvImport');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::post('task-tags/parse-csv-import', 'TaskTagController@parseCsvImport')->name('task-tags.parseCsvImport');
    Route::post('task-tags/process-csv-import', 'TaskTagController@processCsvImport')->name('task-tags.processCsvImport');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::post('tasks/parse-csv-import', 'TaskController@parseCsvImport')->name('tasks.parseCsvImport');
    Route::post('tasks/process-csv-import', 'TaskController@processCsvImport')->name('tasks.processCsvImport');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::post('teams/parse-csv-import', 'TeamController@parseCsvImport')->name('teams.parseCsvImport');
    Route::post('teams/process-csv-import', 'TeamController@processCsvImport')->name('teams.processCsvImport');
    Route::resource('teams', 'TeamController');

    // Shippmentslists
    Route::delete('shippmentslists/destroy', 'ShippmentslistController@massDestroy')->name('shippmentslists.massDestroy');
    Route::post('shippmentslists/parse-csv-import', 'ShippmentslistController@parseCsvImport')->name('shippmentslists.parseCsvImport');
    Route::post('shippmentslists/process-csv-import', 'ShippmentslistController@processCsvImport')->name('shippmentslists.processCsvImport');
    Route::resource('shippmentslists', 'ShippmentslistController');
    Route::post('entity-update', 'ShippmentslistController@entityUpdate')->name('shipp.entity-update');
    Route::post('truck-update', 'ShippmentslistController@truckUpdate')->name('shipp.truck-update');
    Route::post('line-update', 'ShippmentslistController@editLineUpdate')->name('shipp.editLine-update');
    Route::post('total-price', 'ShippmentslistController@totalUpdate')->name('shipp.prices-update');
    Route::delete('delete-line', 'ShippmentslistController@destroyLine')->name('shipp.line-destroy');
    Route::post('export', 'ShippmentslistController@export')->name('shippments.export');
    // Documents
    Route::resource('shipp-docs', 'ShippDocsController');
    Route::post('attestation-reception', 'ShippDocsController@receptionPDF')->name('receptionPDF');
    Route::post('cerfa/{key}/{seller}/{ref}', [ShippDocsController::class, 'cerfa'])->name('cerfa');
    Route::post('cmr_upload/{ref}', [ShippDocsController::class, 'upload'])->name('cmr_upload');

    // Shipp Statuses
    Route::delete('shipp-statuses/destroy', 'ShippStatusesController@massDestroy')->name('shipp-statuses.massDestroy');
    Route::post('shipp-statuses/parse-csv-import', 'ShippStatusesController@parseCsvImport')->name('shipp-statuses.parseCsvImport');
    Route::post('shipp-statuses/process-csv-import', 'ShippStatusesController@processCsvImport')->name('shipp-statuses.processCsvImport');
    Route::resource('shipp-statuses', 'ShippStatusesController');

    // Shipp Lines
    Route::delete('shipp-lines/destroy', 'ShippLinesController@massDestroy')->name('shipp-lines.massDestroy');
    Route::post('shipp-lines/parse-csv-import', 'ShippLinesController@parseCsvImport')->name('shipp-lines.parseCsvImport');
    Route::post('shipp-lines/process-csv-import', 'ShippLinesController@processCsvImport')->name('shipp-lines.processCsvImport');
    Route::resource('shipp-lines', 'ShippLinesController');

    // Orders Lists
    Route::delete('orders-lists/destroy', 'OrdersListController@massDestroy')->name('orders-lists.massDestroy');
    Route::post('orders-lists/parse-csv-import', 'OrdersListController@parseCsvImport')->name('orders-lists.parseCsvImport');
    Route::post('orders-lists/process-csv-import', 'OrdersListController@processCsvImport')->name('orders-lists.processCsvImport');
    Route::resource('orders-lists', 'OrdersListController');
    Route::get('orders/createOrder', 'OrdersListController@createOrder')->name('order.create');
    Route::post('orders/storeOrder', 'OrdersListController@store')->name('order.store');
    Route::post('orders/update/{order}', 'OrdersListController@updateLine')->name('order.update-line');
    Route::get('orders/com-order/{order}', 'OrdersListController@comOrder')->name('order.com-order');
    Route::get('orders/getComOrder/{id}', 'OrdersListController@getComOrderDoc')->name('order.getComOrder');
    // Documents
    Route::post('order/pdf', 'OrdersListController@orderPDF')->name('order.pdf');


    // Trucks
    Route::delete('trucks/destroy', 'TruckController@massDestroy')->name('trucks.massDestroy');
    Route::post('trucks/media', 'TruckController@storeMedia')->name('trucks.storeMedia');
    Route::post('trucks/ckmedia', 'TruckController@storeCKEditorImages')->name('trucks.storeCKEditorImages');
    Route::post('trucks/parse-csv-import', 'TruckController@parseCsvImport')->name('trucks.parseCsvImport');
    Route::post('trucks/process-csv-import', 'TruckController@processCsvImport')->name('trucks.processCsvImport');
    Route::resource('trucks', 'TruckController');

    // Order Statuses
    Route::delete('order-statuses/destroy', 'OrderStatusController@massDestroy')->name('order-statuses.massDestroy');
    Route::post('order-statuses/parse-csv-import', 'OrderStatusController@parseCsvImport')->name('order-statuses.parseCsvImport');
    Route::post('order-statuses/process-csv-import', 'OrderStatusController@processCsvImport')->name('order-statuses.processCsvImport');
    Route::resource('order-statuses', 'OrderStatusController');

    // Cond Reglements
    Route::delete('cond-reglements/destroy', 'CondReglementController@massDestroy')->name('cond-reglements.massDestroy');
    Route::post('cond-reglements/parse-csv-import', 'CondReglementController@parseCsvImport')->name('cond-reglements.parseCsvImport');
    Route::post('cond-reglements/process-csv-import', 'CondReglementController@processCsvImport')->name('cond-reglements.processCsvImport');
    Route::resource('cond-reglements', 'CondReglementController');

    // Mode Reglements
    Route::delete('mode-reglements/destroy', 'ModeReglementController@massDestroy')->name('mode-reglements.massDestroy');
    Route::post('mode-reglements/parse-csv-import', 'ModeReglementController@parseCsvImport')->name('mode-reglements.parseCsvImport');
    Route::post('mode-reglements/process-csv-import', 'ModeReglementController@processCsvImport')->name('mode-reglements.processCsvImport');
    Route::resource('mode-reglements', 'ModeReglementController');

    // Shipping Methods
    Route::delete('shipping-methods/destroy', 'ShippingMethodController@massDestroy')->name('shipping-methods.massDestroy');
    Route::post('shipping-methods/parse-csv-import', 'ShippingMethodController@parseCsvImport')->name('shipping-methods.parseCsvImport');
    Route::post('shipping-methods/process-csv-import', 'ShippingMethodController@processCsvImport')->name('shipping-methods.processCsvImport');
    Route::resource('shipping-methods', 'ShippingMethodController');

    // Services
    Route::delete('services/destroy', 'ServicesController@massDestroy')->name('services.massDestroy');
    Route::post('services/media', 'ServicesController@storeMedia')->name('services.storeMedia');
    Route::post('services/ckmedia', 'ServicesController@storeCKEditorImages')->name('services.storeCKEditorImages');
    Route::post('services/parse-csv-import', 'ServicesController@parseCsvImport')->name('services.parseCsvImport');
    Route::post('services/process-csv-import', 'ServicesController@processCsvImport')->name('services.processCsvImport');
    Route::resource('services', 'ServicesController');

    // Order Lines
    Route::delete('order-lines/destroy', 'OrderLinesController@massDestroy')->name('order-lines.massDestroy');
    Route::post('order-lines/parse-csv-import', 'OrderLinesController@parseCsvImport')->name('order-lines.parseCsvImport');
    Route::post('order-lines/process-csv-import', 'OrderLinesController@processCsvImport')->name('order-lines.processCsvImport');
    Route::resource('order-lines', 'OrderLinesController');

    // Proforma Lists
    Route::delete('proforma-lists/destroy', 'ProformaListController@massDestroy')->name('proforma-lists.massDestroy');
    Route::post('proforma-lists/parse-csv-import', 'ProformaListController@parseCsvImport')->name('proforma-lists.parseCsvImport');
    Route::post('proforma-lists/process-csv-import', 'ProformaListController@processCsvImport')->name('proforma-lists.processCsvImport');
    Route::resource('proforma-lists', 'ProformaListController');
    Route::get('proforma/create-from-orderline', 'ProformaListController@createFromOrder')->name('proforma-lists.createFromOrder');
    Route::post('proforma/pdf', 'ProformaListController@proformaPDF')->name('proforma.pdf');

    // Proforma Lines
    Route::delete('proforma-lines/destroy', 'ProformaLinesController@massDestroy')->name('proforma-lines.massDestroy');
    Route::post('proforma-lines/parse-csv-import', 'ProformaLinesController@parseCsvImport')->name('proforma-lines.parseCsvImport');
    Route::post('proforma-lines/process-csv-import', 'ProformaLinesController@processCsvImport')->name('proforma-lines.processCsvImport');
    Route::resource('proforma-lines', 'ProformaLinesController');

    // Invoices Lists
    Route::delete('invoices-lists/destroy', 'InvoicesListController@massDestroy')->name('invoices-lists.massDestroy');
    Route::post('invoices-lists/parse-csv-import', 'InvoicesListController@parseCsvImport')->name('invoices-lists.parseCsvImport');
    Route::post('invoices-lists/process-csv-import', 'InvoicesListController@processCsvImport')->name('invoices-lists.processCsvImport');
    Route::resource('invoices-lists', 'InvoicesListController');

    // Invoice Lines
    Route::delete('invoice-lines/destroy', 'InvoiceLinesController@massDestroy')->name('invoice-lines.massDestroy');
    Route::post('invoice-lines/parse-csv-import', 'InvoiceLinesController@parseCsvImport')->name('invoice-lines.parseCsvImport');
    Route::post('invoice-lines/process-csv-import', 'InvoiceLinesController@processCsvImport')->name('invoice-lines.processCsvImport');
    Route::resource('invoice-lines', 'InvoiceLinesController');

    // Bank
    Route::delete('banks/destroy', 'BankController@massDestroy')->name('banks.massDestroy');
    Route::resource('banks', 'BankController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

// Our NEW group - for front-end users
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'User',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Gestion du compte
    Route::resource('account', 'AccountController');
});


// Api/V2
Route::get('api/modeles/get_by_make', [GetCarApiController::class, 'get_by_make'] )->name('api.modeles.get_by_make');
Route::get('api/version/get_by_modele', [GetCarApiController::class, 'get_by_modele'] )->name('api.modeles.get_by_modele');
Route::get('api/version/get_by_version', [GetCarApiController::class, 'get_by_version'] )->name('api.version.get_by_version');
