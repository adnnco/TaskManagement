# Task Management System

This is a simple Task Management System built using **Laravel 11**. It showcases CRUD operations for tasks and implements a **RESTful API** with JWT-based authentication. The project was created for demonstration purposes in a job interview context.

## Features

- **CRUD Operations**: Create, read, update, and delete tasks.
- **JWT Authentication**: Secure API endpoints using JSON Web Tokens.
- **RESTful API**: Follows RESTful principles for API design.
- **Laravel 11**: Built with the latest version of Laravel for modern PHP development.

---

## Requirements

- **PHP 8.2** or higher
- **Composer** for dependency management
- **MySQL** or any other supported database
- **Node.js** and **npm** for frontend dependencies (if applicable)

---

## Installation

Follow the steps below to set up and run the project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/adnnco/TaskManagement.git
cd TaskManagement
```

### 2. Install Dependencies

Run the following command to install Laravel dependencies:

```bash
composer install
```

### 3. Set Up Environment

Copy the .env.example file to create a new .env file:

```bash
cp .env.example .env
php artisan key:generate
```

Open the .env file and configure the following variables:
    


### 4. Generate Application Key and JWT Secret

```bash
php artisan key:generate
php artisan jwt:secret
```

### 5. Set Up the Database

* Create a new database with the name specified in your .env file. 
* Run migrations and seed the database:

```bash
php artisan migrate --seed
``` 

### 6. Serve the Application

Start the development server:

```bash
php artisan serve
``` 

Access the application at http://127.0.0.1:8000.

### 7. Run Tests

To run the tests, use the following command:

```bash
php artisan test
```

### API Endpoints

Here is a brief overview of the available API endpoints:

- **GET /api/tasks**: Get all tasks.
- **POST /api/tasks**: Create a new task.
- **GET /api/tasks/{id}**: Get a single task.
- **PUT /api/tasks/{id}**: Update a task.
- **DELETE /api/tasks/{id}**: Delete a task.
- **POST /api/login**: Login and get a JWT token.
- **POST /api/logout**: Logout and invalidate the JWT token.
- **POST /api/register**: Register a new user.

**_Note: Add the Authorization: Bearer {token} header for endpoints requiring authentication._**

### Postman Collection

To interact with the API, you can use the provided Postman collection:

1.	Import the collection from the repository ([WisTaskManagmentApi.json](WisTaskManagmentApi.json)).
2.	Set up an environment variable for the JWT token.
3.	Run the requests to interact with the API.

### Contribution

Contributions are welcome! Feel free to fork the repository and submit a pull request for any improvements.
