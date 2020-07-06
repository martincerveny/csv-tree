<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## CSV Tree app
This app allows to import given tags.csv, calculate tree value, move subtree and export changed tree back to CSV.
### How to run
1. Clone repository
2. Make a .env file from .env.example
3. In .env fill credentials (DB name in DB_DATABASE) to empty database
4. Run composer install
5. Run php artisan key:generate
6. Run php artisan migrate


### How to use
1. Prepare your CSV to project folder
2. Run php artisan import:csv
3. Enter name of your CSV without .csv extension

