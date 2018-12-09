<?php

namespace App\Controllers;

use Silex\Application;
use \LazopRequest;

class OrderItems
{
    public function get(Application $app, $orderId)
    {
        $accessToken = $app['config']['appCredentials']['accessToken'];
        $client = $app['lazadaClient'];
        $request = new LazopRequest('/order/items/get', 'GET');
        $request->addApiParam('order_id', $orderId);
        $data = json_decode($client->execute($request, $accessToken));

        $h = "<h1>Order items $orderId</h1>" . PHP_EOL;
        return $h . '<pre>' . json_encode($data, JSON_PRETTY_PRINT);
    }
}
