<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use \LazopClient;

class LazadaApiClient implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['lazadaClient'] = function () use ($app) {
            $cred = $app['config']['appCredentials'];
            return new LazopClient('https://api.lazada.com.ph/rest', $cred['appKey'], $cred['appSecret']);
        };
    }
}