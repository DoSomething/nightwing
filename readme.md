# 🌚 Nightwing
A redirect management application in Laravel.


# Local Development Setup 

1. Clone the repo.
2. `cp .env.example .env` update the settings in that file. 
3. Edit your `Homestead.yml` file to include this new info. Making sure the `folders` and `sites` configuration is correct for your local set up. 
4. Run `vagrant provision` 
4. Add your app url (nightwing.dev) to your `etc/hosts` file i.e. `127.0.0.1 nightwing.dev`
5. Manually create a `nightwing` database in Sequel Pro.
    - Open a `new connection` window and click on the `standard` connection tab
    - Name the connection 
    - Enter host info: `127.0.0.1`
    - Username: `homestead` 
    - Enter password from `.env.local.php` file
    - Port: `33060`
    - Hit `connect`
    - In the `choose database` dropdown select `add database`
    - Name the database `scholarship_app` with UTF-8 encoding.
6. One you finish the rest of the setup below, you can see the whole pretty site at `nightwing.dev:8000`


### Composer

Before doing anything else, you need to install all the project's dependencies with `composer`. 

Within the directory for the project in the Vagrant VM ([instructions here](https://github.com/DoSomething/ds-homestead#ssh-into-virtual-machine)), run:

    $ composer install

### Back-end

To run the migrations to setup your database and then immediately seed it, run (also from the project directory in vagrant):

    $ php artisan migrate && php artisan db:seed

### Front-end

The following commands need to be run from within the root directory for the project on the virtual machine (get comfy in there).

To install the required NPM modules, run:

    $ npm install


## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).
