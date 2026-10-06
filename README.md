# Hotel Reservation

A Laravel hotel reservation app with three roles: admin, hotel manager, and customer. Guests can browse hotels from the home page. Signed-in customers can search, view details, leave reviews, and open booking, reservation, and notification pages. Admins manage managers and customers. Hotel managers manage their profile and hotels.

## Stack

- PHP 8.2+
- Laravel 11
- MySQL
- Tailwind CSS and Vite
- Pest (tests)

Authentication uses separate session guards for `admin`, `hotel_manager`, and `customer`.

## Features

**Public**

- Home page listing hotels with photos and average review ratings
- Login and customer registration

**Customer**

- Hotel list and search by name, location, rating, services, party size, budget, and check-in date
- Hotel details and reviews (create, update, delete)
- Profile updates (username, birth date, password) and account deletion
- Booking, reservation history, and notifications pages

**Hotel manager**

- Profile updates (username and password) and account deletion
- Hotel list and add-hotel form
- Reservations page

**Admin**

- Dashboard with profile updates and account deletion
- Statistics for customers, hotels, reservations, and managers
- Create, search, edit, and delete hotel managers
- Search, edit, and delete customers

## Requirements

- PHP 8.2 or newer, with the usual Laravel extensions
- Composer
- Node.js and npm
- MySQL (XAMPP is fine; this project lives under `htdocs`)

## Setup

1. Create a MySQL database named `hotel_reservation_lrvl`.

2. Copy the environment file and generate an app key:

```bash
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

3. Confirm the database settings in `.env`. The example file uses:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel_reservation_lrvl
DB_USERNAME=root
DB_PASSWORD=
```

4. Install dependencies, migrate, and seed sample data:

```bash
composer install
npm install
php artisan migrate --seed
npm run build
```

5. Open the app. With XAMPP, use:

```
http://localhost/hotel_reservation_lrvl/public
```

Or start the built-in server:

```bash
php artisan serve
```

For frontend hot reload during development, run `npm run dev` in a second terminal. `composer run dev` starts the server, queue listener, logs, and Vite together.

## Demo accounts

These accounts are for local demo use. They are the working logins for this project, and they are separate from the sample rows created by `php artisan db:seed`.

| Role | Email | Password | Notes |
| --- | --- | --- | --- |
| Admin | admin1@example.com | Password123! | Can create a hotel manager |
| Manager | manager3@example.com | Password123! | |
| Customer | customer3@example.com | Password123! | You can also register a new customer |

Login is at `/login`. Registration is at `/register`.

## Main routes

| Area | Path |
| --- | --- |
| Home | `/` |
| Login / register | `/login`, `/register` |
| Admin dashboard | `/admin` |
| Statistics | `/statistics` |
| Manager management | `/manager-management` |
| Customer management | `/customer-management` |
| Manager dashboard | `/hotel-managers` |
| Manager hotels | `/MyHotels` |
| Customer hotels | `/hotels` |
| Hotel details | `/hotel-details/{id}` |
| Customer dashboard | `/dashboard` |

## Data

Migrations cover admins, hotel managers, customers, hotels, rooms, services, hotel photos, room photos, reviews, notifications, reservations, and reservation rooms.

`php artisan db:seed` loads sample hotels, rooms, services, reviews, reservations, and photos through `DatabaseSeeder`.
