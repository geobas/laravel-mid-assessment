## Technical assessment for building a PoC for an e-commerce application in Laravel

### Description
The goal of this assignment is to build a proof of concept with the business flow(products, cart, checkout, orders etc).

---

### Set up
Install composer dependencies.
```
composer install
```
Build the docker images and start the containers.
```
sail up -d
```
Generate the .env file
```
sail composer run initial-setup
```
Create the necessary database.
```
sail artisan db
create database isellproducts;
```
Run migrations and create some dummy customers and products.
```
sail artisan migrate:fresh --seed
```
Run the application.
```
sail artisan app:run-process
```

---
### You can also break the whole process in smaller steps in order to better understand the codebase.

To add some dummy customers
```
sail artisan app:add-customers
```

To add some dummy products
```
sail artisan app:add-products
```

To create a cart
```
sail artisan app:add-cart
```

To create an order
```
sail artisan app:add-order
```

To make a payment of that order
```
sail artisan app:order-payment
```

To list all available commands of the application
```
sail artisan list app
```
