<?php

namespace App\Controllers;

use Silex\Application;
use \LazopRequest;

class Orders
{
    public function get(Application $app, $status, $page)
    {
        $orderPerPage = 10;

        $accessToken = $app['config']['appCredentials']['accessToken'];
        $client = $app['lazadaClient'];

        $request = new LazopRequest('/orders/get', 'GET');
        $request->addApiParam('created_before', '2019-02-10T16:00:00+08:00');
        $request->addApiParam('created_after', '2017-02-10T09:00:00+08:00');
        $request->addApiParam('status', $status);
        $request->addApiParam('offset', $page * $orderPerPage);
        $request->addApiParam('limit', $orderPerPage);
        $request->addApiParam('sort_by', 'updated_at');
        $response = json_decode($client->execute($request, $accessToken));
        $data = $response->data;


//        $h = "<h1>Status $status</h1>"
//            . "<h1>Page $page</h1>" . PHP_EOL;
//        return $h . '<pre>' . json_encode($data, JSON_PRETTY_PRINT);

        return $app['twig']->render('orders.twig', [
            'status'   => $status,
            'orders'   => $response->data->orders,
            'page'     => $page,
            'previous' => $page - 1,
            'next'=> $page + 1,
        ]);
    }
}
