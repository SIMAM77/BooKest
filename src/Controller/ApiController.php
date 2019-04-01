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
use App\Entity\BiblioUser;

class ApiController extends Controller
{

    // USER API CONTROLLER ----------------------------------------------------------------------------

    /**
     * Retrieves a user resource
     * @Rest\Get("/users")
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
    public function getUserById(int $userId): View
    {
        $o_user = $this->getDoctrine()->getRepository(Users::class)->findById($userId);

        $s_error = "Il n'y a aucun utilisateur à afficher";

        if(empty($o_user)){
            return View::create("Il n'y a aucun utilisateur à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_user, Response::HTTP_OK);
        }
        
    }

    // BOOK API CONTROLLER ----------------------------------------------------------------------------

    /**
     * Retrieves all books
     * @Rest\Get("/books")
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
     * Retrieves a book resource
     * @Rest\Get("/book/{bookId}")
     */
    public function getBook(int $bookId): View
    {
        $o_book = $this->getDoctrine()->getRepository(Livre::class)->findById($bookId);

        $s_error = "Il n'y a aucun livre à afficher";

        if(empty($o_book)){
            return View::create("Il n'y a aucun livre à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_book, Response::HTTP_OK);
        }
        
    }

    /**
     * Retrieves all user books resource
     * @Rest\Get("/user/{userId}/books")
     */
    public function getUserBooks(int $userId): View
    {
        $o_book = $this->getDoctrine()->getRepository(BiblioUser::class)->findBy(array('id_user' => $userId));

        if(empty($o_book)){
            return View::create("Il n'y a aucun livre à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_book, Response::HTTP_OK);
        }
        
    }


    // --------- SHARING BOOKS API METHODS

    /**
     * Push a new book
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/insert/book/{iISBN}")
     */
    public function setBook(int $iISBN)
    {
        $o_book = $this->getDoctrine()->getRepository(Livre::class)->setIsbn(array('isbn' => $iISBN));
        
    }

    // set book in BiblioUser

}