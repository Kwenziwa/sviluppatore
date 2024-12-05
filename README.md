
# Project Title

A brief description of what this project does and who it's for

## Installation

This is a Laravel project integrated with Filament, a powerful admin panel for managing your application's data.

## Requirements

- PHP >= 8.2
- Composer
- Laravel >= 11.x
- MySQL or another supported database

## Installation Instructions

Follow these steps to install and run the project.

### 1. Clone the Repository

First, clone the project repository to your local machine:

```bash
git clone https://github.com/Kwenziwa/sviluppatore.git
cd sviluppatore
```

### 2. Install Dependencies

Run the following command to install the project's PHP dependencies:

```bash
composer install
```

### 3. Set Up Environment File

Copy the .env.example file to .env:

```bash
cp .env.example .env

```

### 4. Configure Database

Open the .env file and update the database settings with your local database credentials:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

```

### 5. Generate Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

### 6. Run Migrations and Seeders

To run the database migrations and seed the database with initial data, run the following command:

```bash
php artisan migrate --seed
```

### 7. Start the Local Development Server

Run the following command to start the development server:

```bash
php artisan serve
```

Your Laravel application should now be running on <http://localhost:8000>.

### 8. Access Filament Admin Panel

You can access the Filament admin panel by visiting <http://127.0.0.1:8000/admin/>. The default admin login credentials are:

Email: <admin@admin.com>  
Password: password

You can access the Filament admin panel by visiting the following URL:

```bash
http://your_poject_url.test/admin
```

To access the class-methods data, you can visit the following URL:

```bash
http://your_poject_url.test/admin/class-methods
```

## How to use the runBackgroundJob function with examples

Run the following command to test failair or success

```bash
  php artisan background-failed

  php artisan background-success    
```

## Ensure Only Pre-Approved Classes Can Run in the Background

For added security, ensure that only pre-approved job classes can be dispatched and run in the background by using a configuration file to define allowed job classes.

Steps to Implement Background Job Security
Create a Configuration File for Allowed Classes:

You can define the allowed job classes in a configuration file  ```config/background_jobs.php```.

```bash
return [
    'allowed_classes' => [
        'App\\Jobs\\JobDemoClass',
        'App\\Jobs\\AnotherJobClass',
        // Add more pre-approved job classes here
    ],
];
```

## Running a Background Job

If you want to run a specific background job programmatically, you can use the runBackgroundJob() method, which allows you to specify the job class, method, parameters, retry count, delay, and priority.

Example of Running a Background Job:
To dispatch a job using runBackgroundJob(), you can use the following method call:

```bash
runBackgroundJob(
    'App\\Jobs\\JobDemoClass',  // Class name
    'process',                  // Method name
    ['John Doe', 'john@example.com'],  // Parameters
    3,                          // Max retries
    15,                         // Delay in seconds
    1                           // Priority
);
```

### Explanation of Parameters

- ```Class name```: The fully qualified class name of the job (App\\Jobs\\JobDemoClass).
- ```Method name```: The method within the job class to be called (process).
- ```Parameters```: An array of parameters that will be passed to the method. In this case, name and email are passed as parameters.
- ```Max retries```: The number of times the job will be retried if it fails (in this case, 3 retries).
- ```Delay```: The delay (in seconds) before the job is executed (in this case, 15 seconds).
- ```Priority```: The priority of the job (a lower number indicates higher priority).
