[![Laravel](https://img.shields.io/badge/Laravel-10-red)](https://laravel.com) [![PHP](https://img.shields.io/badge/PHP-8.2-blue)](https://php.net) [![Build Status](https://img.shields.io/github/actions/workflow/status/yourusername/erp-app/ci.yml?branch=main)](https://github.com/yourusername/erp-app/actions) [![License: MIT](https://img.shields.io/badge/License-MIT-green)](LICENSE)

# 🚀 ERP App

A Laravel-powered ERP suite for managing **Clients**, **Suppliers**, **Products**, **Orders**, and **Invoices**—complete with role-based access control, PDF invoicing, custom validation, and a modern Bootstrap 5 interface.

---

## 📌 Table of Contents

* [✨ Key Features](#key-features)
* [🛠️ Tech Stack](#tech-stack)
* [📁 Project Structure](#project-structure)
* [⚙️ Installation](#installation)
* [🔧 Configuration](#configuration)
* [▶️ Running the App](#running-the-app)
* [👤 Default Admin](#default-admin)
* [📸 Screenshots](#screenshots)
* [🔒 Permissions & Middleware](#permissions--middleware)
* [📄 License](#license)

---

# ✨ Key Features

* 🔐 **Authentication & Role Management**
  Laravel Breeze scaffolding (Sanctum-ready), invite-only registration via single-use codes, `admin` / `user` roles enforced by Gates/Policies.
* 🤝 **Clients & Suppliers**
  Full CRUD with soft deletes, quick filters, and unique NIP/email validation.
* 📦 **Product Catalog**
  Supplier linkage, price tracking history, CSV/Excel import & export.
* 🛒 **Order Workflow**
  Many‑to‑many `order_product` pivot including quantity, buy & sell price; automatic subtotal and tax calculation.
* 📄 **PDF Invoicing**
  One‑click, brand‑ready PDF generation using `barryvdh/laravel-dompdf`; optional email attachment.
* ✔️ **Custom Validation**
  Centralised `FormRequest` classes with >5 custom rules (NIP checksum, positive price, positive quantity, max length, future date disallowed).
* 🔍 **Search & Filtering**
  Global full‑text search across clients, suppliers & products; sortable & paginated tables.
* 📊 **Admin Dashboard**
  Registration‑code management, KPI widgets, and activity‑log observers.
* 🧰 **Developer Friendly**
  Clean MVC architecture, service classes, repository pattern, feature tests, Docker & CI workflow.

---

## 🛠️ Tech Stack

| Layer         | Technology                                       |
| ------------- | ------------------------------------------------ |
| **Framework** | Laravel 10 (PHP ≥ 8.2)                           |
| **Database**  | MySQL / MariaDB – Eloquent ORM                   |
| **Auth**      | Laravel Breeze, Gates & Policies                 |
| **Frontend**  | Blade, Bootstrap 5, Vite/ESBuild, Livewire‑ready |
| **PDF**       | barryvdh/laravel-dompdf                          |
| **Testing**   | PHPUnit, Laravel Pint / PHPStan                  |
| **CI/CD**     | GitHub Actions (build, test, Pint, deploy)       |

---

## 📁 Project Structure

```text
app/
├── Models/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Middleware/
├── Policies/
database/
├── migrations/
├── seeders/
public/
resources/
├── views/
│   ├── clients/
│   ├── suppliers/
│   ├── products/
│   ├── orders/
│   └── invoices/
routes/
├── web.php
└── api.php
```

---

## ⚙️ Installation

### 🔑 Prerequisites

* **PHP 8.2+** with extensions: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
* **Composer v2**
* **Node.js 18+** & **npm**
* **MySQL** or **MariaDB**
* *(Optional)* **Docker & Docker Compose** for containerised local setup

### 🏃‍♂️ Quick start

```bash
git clone https://github.com/yourusername/erp-app.git
cd erp-app

# PHP dependencies
composer install --prefer-dist --no-dev

# Environment variables
cp .env.example .env
php artisan key:generate

# Database & seeders
php artisan migrate --seed

# Front‑end assets
npm install
npm run build

# Fire up the dev server
php artisan serve
```

Open `http://127.0.0.1:8000` in your browser and log in with the [default admin](#-default-admin) credentials.

> **Docker**
> Run `./vendor/bin/sail up -d` or simply `docker compose up -d` to spin up a full stack (PHP‑FPM, Nginx, MySQL, Mailhog) in containers.

## 🔧 Configuration

| Variable        | Purpose                             |
| --------------- | ----------------------------------- |
| `APP_NAME`      | Branding shown in PDFs & navbar     |
| `MAIL_*`        | SMTP credentials for invoice emails |
| `DB_*`          | Database connection strings         |
| `PDF_LOGO_PATH` | Path to logo used in invoices       |

---

## ▶️ Running the App

```bash
php artisan serve    # default http://127.0.0.1:8000
```

Visit `/login` and use the default admin credentials below.

---

## 👤 Default Admin

| Email               | Password   |
| ------------------- | ---------- |
| `admin@example.com` | `Admin123!` |

*(created by DatabaseSeeder; change immediately in production).*

---

## 📸 Screenshots

| #  | Screenshot                       | Description                                |
| -- | -------------------------------- | ------------------------------------------ |
| 1  | ![](img/1-Welcome.png)           | Welcome page with login/register           |
| 2  | ![](img/2-Register.png)          | Registration form with invite code         |
| 3  | ![](img/3-RegisterValid.png)     | Client-side validation                     |
| 4  | ![](img/4-Login.png)             | Login form                                 |
| 5  | ![](img/5-LoginValid.png)        | Server-side auth error                     |
| 6  | ![](simg/6-DashboardUser.png)    | KPI cards for staff                        |
| 7  | ![](img/7-DashboardAdmin.png)    | Admin dashboard with code management       |
| 8  | ![](img/8-ClientView.png)        | Client list CRUD                           |
| 9  | ![](img/9-ClientDetail.png)      | Single client details view                 |
| 10 | ![](img/10-SupplierViewt.png)    | Supplier CRUD with filters                 |
| 11 | ![](img/11-ProductView.png)      | Product catalog                            |
| 12 | ![](img/12-ProductCreate.png)    | Add product form with validation           |
| 13 | ![](img/13-OrderView.png)        | Order list with statuses                   |
| 14 | ![](img/14-OrderCreate.png)      | Create order with multiple products        |
| 15 | ![](img/15-OrderCreateValid.png) | Validation: order date cannot be in future |
| 16 | ![](img/16-OrderDetail.png)      | Invoice detail view with PDF button        |
| 17 | ![](img/17-OrderInvoice.png)     | Branded invoice PDF                        |
| 18 | ![](img/18-RegisterCodeView.png) | Admin invite code management               |

## 🔒 Permissions & Middleware & Middleware

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('clients', ClientController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('invoices', InvoiceController::class);

    Route::middleware('can:admin-only')->group(function () {
        Route::resource('registration-codes', RegistrationCodeController::class);
    });
});
```

* `auth` – protects all routes
* `can:admin-only` – gate for admin features
* Blade directives: `@auth`, `@can`, `@role`

---

## 📄 License

This project is open‑source software licensed under the [MIT license](LICENSE).

---

*of course update links, images & variables to match your deployment.*
