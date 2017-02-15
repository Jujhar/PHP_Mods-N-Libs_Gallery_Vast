<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('default/item.html.twig', [
            'item' => $item,
            'view' => 'items/' . mb_strtolower($item->name) . '.php'
        ]);
    }
}
