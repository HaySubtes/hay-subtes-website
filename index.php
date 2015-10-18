<?php

// define some constants for the project
define('PROJECT_FOLDER', '/');

// load libraries through composer
require_once 'vendor/autoload.php';

// start session management
session_start();

Flight::set('flight.base_url', PROJECT_FOLDER);
Flight::set('blade', new Philo\Blade\Blade(__DIR__ . '/blade/views', __DIR__ . '/blade/cache'));

// routes
Flight::route('/', array('HaySubtes\Home', 'index'));

Flight::start();
