## Users CRUD with Event and Listers

-   It's a Users CRUD with softDeletes and restore options
-   Also has Event and Listers
-   Following Design patterns and SOLID principle to write code 
-   Also following DRY principle to write code
-   Make blade components where needed

## Technology used

-   Php 8.3.4
-   Laravel 11
-   MySQL
-   Bootstrap 5
-   jQuery 3.6
-   YajraBox Datatable 11
-   Sweet Alert2
-   Toastr JS
-   Tailwind CSS
-   Flowbite

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)

# Installation Guide

1. **Clone or download this Repository.**

    ```
    git clone https://github.com/shantojatri/users_crud_task.git
    ```

2. **Run the command**

    ```
    composer install
    ```

3. **Create `.env` file by copying the `.env.example`, or run the following command**

    ```
    cp .env.example .env
    ```

4. **Update the database name and credentials in `.env` file**

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=users_crud_advanced
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Run the following command**
    ```
    php artisan key:generate
    ```
6. **Run the following command**
    ```
    php artisan storage:link
    ```
7. **To migrate database and seed the datas to DB**
    ```
    php artisan migrate --seed
    ```
8. **Run npm install command**
    ```
    npm install
    ```
9. **Run the command to compile the theme**
    ```
    npm run dev
    ```
10. **Finally run the application**

    ```
    php artisan serve
    ```

11. **For production build**
    ```
    npm run build
    ```




-------------------------------------------------------------------

# Let's run the project and let me know if you have any questions ?
