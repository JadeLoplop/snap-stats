# Snap Stats

## Local Development Setup

Follow these steps to set up the Snap Stats project locally:

```bash
git clone https://github.com/JadeLoplop/snap-stats
cd snap-stats
composer install
cp .env.example .env
php artisan key:generate

```
Open the .env file in a text editor and set up your database connection details:

```bash
DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=your_database_port
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
Next the seeder
```bash
php artisan db:seed
```

Run project and vite
```bash
php artisan serve
npm run dev
```

This will launch the application, and you can access it by visiting http://localhost:8000 in your web browser.
