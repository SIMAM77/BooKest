<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use App\Entity\Users;
use App\Entity\Livre;

class ApiController extends Controller
{

    // USER API CONTROLLER ----------------------------------------------------------------------------

    /**
     * Retrieves a user resource
     * @Rest\Get("/users/")
     */
    public function getUsers(): View
    {
        $o_user = $this->getDoctrine()->getRepository(Users::class)->findAll();

        if(empty($o_user)){
            return View::create("Il n'y a aucun utilisateur à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_user, Response::HTTP_OK);
        }
        
    }

    /**
     * Retrieves a usr resource
     * @Rest\Get("/user/{userId}")
     */
    public function getUser(int $userId): View
    {
        $o_user = $this->getDoctrine()->getRepository(Users::class)->findById($userId);

        $s_error = "Il n'y a aucune ville à afficher";

        if(empty($o_user)){
            return View::create("Il n'y a aucun utilisateur à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_user, Response::HTTP_OK);
        }
        
    }

    // BOOK API CONTROLLER ----------------------------------------------------------------------------

    /**
     * Retrieves a user resource
     * @Rest\Get("/books/")
     */
    public function getBooks(): View
    {
        $o_book = $this->getDoctrine()->getRepository(Livre::class)->findAll();

        if(empty($o_book)){
            return View::create("Il n'y a aucun livre à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_book, Response::HTTP_OK);
        }
        
    }

    /**
     * Retrieves a usr resource
     * @Rest\Get("/book/{userId}")
     */
    public function getBook(int $bookId): View
    {
        $o_book = $this->getDoctrine()->getRepository(Livre::class)->findById($bookId);

        $s_error = "Il n'y a aucune ville à afficher";

        if(empty($o_book)){
            return View::create("Il n'y a aucun livre à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_book, Response::HTTP_OK);
        }
        
    }

}