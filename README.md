# Invoice Management System

## Tech Stack

-   Laravel v10.48.29
-   MySQL
-   Vue.js

## Features

-   Login/Register
-   Create Customers
-   Create Invoices (linked to customers)
-   Add multiple line items with quantity and price
-   Auto-calculate total amount
-   Invoice list with pagination

## Setup Instructions

-  Clone repo : git clone https://github.com/lianarazak/invoice-management-system.git
-  cd to project folder
-  composer install
-  npm install
-  setup .env file (refer .env.example)
-  php artisan key:generate
-  php artisan migrate
-  php artisan serve
-  npm run dev
-  open in browser http://localhost:8000/
