# 🚀 Cash Flow App Project

## 📖 Table of Contents

-   [Introduction](#introduction)
-   [Features](#features)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Contributing](#contributing)
-   [License](#license)
-   [Contact](#contact)

## 🌟 Introduction

Welcome to **Cash Flow App Project**! Project ini dibuat dengan filament 3 dan laravel 10.

## ✨ Features

-   🚀 **Feature One**: CRUD Categori.
-   🎉 **Feature Two**: CRUD Transaction.
-   💡 **Feature Three**: Dashboard Chart.

## 🛠️ Installation

For **_docker_** user follow these step

1. **Run docker compose command**
    ```sh
    docker compose create
    docker compose start
    ```
2. **Execution container**
    ```sh
    docker exec -it cahs-flow-app bash
    ```
3. **Continue to Installation step**

To get started with **Cash Flow App Project**, follow these steps:

1. **Clone the repository:**
    ```sh
    https://github.com/ekasatriaap/catatan-keuangan.git
    ```
2. **Install dependencies:**
    ```sh
    composer install
    ```
3. **Setup database di .env file:**
4. **Migrate Database**
    ```sh
    php artisan migrate
    ```
5. **Create Storage Link**
    ```sh
    php artisan storage:link
    ```
6. **Create User Filament**
    ```sh
    php artisan make:filament-user
    ```

## 🚀 Usage

After installing, you can start using the project with the following commands:

```sh
php artisan serve
```
