<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ClientController,
    SupplierController,
    ProductController,
    OrderController,
    InvoiceController,
    RegistrationCodeController
};

/*
|--------------------------------------------------------------------------
| Public Zone
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));

/* Ładuje rejestrację/logowanie */
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Protected Zone (tylko dla zalogowanych)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /* Dashboard */
    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');

    /* CRUD: clients, suppliers, products, orders */
    Route::resources([
        'clients'   => ClientController::class,
        'suppliers' => SupplierController::class,
        'products'  => ProductController::class,
        'orders'    => OrderController::class,
    ]);

    /* Invoices: full CRUD + PDF oraz PDF download */
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])
        ->name('invoices.pdf');

    /*
    |--------------------------------------------------------------------------
    | Admin-Only Zone (przez bramkę Gate "admin-only")
    |--------------------------------------------------------------------------
    */
    Route::middleware('can:admin-only')->group(function () {
        Route::resource(
            'registration-codes',
            RegistrationCodeController::class
        )->only(['index', 'create', 'store', 'destroy']);
    });
});
