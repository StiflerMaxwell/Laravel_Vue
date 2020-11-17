This is a Laravel + Vue SPA CRM system Demo


to install run the following commands:

// run command install packages
* composer update

copy .env.example and rename to .env 

change the DB info accrodingly 

// generate app key
* php artisan key:generate 

// generate API passport key
* php artisan passport:keys

// database migration
* php artisan migrate:fresh --seed

// run this to start the App
* php artisan serve



