<?php


namespace App\Controller;


use App\Service\SampleService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController
{
    /**
     * @Route("/home")
     *
     */
    public function homepage(){
        return new Response("Homepage!");
    }

    /**
     * @Route("/questions/{slug}")
     */
    public function show($slug){
        return new Response("Your slug Parameter:" . $slug);
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
