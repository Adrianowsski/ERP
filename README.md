# ERP App

> **A Laravel-powered ERP suite** for managing clients, suppliers, products, orders and invoices — complete with role-based access, PDF invoicing and a modern Bootstrap interface.

---

## 🚀 Overview

ERP App streamlines day-to-day operations by enabling:

* **Admins** – configure system settings, manage users & invite codes, and analyse KPI reports.  
* **Staff** – maintain catalogues, process orders, issue invoices and track payments.  
* **Clients** (optional portal) – track their own orders and download invoice PDFs.

---

## 🛠️ Tech Stack

| Layer          | Technology                                              |
| -------------- | -------------------------------------------------------- |
| **Framework**  | Laravel 10 (PHP ≥ 8.2) — clean MVC pattern               |
| **Database**   | MySQL / MariaDB via Eloquent ORM + migrations & seeders |
| **Auth**       | Laravel Breeze (roles: _admin_, _staff_, _client_)       |
| **PDF**        | `barryvdh/laravel-dompdf` — branded invoice export       |
| **Frontend**   | Blade + Bootstrap 5 (Livewire optional)                  |
| **Realtime**   | Laravel Broadcasting + Pusher (in-app notifications)     |

