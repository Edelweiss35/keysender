<?php

namespace App\Controllers;

use App\Models\Codes;
use App\Models\Groups;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Twig_Environment;

class Database
{
    public function index(Application $app, $page)
    {
        /** @var $app Twig_Environment[]|Groups[] */
        $groups = $app['groupsModel']->page($page);

        return $app['twig']->render('database.twig', [
            'groups'          => $groups,
            'page'            => $page,
            'disablePrevious' => ($page == 1),
            'disableNext'     => count($groups) < $app['groupsModel']->limit,
        ]);
    }

    public function addCodeGet(Application $app, $groupId)
    {
        /** @var $app Twig_Environment[]|Groups[] */

        return $app['twig']->render('addCodeForm.twig', [
            'group'   => $app['groupsModel']->getDetails($groupId),
            'success' => true,
            'message' => '',
        ]);
    }

    public function addCodePost(Application $app, Request $request, $groupId)
    {
        /** @var $app Twig_Environment[]|Codes[]|Groups[] */

        var_export($_POST);

        $codes = explode("\n", $request->get('codes'));
        try {
            $app['codesModel']->add(
                $codes,
                $request->get('group-id'),
                $request->get('usage')
            );
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }

        return $app['twig']->render('addCodeForm.twig', [
            'group'   => $app['groupsModel']->getDetails($groupId),
            'success' => true,
            'message' => '',
        ]);
    }


    public function addGroupGet(Application $app)
    {
        return $app['twig']->render('addGroupForm.twig', [
            'success' => true,
            'message' => '',
        ]);
    }

    public function addGroupPost(Application $app, Request $request)
    {
        /** @var $app Twig_Environment[]|Groups[] */

        try {
            $app['groupsModel']->add(
                $request->get('group-name'),
                $request->get('shop-sku')
            );

            $context = [
                'success' => true,
                'message' => 'Group successfully added',
            ];
        } catch (\Exception $exception) {
            $context = [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
        return $app['twig']->render('addGroupForm.twig', $context);
    }

}