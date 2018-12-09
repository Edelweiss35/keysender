<?php

namespace App\Providers;

use \Pimple\ServiceProviderInterface;
use \Pimple\Container;
use \App\Services\Mailer;

class SmtpMailer implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['mailer'] = function () use ($app) {
            return new Mailer($app['config']['email']);
        };
    }
}

