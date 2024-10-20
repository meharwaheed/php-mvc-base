<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Initialize Eloquent Capsule Manager
$capsule = new Capsule;
// Add a connection to the database
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_DATABASE'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',   // Optional: Table prefix
]);

// Make the Capsule instance available globally
$capsule->setAsGlobal();

// Boot Eloquent so it's ready for usage
$capsule->bootEloquent();
