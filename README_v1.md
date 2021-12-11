Step 1: Use the —composer create-project laravel/laravel category-test command to create the project.
Step 2: Use composer require laravel/passport to add the passport.
Step 3: Make a database and run the command php artisan migrate to get all tables.
Step 4: Run the command —php artisan passport:install to activate the passport.
Step 5: Published the passport a php artisan passport vendor::publish --tag=passport-config
Step 6: Use php artisan make:controller api/LoginController command to create a controller.
Step 7: Create a controller that has all of the resources required to perform CRUD operations. php make:controller api/user/ProductController —resource 

Step 8: Create a controller that has all of the resources required to perform CRUD operations. PHP — controller api/user/CategoryController —resource

Step 9: Using the command —php artisan make:model Product -m, create a model and a migration file, then change the migration file and model file as needed.

Step 10 : To update the database, execute the following command. php artisan migrate

Step 11 : php artisan make:model Category -m
Step 12: php artisan migrate
Step 13 :  php artisan make:model Product_Category -m
Step 14 :  php artisan migrate
Step 15 :  php artisan serve