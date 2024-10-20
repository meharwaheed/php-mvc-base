<?php


use App\Controllers\HomeController;

$routes = [
    [
        'path' => '/driver/:id/race/:raceId',
        'controller' => HomeController::class,
        'action' => 'viewHomePage',
    ],
];