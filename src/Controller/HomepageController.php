<?php


namespace App\Controller;


use App\Service\SampleService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController
{
    /**
     * @Route("/home",name="home")
     *
     */
    public function homepage(){
        return new Response("Homepage!");
    }

    /**
     *
     * @Route("/sample")
     *
     * @param SampleService $sampleService
     */
    public function sample(SampleService $sampleService){
        return new Response($sampleService->parse("test"));
    }
}
