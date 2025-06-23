ERP App
A Laravel-powered ERP suite for managing clients, suppliers, products, orders, and invoices — complete with role-based access, PDF invoicing, custom validation, and a modern Bootstrap interface.

🚀 Overview
ERP App simplifies business operations by providing role-based tools for:
Admins – manage users, registration codes, and system settings; access reports.


Staff – handle product catalogs, orders, clients, suppliers, and invoice generation.


Clients (optional) – view their orders and download invoice PDFs.



🛠️ Tech Stack
Layer
Technology
Framework
Laravel 10 (PHP ≥ 8.2), MVC architecture
Database
MySQL / MariaDB via Eloquent ORM with migrations & seeders
Authentication
Laravel Breeze with roles: admin, user
Frontend
Blade templates with Bootstrap 5
Validation
FormRequest + 5+ custom rules (e.g., VAT/NIP, price > 0)
PDF Export
barryvdh/laravel-dompdf for branded invoice generation
Routing
Resource routes with auth and role middleware
Extra
Gates/Policies, observers (activity log), Livewire-ready

bash
KopiujEdytuj
erp-app/
├── app/
│   ├── Models/          # Users, Clients, Suppliers, Products, Orders, etc.
│   └── Http/
│       ├── Controllers/ # RESTful resource controllers
│       └── Requests/    # FormRequest validation
├── resources/views/     # Blade templates per module
├── routes/web.php       # Route groups, middleware
└── database/            # Migrations, factories, seeders


✨ Key Features
Authentication & Roles — Laravel Breeze with invite-only registration.


Clients & Suppliers Management — Full CRUD, filters, soft delete.


Product Catalog — Price tracking, supplier linking, CSV import/export.


Order Workflow — Many-to-many pivot (order_product) with quantity, prices.


PDF Invoicing — One-click export with branding, downloadable & emailable.


Validation — FormRequest + custom rules: NIP, price > 0, email uniqueness.


Search & Filtering — Search by name/email/NIP across all tables.


Admin Tools — Registration code management, KPI dashboard, user activity log.


Secure Access Control — Role-based middleware, policies, Gates.

📚 Author Contributions
Architecture: modular Laravel structure (admin/portal/shared separation)


Models & DB: all migrations, factories, seeders, and pivot logic


Controllers: full resource logic + custom pivot operations


Validation: clean separation via FormRequests + custom rules


UI/UX: modern Blade + Bootstrap 5 components


PDF Export: integrated with DOMPDF and styled layout


Security: full auth flow, policies, activity logging


Testing: basic tests for controllers and services with PHPUnit/Pest



⚙️ Getting Started
Prerequisites
PHP ≥ 8.2 & Composer


Node ≥ 20 & NPM/Yarn


MySQL 8 / MariaDB


Installation
bash
KopiujEdytuj
git clone https://github.com/yourusername/erp-app.git
cd erp-app

composer install
npm install
npm run dev

Environment Setup
bash
KopiujEdytuj
cp .env.example .env
php artisan key:generate

Edit the .env file:
env
KopiujEdytuj
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=erp_db
DB_USERNAME=root
DB_PASSWORD=secret

Database Setup
bash
KopiujEdytuj
php artisan migrate --seed

Run the App
bash
KopiujEdytuj
php artisan serve

Visit: http://127.0.0.1:8000
Default Admin Login:
pgsql
KopiujEdytuj
E-mail:    admin@demo.test  
Password:  password


| #  | Screenshot                              | Description                                |
| -- | --------------------------------------- | ------------------------------------------ |
| 1  | ![](img/1-Welcome.png)             | Welcome page with login/register           |
| 2  | ![](img/2-Register.png)            | Registration form with invite code         |
| 3  | ![](img/3-RegisterValid.png) | Client-side validation                     |
| 4  | ![](img/4-Login.png)               | Login form                                 |
| 5  | ![](img/5-LoginValid.png)       | Server-side auth error                     |
| 6  | ![](simg/6-DashboardUser.png)     | KPI cards for staff                        |
| 7  | ![](img/7-DashboardAdmin.png)     | Admin dashboard with code management       |
| 8  | ![](img/8-ClientView.png)        | Client list CRUD                           |
| 9  | ![](img/9-ClientDetail.png)      | Single client details view                 |
| 10 | ![](img/10-SupplierViewt.png)      | Supplier CRUD with filters                 |
| 11 | ![](img/11-ProductView.png)       | Product catalog                            |
| 12 | ![](img/12-ProductCreate.png)      | Add product form with validation           |
| 13 | ![](img/13-OrderView.png)         | Order list with statuses                   |
| 14 | ![](img/14-OrderCreate.png)        | Create order with multiple products        |
| 15 | ![](img/15-OrderCreateValid.png)    | Validation: order date cannot be in future |
| 16 | ![](img/16-OrderDetail.png)     | Invoice detail view with PDF button        |
| 17 | ![](img/17-OrderInvoice.png)         | Branded invoice PDF                        |
| 18 | ![](img/18-RegisterCodeView.png)  | Admin invite code management               |



🔒 Permissions & Middleware
auth middleware for all app areas


can:admin-only middleware for registration code section


Role-based views using @can, @role, @auth directives


Example route protection:


php
KopiujEdytuj
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('clients', ClientController::class);
    Route::middleware('can:admin-only')->group(function () {
        Route::resource('registration-codes', RegistrationCodeController::class);
    });
});






