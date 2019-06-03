## How to run


- Clone this repository.
- Composer update.
- cp .env.example .env.
- php artisan key:generate.
- Open .env file, fill in your database credentials on DB_DATABASE, DB_USERNAME and DB_PASSWORD.
- php artisan migrate --seed.
- npm install && npm run production.
- php artisan serve.
- Open your browser on 127.0.0.1:8000.
