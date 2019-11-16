# Circus company website

This website contains a visitor area and an administration area.

It's possible to dynamically manage Performers, Performances, About Us, Prices and Date and location of the newt shows.

![Wild Circus](201901_wildcircus.gif)

### Prerequisites

You need [Composer](https://getcomposer.org/download/) and [Yarn](https://yarnpkg.com/fr/docs/install#debian-stable) in your computer.

### Installing

* Clone the project `git clone https://github.com/Amandine1345/201901-WildCircus-website.git`
* Open the folder, configure the constants in *.env* file 
```
APP_ENV=dev
APP_SECRET=your-secret-message
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
MAILER_FROM_ADDRESS=administrator_email
MAILER_URL=null://localhost
```
* Run commands
```
composer install
yarn install
yarn encore dev
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
* Create an user admin
`php bin/console app:create-user <email> <password>`
* Run server `php bin/console server:run`

### Build With
* HTML 5
* CSS 3
* Bootstrap 4
* Javascript / jQuery
* PHP 7
* Symfony 4
* Twig
* Doctrine

### Versioning

* Git
 
### Contributor

* Amandine Turpin - [Amandine1345](https://github.com/Amandine1345)