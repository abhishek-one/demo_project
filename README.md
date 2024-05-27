# This project is built using Laravel 11 and PHP 8.2.

## Getting Started

To run this project locally, follow these steps:

    1. Make sure you have PHP 8.2 installed on your system.
    2. Clone this repository to your local machine.
    3. Navigate to the project directory in your terminal.
    4. Run the following command to install dependencies:

## Start the development server
    php artisan serve

## Make sure to create a symbolic link to the storage directory by running:
    php artisan storage:link

## This project utilizes Laravel's resourceful routing system for managing products. The following routes are available:

    GET /products - Retrieves a list of all products.
    GET /products/create - Displays a form for creating a new product.
    POST /products - Stores a newly created product in the database.
    GET /products/{id} - Retrieves the details of a specific product.
    GET /products/{id}/edit - Displays a form for editing a specific product.
    PUT/PATCH /products/{id} - Updates a specific product in the database.
    DELETE /products/{id} - Deletes a specific product from the database.

