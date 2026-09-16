# SoftClinic 🏥

### An All-in-One Clinic & Laboratory Management System

Manage patients, appointments, invoices, OPD sales, lab tests, packages, staff, and printable medical reports — built with Laravel for clinics and diagnostic laboratories.

[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](./composer.json)
[![Platform](https://img.shields.io/badge/platform-Windows%20%7C%20macOS%20%7C%20Linux-lightgrey.svg)](https://github.com/MiltonManjate/softclinic)

<p align="center">
  <a href="./README.md">Profile</a> ·
  <b>English</b> ·
  <a href="https://github.com/MiltonManjate/softclinic/issues">Issues</a>
</p>

---

## About SoftClinic 💡

**SoftClinic** is a clinic management system developed by **Milton Manjate** (SoftSales Solutions). It helps clinics and labs run day-to-day operations in one place: patient registration, doctor scheduling, billing, laboratory workflows, and PDF reports.

Ideal for:

- Outpatient clinics (OPD)
- Diagnostic / pathology laboratories
- Small to medium healthcare facilities

---

## Screenshots 🖥️

Add screenshots under `docs/` (for example `docs/dashboard.png`, `docs/patients.png`, `docs/reports.png`) when you are ready to showcase the UI.

---

## Features 🎯

### Clinic Operations

- [x] **Dashboard** with an overview of clinic activity
- [x] **Patient** registration and management
- [x] **Doctor** profiles and referral tracking
- [x] **Appointments** scheduling and updates
- [x] **Departments** and clinical **services** catalog
- [x] **Employees** / staff management
- [x] **Hospital / clinic settings**, tax and configuration
- [x] Database **backup** from the settings area

### Billing & Sales

- [x] **Invoices** creation, search, duplicate and returns
- [x] **OPD sales** workflow
- [x] **Package** definition, package tests and package sales
- [x] Accounting views for **service**, **OPD** and **package** reports

### Laboratory

- [x] Lab **tests** catalog with status control
- [x] **Reference** values and microbiology **antibiotics**
- [x] Specialized modules: **Haematology**, **Immunology**, **Microbiology**, **Biochemistry**, **Examination**, **Stain**
- [x] **Results** entry / edit and report generation
- [x] Printable **lab reports** (DomPDF)

### Access Control

- [x] Authentication (login / logout)
- [x] **Users**, **roles** and permissions
- [x] Password change
- [x] UI language switch (**English** / **Portuguese**)

---

## Tech Stack 🛠️

| Layer | Technology |
| ----- | ---------- |
| Backend | PHP **8.3+**, **Laravel 13** |
| Frontend | Blade views, Bootstrap, jQuery, Vue 2 (legacy Mix assets) |
| Database | **SQLite** (default) or **MySQL** / PostgreSQL / SQL Server |
| PDF | **barryvdh/laravel-dompdf** |
| Auth | Laravel session authentication |
| Tooling | Composer, NPM / Laravel Mix, PHPUnit |

---

## System Requirements 📦

| Item | Minimum | Recommended |
| ---- | ------- | ----------- |
| PHP | 8.3 | 8.3+ with common extensions (`pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`) |
| Composer | 2.x | Latest 2.x |
| Database | SQLite | MySQL 8+ (production) |
| Node.js | 16+ (optional, for asset rebuild) | 18+ |
| RAM | 2 GB | 4 GB+ |

Supported platforms: **Windows 10+**, **macOS**, and mainstream **Linux** distributions.

---

## Quick Start 🚀

### ① Clone the project

```shell
git clone https://github.com/MiltonManjate/softclinic.git
cd softclinic
```

### ② Install PHP dependencies

```shell
composer install
```

### ③ Configure the environment

```shell
cp .env.example .env
php artisan key:generate
```

By default SoftClinic uses **SQLite**. To use MySQL, edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=SoftClinic
DB_USERNAME=root
DB_PASSWORD=
```

For SQLite, ensure the database file exists:

```shell
# Windows (PowerShell)
New-Item -ItemType File -Force database/database.sqlite

# macOS / Linux
touch database/database.sqlite
```

### ④ Run migrations (and seeders if available)

```shell
php artisan migrate
# php artisan db:seed
```

### ⑤ Start the development server

```shell
php artisan serve
```

Open your browser at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Demo login

| Field | Value |
| ----- | ----- |
| Username | `admin` |
| Password | `miltonmanjate` |

> Change this password after the first login in production environments.

---

## Project Structure 📁

```text
softclinic/
├── app/
│   ├── Http/Controllers/   # Clinic, lab, billing & auth controllers
│   └── Models/             # Patients, doctors, invoices, tests, ...
├── config/                 # Laravel configuration
├── database/
│   ├── migrations/         # Schema definitions
│   └── seeders/            # Seed data
├── public/                 # Web root (CSS, JS, images)
├── resources/
│   ├── views/              # Blade templates
│   ├── lang/               # en / pt translations
│   └── assets/             # Frontend sources
├── routes/
│   └── web.php             # Application routes
├── storage/                # Logs, cache, generated files
├── README.md               # Author profile
└── README-en.md            # SoftClinic documentation (this file)
```

---

## Main Modules 🗂️

| Module | Description |
| ------ | ----------- |
| Dashboard | Home overview after login |
| Patients | Patient CRUD |
| Doctors | Doctor management & API helpers for schedules |
| Appointments | Booking and updates |
| Departments / Services | Organizational structure and billable services |
| Employees | Staff records |
| Roles / Users | Access control |
| Invoices / OPD / Packages | Billing and sales |
| Tests & Lab modules | Haematology, immunology, microbiology, biochemistry, stains, examinations |
| Reports / Results | Lab result entry and printable reports |
| Accounts | Service, OPD and package financial reports |
| Hospital settings | Clinic profile, tax, config and backup |

---

## Useful Commands 💻

```shell
# Development server
php artisan serve

# Run migrations
php artisan migrate

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Code style (Pint)
./vendor/bin/pint

# Tests
php artisan test
```

Optional frontend rebuild (Laravel Mix):

```shell
npm install
npm run dev
# or
npm run production
```

---

## Locale 🌐

SoftClinic supports **English** and **Portuguese**. Switch language via:

```text
/locale/en
/locale/pt
```

---

## Roadmap 🗺️

- [ ] Public demo screenshots in `docs/`
- [ ] Docker Compose one-command setup
- [ ] REST API documentation for integrations
- [ ] Stronger role-permission UI and audit logs
- [ ] Mobile-friendly responsive refinements

---

## Author 👨‍💻

**Milton Reginaldo Manjate**  
Software Developer | Full Stack | Systems & Network  
Maputo, Mozambique

- GitHub: [MiltonManjate](https://github.com/MiltonManjate)
- LinkedIn: [milton-manjate](https://www.linkedin.com/in/milton-manjate-775797332/)
- Email: [miltonmanjate97@gmail.com](mailto:miltonmanjate97@gmail.com)
- WhatsApp: [+258 87 044 0078](https://wa.me/258870440078)

Company: **SoftSales Solutions**

---

## License 📄

This project is open-sourced under the **MIT** license.

---

## Feedback & Support 🤝

Issues, ideas and pull requests are welcome.

⭐ If SoftClinic helps your clinic or lab workflow, consider starring the repository.
