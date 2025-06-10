## Installation

- Clone this repository on your local computer
- configure .env as needed

On folder project execute

```shell
cp sample.env .env

composer install

php artisan key:generate
php artisan migrate
php artisan db:seed

```

# Credencials

```shell
email: admin@admin.com
password: password
```

# Start Server

```shell
php artisan serve
```