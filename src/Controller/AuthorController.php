<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Author;
use App\Entity\Book;
use App\Form\AuthorType;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(AuthorRepository $repo): Response
    {

       
        $authors = $repo->findAll();

        return $this->render('author/index.html.twig', [
            'authors' => $authors,
        ]);
    }

  /*  #[Route('/author/add', name: 'app_author_add')]
    public function addAuthor(ManagerRegistry $manager){
        $author=new Author();
        $author->setUsername('author2');
        $author->setEmail('author2@esprit.tn');
        $manager->getManager()->persist($author);
        $manager->getManager()->flush();
        return $this->redirectToRoute('app_author');
    }

    #[Route('/author/delete/{id]', name:'app_author_delete')]
        public function deleteAuthor(ManagerRegistry $manager, AuthorRepository $repo,$id){
            $author = $repo->find($id);
            $manager->getManager()->remove($author);
            $manager->getManager()->flush();
            return $this->redirectToRoute('app_author');
        }

        #[Route('/author/update/{id}', name:'app_author_update')]
        public function updateAuthor($id, ManagerRegistry $manager, AuthorRepository $repo){
            
            $author = $repo->find($id);
           
            $author->setUsername('newUsername');
            $author->setEmail('newEmail');
            $entityManager = $manager->getManager();
            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirectToRoute('app_author');
        }
    /* #[Route('/showA/{name}', name:'app_showA')]
    public function showAuthor($name) : Response {
        return new Response("bonjour". $name);
    }*/
    

    #[Route('/author/create', name: 'app_author_create')]
    public function createAuthor(Request $request, EntityManagerInterface $entityManager)
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('app_author');
        }
        return $this->render('author/create.html.twig', ['form' => $form->createView()]);
    }

/*
    #[Route('/author/update/{id}', name: 'app_author_update')]
    public function updateAuthor(Request $request, EntityManagerInterface $entityManager, $id, AuthorRepository $repo)
    {
        $author = $repo->find($id);

     

        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush(); 
            return $this->redirectToRoute('app_author');
        }

        return $this->render('author/update.html.twig', ['form' => $form->createView()]);
    }
*/
    #[Route('/author/delete/{id}', name: 'app_author_delete')]
    public function deleteAuthor($id, EntityManagerInterface $entityManager, AuthorRepository $repo)
    {
        $author = $repo->find($id);
        if ($author) {
            $entityManager->remove($author); 
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_author');
    }


    #[Route('/showAuthor/{name}', name:"app_showAuthor")]

    public function showAuthor($name)  {
         return $this->render('author/showAuthor.html.twig',['name'=>$name]);
    }
    #[Route('/list', name:"app_list")]
    public function list(){
        $title = "Author";
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => ' Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => 'William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' =>200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => ' Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        $totalBooks = 0;

        foreach ($authors as $author) {
            $totalBooks += $author['nb_books'];
        }
        return $this->render('author/list.html.twig',['aa'=>$title, 'a'=>$authors, 'totalBooks' => $totalBooks,]);
    }
   
    #[Route('/author/details/{id}', name:'app_details')]
    public function authorDetails($id): Response {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => ' Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => 'William Shakespeare', 'email' => ' william.shakespeare@gmail.com', 'nb_books' =>200 ),
            array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => ' Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
      $author = null;
      foreach($authors as $a){
        if($a['id']== $id){
            $author = $a;
            break;
        }
      }
        return $this->render('author/showAuthor.html.twig', ['author'=>$author,]);
    }

    #[Route('/addAuthor',name: 'app_author_add')]
    public function addAuthor(Request $request,ManagerRegistry $manager){

        $author = new Author();
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);// el form trajaa l req
        if($form->isSubmitted()){
            $author->setNbBooks(0);

            $manager->getManager()->persist($author);
            $manager->getManager()->flush();
            return $this->redirectToRoute('app_author');
        }
       // $book->setRef($form->getData()->getRef());
       
        return $this->render('author/create.html.twig',[
            'f'=>$form->createView()
        ]);
    }
    #[Route('/updateAuthor/{id}',name: 'app_author_update')]
    public function updateAuthor($id,AuthorRepository $repo,Request $request,ManagerRegistry $manager){

        $author =$repo-> find($id);
        $form = $this->createForm(AuthorType::class,$author);
        $form->handleRequest($request);// el form trajaa l req
        
        if($form->isSubmitted()){
            $author->setNbBooks(0);

            
            $manager->getManager()->flush();
            return $this->redirectToRoute('app_author');
        }
       // $book->setRef($form->getData()->getRef());
       
        return $this->render('author/create.html.twig',[
            'f'=>$form->createView()
        ]);
    }
}
