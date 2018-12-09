<?php

namespace App\Controllers;

use Silex\Application;

class Message
{
    public function send(Application $app)
    {
        return $app['twig']->render('message.twig', [
            'email'   => $_GET['email'],
            'name'   => $_GET['name'],
        ]);
    }
}