### Installation

1. Clone repo

2. Change to directory

````
cd assessment_kalpa
````   

3. Install dependencies

````
composer install
````

4. Copy .env file

```
cp .env.example .env
```

5. Modify `DB_*` value in `.env` with your database config.
Setup Environment variable for Database

```
UNIX_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock  (needed to change in config database file. I have changed unix_socket for convinent propose as of system )
DB_CONNECTION=mysql
DB_HOST=localhost:8888
DB_PORT=3306
DB_DATABASE=root
DB_USERNAME=root
DB_PASSWORD=root
````

6. Generate application key:

````
php artisan key:generate
````

7. Migrate
````
php artisan migrate
````

8. Install Node modules
````
npm install
````

9. Build

````
npm run prod
````

### Dummy Data

1. Open Tinker

````
php artisan tinker
````
    
2. Use factory script
````
Drug::factory()->count(10)->create()
````

### Queue Job

Implementation of Registered drugs should be valid till 1 year from the date of approval. After expiration, the drug registered should be pooled back for renewal this can be accomplished through Url as well as through command line Queue can be fired.
````
php artisan queue:work
````

Laravel Cron Jobs Scheduling is also implemented to automate the validation of registered drugs #some settings are required to test

````
php artisan schedule:run
````
