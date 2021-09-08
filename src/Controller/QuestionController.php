<?php

namespace App\Controller;

use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;   
    }

    /**
     * @Route("/questions/add",name="app_question_add")
     */
    public function add(){
        $questionData = [
            "name" => "Missing-pants",
            "slug" => "missing-pants-".rand(0,100),
            "question" => <<<EOF
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
            sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
            sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 
            Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            EOF
        ];
        $question = new Question();
        $question->setName($questionData['name']);
        $question->setSlug($questionData['slug']);
        $question->setQuestion($questionData['question']);
        if (rand(1,10) > 2) {
            //$question->setAskedAt(new \DateTime(sprintf('-%d days', rand(1,100))));
        }
        //$this->entityManager->persist($question);
        //$this->entityManager->flush();

        return $this->json($questionData);
    }

}