<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Imagine\Image\Box;
use \Imagine\Image\Point;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/all", name="all")
     */
    public function allAction(Request $request)
    {
        // Get all from database
        $repository = $this->getDoctrine()->getRepository('AppBundle:Item');
        $items = $repository->findAll();

        return $this->render('default/list.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @Route("/item", name="item")
     */
    public function itemAction(Request $request)
    {
        $item_name = $request->query->get('name');
        $repository = $this->getDoctrine()->getRepository('AppBundle:Item');
        $item = $repository->findOneByName($item_name);

        // Render item
        $module = DefaultController::preRenderModule($item_name, $request);

        return $this->render('default/item.html.twig', [
            'item' => $item,
            'view' => 'items/' . mb_strtolower($item->name) . '.html.twig',
            'module' => $module
        ]);
    }

    public function preRenderModule($name, Request $request) {

        if($name == 'Faker') {

            $faker = \Faker\Factory::create();

            // generate data by accessing properties
            $fname = $faker->name;
            // 'Lucy Cechtelar';
            $faddress = $faker->address;
            // "426 Jordy Lodge
            // Cartwrightshire, SC 88120-6700"
            $ftext = $faker->text;

            $returnme = (object)[
                'name' => $fname,
                'address' => $faddress,
                'text' => $ftext,
            ];

            return $returnme;

        }

        elseif ($name == 'Imagine') {

            // Draw eclipse with custom colour
            $color = $request->query->get('color');
            if ($color == '') {
                $color = '#000';
            }
            $palette = new \Imagine\Image\Palette\RGB();
            $imagine = new \Imagine\Gd\Imagine();
            $image = $imagine->create(new Box(400, 300), $palette->color($color));

            $image->draw()
                ->ellipse(new Point(200, 150), new Box(300, 225), $image->palette()->color('fff'));

            $image->save('imagine/ellipse.png');

            // Blur image
            $blurval = $request->query->get('blurval');

            if ($blurval == ''){
                $blurval = 5;
            }

            $image = $imagine->open('imagine/canadaplace.jpg');

            $image->effects()
                ->blur($blurval);

            $image->save('imagine/canadaplaceb.jpg');

            $returnme = (object)[
                'color' => $color,
                'blurval' => $blurval
            ];

            return $returnme;
        }

        elseif ($name = "Monolog") {
            // create a log channel
            $log = new Logger('name');
            $log->pushHandler(new StreamHandler('monolog/log.log', Logger::WARNING));

            // todo
            // add check to see size of file if exceeds a
            // certain size erase file and start fresh

            // get ip address
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            // add records to the log
            $log->alert('Opened monolog', array('info' => $ip, 'info2' => $_SERVER['HTTP_USER_AGENT']));
            $log->debug('Testing debug');
            $log->warning('Sample Warning. Please do not create too many false alarms');
            $log->error('Testing (false alarm)');
            $log->emergency('Testing Emergency (false alarm)');

            // get log contents
            $log_contents = file_get_contents('monolog/log.log');

            $returnme = (object)[
                'log' => $log_contents
            ];

            return $returnme;
        }

    }
}
