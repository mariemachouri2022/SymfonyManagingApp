<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeacherController extends AbstractController
{
    // 1 ere façon pour declarer un route
    #[Route('/teacher', name: 'app_teacher')]
    public function index(): Response
    {
        return new Response("Hello");
    }

    
    #[Route('/showteacher/{name}/{id}',name:'app_showteacher')]
    public function showTeacher($name,$id){
        return new Response("Bonjour ". $name.' '.$id);
    }



    #[Route('/show', name:'app_showteacher')]
    public function show(){
        $title = "Teacher";
        $teachers = array (
            array('id'=>1,'name'=>'test','salaire'=>1000),
            array('id'=>2,'name'=>'mariem','salaire'=>2000),
            array('id'=>3,'name'=>'eljamila','salaire'=>3000)
        );
        return $this->render('teacher/showT.html.twig',['t'=>$title,'tt'=>$teachers]);
    }
    #[Route('/details/{id}',name:'app_details_teacher')]
    public function details($id){
       return $this->render('teacher/details.html.twig',['id'=>$id]);
    }
}
