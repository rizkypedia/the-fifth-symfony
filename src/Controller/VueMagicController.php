<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VueMagicController extends AbstractController
{
    /**
     * @Route("/vue", name="vue_magic")
     */
    public function vue() {
        return $this->render('vue/vue.html.twig', [
          'title' => ucwords('Vue Magic')
        ]);
    }
}
