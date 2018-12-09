<?php

namespace App\Controllers;

use Silex\Application;
use \LazopRequest;

class ReadyToShip
{
    public function index(Application $app, $orderId)
    {
        echo "$orderId";
        die();

    }
}
