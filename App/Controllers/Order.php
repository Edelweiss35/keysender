<?php

namespace App\Controllers;

use Silex\Application;
use \LazopRequest;

class Order
{
    public function get(Application $app, $orderId)
    {
        $accessToken = $app['config']['appCredentials']['accessToken'];
        $client = $app['lazadaClient'];

        $request = new LazopRequest('/order/get', 'GET');
        $request->addApiParam('order_id', $orderId);
        $order = json_decode($client->execute($request, $accessToken));

        $request = new LazopRequest('/order/items/get', 'GET');
        $request->addApiParam('order_id', $orderId);
        $items = json_decode($client->execute($request, $accessToken));


//        $h = "<h1>Order $orderId</h1>" . PHP_EOL;
//        return $h . '<pre>' . json_encode($order->data, JSON_PRETTY_PRINT)
//            . json_encode($items->data, JSON_PRETTY_PRINT);
//        die();

        return $app['twig']->render('order.twig', [
            'order'   => $order->data,
            'items'   => $items->data,
        ]);

    }
}
