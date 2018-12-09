<?php

namespace App\Controllers;

use App\Services\Mailer;
use Silex\Application;

class Test
{
    public function index(Application $app)
    {
//        /** @var Mailer $mailer */
//        $mailer = $app['mailer'];
//
//        try {
//            $mailer->send('izenbard@gmail.com', 'Adil', '9.03', 'SUPER TOP RATED');
//            $mailer->send('Olennalfie@yandex.ru', 'Adil', '9.03', 'SUPER TOP RATED');
//        } catch (\Exception $exception) {
//            return $exception->getMessage();
//        }

//        $app['service1'];

        echo $app['service1'];
        die();
    }
}
