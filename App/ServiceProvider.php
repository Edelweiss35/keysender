<?php

namespace App;

use App\Models\Codes;
use App\Models\Groups;
use \Pimple\ServiceProviderInterface;
use \Pimple\Container;
use \LazopClient;
use \PDO;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['config'] = function () {
            return parse_ini_file(__DIR__ . "/../config.ini", true);
        };
        $app['lazadaClient'] = function () use ($app) {
            $cred = $app['config']['appCredentials'];
            return new LazopClient('https://api.lazada.com.ph/rest', $cred['appKey'], $cred['appSecret']);
        };
        $app['mailer'] = function () use ($app) {
            return new Services\Mailer($app['config']['email']);
        };
        $app['pdo'] = function () use ($app) {
            $config = $app['config']['database'];
            $dsn = "mysql:dbname={$config['dbname']};host={$config['host']}";
            return new PDO($dsn, $config['username'], $config['password']);
        };
        $app['groupsModel'] = function () use ($app) {
            return new Groups($app['pdo']);
        };
        $app['codesModel'] = function () use ($app) {
            return new Codes($app['pdo']);
        };
    }
}
