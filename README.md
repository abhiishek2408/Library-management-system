<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

## 📚 Library Management System (LMS)

The **Library Management System (LMS)** is a robust and scalable web application built with **Laravel**. It supports multiple user roles (Admin, Librarian, and User) and provides features for managing books, issuing/returning, reservations, and tracking overdue reports.

---

## 🚀 Features

- Role-based authentication (Admin, Librarian, User)
- Book management (Add, Edit, Delete, View)
- Book issuing and return with due date tracking
- Reserve and renew functionality
- Overdue alert system
- Book search and filter
- Admin panel with role management and activity logs
- Reports: issued books, returned books, overdue list
- Responsive UI using Blade templating
- RESTful API support

---

## 🛠️ Tech Stack

- **Backend**: Laravel 10+, PHP 8+
- **Frontend**: Blade, Bootstrap
- **Database**: MySQL
- **Authentication**: Laravel Auth
- **APIs**: Laravel REST APIs

---

## 📂 Project Setup

```bash
# Clone the repository
git clone https://github.com/your-username/library-management-system.git

cd library-management-system

# Install dependencies
composer install

# Copy .env file and configure database
cp .env.example .env
php artisan key:generate

# Setup database credentials in .env
# Then run:
php artisan migrate --seed

# Serve the application
php artisan serve
