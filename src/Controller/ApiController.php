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
     * Retrieves a user resource
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

    /**
     * Creates a book resource
     * @Rest\View(statusCode=201)
     * @Rest\Post("/insert/book/{iIsbn}")
     */
    public function setBook(int $iIsbn): View
    {
        $oEm = $this->getDoctrine()->getManager();        
        $sQuery = $oEm->createQuery('SELECT l FROM App\Entity\Livre l WHERE l.isbn = '.$iIsbn.'');
        $aResult = $sQuery->getResult();
        $oLivre = new Livre();
        
        if (empty($aResult)) {

            $sSecret = "AIzaSyAhuwOyHCANRqaNa66WtUdyrfFtK2-7S9M";
            $sUrl="https://www.googleapis.com/books/v1/volumes?q=isbn:" . $iIsbn . "&key=" . $sSecret . "";
            
            $fCurl = curl_init();
            $aOpts = [
                CURLOPT_URL => $sUrl,
                CURLOPT_RETURNTRANSFER => true,
            ];
            curl_setopt_array($fCurl, $aOpts);
            $response = curl_exec($fCurl);
            curl_close($fCurl);
            $res = json_decode($response);

            if(isset($res->items)){

                $oMain = $res->items[0]->volumeInfo;
    
                $title = $oMain->title;
    
                if(isset($oMain->authors)){
                    
                    foreach($oMain->authors as $i) {
                        $author = $i;
                    }
    
                } else {
    
                    $author = "Auteur Inconnu";
    
                }
    
                if(isset($oMain->description)){
    
                    $synopsis = $oMain->description;
    
                } else {
    
                    $synopsis = "Résumé indisponible";
    
                }
    
                $isbn = $iIsbn;
    
                if(isset($oMain->categories)){
    
                    foreach($oMain->categories as $i) {
                        $genre = $i;
                    }
    
                } else {
    
                    $genre = "Inconnu";
    
                }
    
                $oLivre
                    ->setTitle($title)
                    ->setAuthor($author)
                    ->setSynopsis($synopsis)
                    ->setIsbn($isbn)
                    ->setStatus("0")
                    ->setGenre($genre);
                $oEm->persist($oLivre); 
                $oEm->flush();

                return View::create("The book has been created.", Response::HTTP_CREATED);
            } else {

                return View::create("Error, no book found.", Response::HTTP_NOT_FOUND);;
            }
        }

        return View::create("The book already exists.", Response::HTTP_CONFLICT);        
    }

    // set book in BiblioUser


    // --------- SHARING BOOKS API METHODS

}