# Installation instructions using XAMPP

## XAMPP database setup
```
1. Run XAMPP control panel
2. Start Apache and MySQL
3. Click on admin to navigate to localhost/phpmyadmin in your browser
4. Create a new database named "mybooks"
```

## Application setup
```
1. git clone https://github.com/Craigr99/myBooks.git
2. cd myBooks
3. run composer install
4. run npm install
5. run npm run dev
6. In the project root, rename the .env.example to .env
7. Set up values in .env file:
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=mybooks
    DB_USERNAME=root
    DB_PASSWORD=
8. run php artisan key:generate
9. run php artisan migrate --seed
10.run php artisan serve
```
