<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../lazadaSDK/LazopSdk.php";

// Bootstrap
$app = new Silex\Application;
$app['debug'] = true;

// Service Providers
$app->register(new Silex\Provider\TwigServiceProvider, ['twig.path' => __DIR__ . '/../views']);
$app->register(new \App\ServiceProvider);


//$app->register(new App\Providers\Config);
//$app->register(new App\Providers\LazadaApiClient);
//$app->register(new App\Providers\SmtpMailer);
//$app->register(new \App\Providers\PDO);



// Routes
$app->get('/', 'App\\Controllers\\Index::index')->bind('home');
$app->get('/test', 'App\\Controllers\\Test::index');
$app->get('/orders/{status}/{page}', 'App\\Controllers\\Orders::get')->bind('orders');
$app->get('/order/{orderId}', 'App\\Controllers\\Order::get')->bind('order');
$app->get('/items/{orderId}', 'App\\Controllers\\OrderItems::get');
$app->get('/message', 'App\\Controllers\\Message::send')->bind('message');

$app->get('/database/page/{page}', 'App\\Controllers\\Database::index')->bind('database');
$app->get('/database/add-group', 'App\\Controllers\\Database::addGroupGet')->bind('addGroupForm');
$app->post('/database/add-group', 'App\\Controllers\\Database::addGroupPost');

$app->get('/database/add-code/{groupId}', 'App\\Controllers\\Database::addCodeGet')->bind('addCodeForm');
$app->post('/database/add-code/{groupId}', 'App\\Controllers\\Database::addCodePost');


$app->get('/ready-to-ship/{orderId}', 'App\\Controllers\\ReadyToShip::index');


// Run
$app->run();
