<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StudentController extends AbstractController {

    #[Route('/student', name: 'app_student')]
    public function index(): Response {
         return new Response("Bonjour mes étudiants");
    }
    #[Route('/goToIndex', name: 'app_go_to_index')]
    public function goToIndex(): RedirectResponse {
         return $this->redirectToRoute('app_student');
    }
}
?>