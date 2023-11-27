# Clone the Repository
git clone https://github.com/JadeLoplop/snap-stats

# Navigate to the Project Directory
cd snap-stats

# Install Dependencies
composer install

# Create a Copy of the Environment File
cp .env.example .env

# Generate an Application Key
php artisan key:generate

# Configure the Database
# Open the .env file in a text editor and set up your database connection details
# Example:
# DB_CONNECTION=mysql
# DB_HOST=your_database_host
# DB_PORT=your_database_port
# DB_DATABASE=your_database_name
# DB_USERNAME=your_database_username
# DB_PASSWORD=your_database_password

# Run Migrations
php artisan migrate

# Seed the Database (Optional)
# php artisan db:seed

# Run the Application
php artisan serve
