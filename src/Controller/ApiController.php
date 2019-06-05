<?php

namespace App\Controller;

use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use App\Entity\User;
use App\Entity\Book;
use App\Entity\Library;

class ApiController extends Controller
{
    private $security;

    public function __construct(Security $o_security)
    {
        $this->security = $o_security;
    }

    // USER API CONTROLLER ----------------------------------------------------------------------------

    /**
     * Get the list of all the users
     * @Rest\Get("/users")
     */
    public function getUsers(): View
    {
        $o_user = $this->getDoctrine()->getRepository(User::class)->findAll();

        if(empty($o_user)){
            return View::create("No user found.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_user, Response::HTTP_OK);
        }

    }

    /**
     * Get the user actually logged
     * @Rest\Get("/apiuser")
     */
    public function getApiUser(Security $o_security): View
    {
        $o_user = $this->security->getUser();

        if(empty($o_user)){
            return View::create("No user found.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_user, Response::HTTP_OK);
        }

    }

    /**
     * Get a user by its id
     * @Rest\Get("/user/{userId}")
     */
    public function getUserById(int $userId): View
    {
        $o_user = $this->getDoctrine()->getRepository(User::class)->findById($userId);

        if(empty($o_user)){
            return View::create("No user found.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_user, Response::HTTP_OK);
        }

    }

    // BOOK API CONTROLLER ----------------------------------------------------------------------------

    /**
     * Get a list of all books
     * @Rest\Get("/books")
     */
    public function getBooks(): View
    {
        $o_book = $this->getDoctrine()->getRepository(Book::class)->findAll();

        if(empty($o_book)){
            return View::create("No book found.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_book, Response::HTTP_OK);
        }

    }

    /**
     * Get a book by its id
     * @Rest\Get("/book/{bookId}")
     */
    public function getBookById(int $bookId): View
    {
        $o_book = $this->getDoctrine()->getRepository(Book::class)->findById($bookId);

        if(empty($o_book)){
            return View::create("No book found.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_book, Response::HTTP_OK);
        }

    }

    /**
     * Get a list of all the user's books
     * @Rest\Get("/user/{userId}/books")
     */
    public function getUserBooks(int $userId): View
    {
        $o_book = $this->getDoctrine()->getRepository(Library::class)->findOneBy(array('user' => $userId))->getBook();

        if(empty($o_book)){
            return View::create("No book found.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_book, Response::HTTP_OK);
        }

    }

    /**
     * Insert a book by ISBN Code
     * @Rest\View(statusCode=201)
     * @Rest\Post("/insert/book/{iIsbn}")
     */
    public function setBook(int $iIsbn): View
    {
        $oEm = $this->getDoctrine()->getManager();
        $sQuery = $oEm->createQuery('SELECT b FROM App\Entity\Book b WHERE b.isbn = '.$iIsbn.'');
        $aResult = $sQuery->getResult();
        $oBook = new Book();

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

                $oBook
                    ->setTitle($title)
                    ->setAuthor($author)
                    ->setSynopsis($synopsis)
                    ->setIsbn($isbn);
                $oEm->persist($oBook);
                $oEm->flush();

                return View::create("The book has been created.", Response::HTTP_CREATED);
            } else {

                return View::create("Error, no book found.", Response::HTTP_NOT_FOUND);
            }
        }

        return View::create("The book already exists.", Response::HTTP_CONFLICT);
    }

    // set book in Library

    /**
     * Set a book into a user library
     * @Rest\View(statusCode=201)
     * @Rest\Post("/setbook/{bookId}")
     */
    public function setUserBook(Security $o_security, int $bookId): View
    {

        $oEm = $this->getDoctrine()->getManager();
        $o_user = $this->security->getUser();
        $o_book = $this->getDoctrine()->getRepository(Book::class)->findOneBy(array('id' => $bookId));

        if(empty($o_user)){

            return View::create("User not logged in.", Response::HTTP_NOT_FOUND);
        } else {

            $o_library = new Library();
            $o_user->setLibrary($o_library);
            $o_library->addBook($o_book);
            $o_library->setStatus(1);

            $oEm->persist($o_library);
            $oEm->persist($o_user);

            $oEm->flush();
            return View::create("Book added to user's library", Response::HTTP_OK);
        }
    }

    /**
     * Remove a book from a user library
     * @Rest\View(statusCode=201)
     * @Rest\Delete("/removebook/{bookId}")
     */
    public function removeUserBook(Security $o_security, int $bookId): View
    {

        $oEm = $this->getDoctrine()->getManager();
        $o_user = $this->security->getUser();
        $o_library = $this->getDoctrine()->getRepository(Library::class)->findOneBy(array('book' => $bookId, 'user' => $o_user));

        if(empty($o_user)){

            return View::create("User not logged in.", Response::HTTP_NOT_FOUND);
        } else {

            $oEm->remove($o_library);
            $oEm->flush();

            return View::create('Book succesfully removed', Response::HTTP_OK);
        }
    }

    // --------- SHARING BOOKS API METHODS

    /**
     * Start a share. !!! WARNING !!! The share must start by the borrower
     * @Rest\View(statusCode=201)
     * @Rest\Post("/share/start/{bookId}/{lenderId}")
     */
    public function startSharing(Security $o_security, int $book_id = null, int $lender_id = null)
    {

        $oEm = $this->getDoctrine()->getManager();
        $o_borrower = $this->security->getUser();
        $o_book = $this->getDoctrine()->getRepository(Book::class)->findOneBy(array('id' => $book_id));
        $o_lender = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('id' => $lender_id));

        if(empty($o_borrower)){

            return View::create("User not logged in.", Response::HTTP_NOT_FOUND);
        } else {

            $o_books = $o_borrower->getLibrary();
            return View::create($o_books, Response::HTTP_OK);
        }
    }

    /**
     * Set a rate
     * @Rest\View(statusCode=201)
     * @Rest\Post("/book/{bookId}/rate/{iRate}")
     */
    public function setBookRate(Security $o_security, int $iRate): View
    {

        $oEm = $this->getDoctrine()->getManager();
        $o_user = $this->security->getUser();
        $o_book = $this->getDoctrine()->getRepository(Rate::class)->findOneBy(array('book' => $bookId));

        if(empty($o_user)){

            return View::create("User not logged in.", Response::HTTP_NOT_FOUND);
        } else {

            $o_rate = new Rate();
            $o_rate->setBook($o_book);
            $o_rate->setUser($o_user);
            $o_rate->setRate($iRate);

            $oEm->persist($o_rate);
            $oEm->persist($o_book);

            $oEm->flush();
            return View::create("Rate added", Response::HTTP_OK);
        }
    }

    /**
     * Set a comment
     * @Rest\View(statusCode=201)
     * @Rest\Post("/book/{bookId}/rate/{sComment}")
     */
    public function setBookComment(Security $o_security, int $sComment): View
    {

        $oEm = $this->getDoctrine()->getManager();
        $o_user = $this->security->getUser();
        $o_book = $this->getDoctrine()->getRepository(Rate::class)->findOneBy(array('book' => $bookId));

        if(empty($o_user)){

            return View::create("User not logged in.", Response::HTTP_NOT_FOUND);
        } else {

            $o_comment = new Comment();
            $o_comment->setBook($o_book);
            $o_comment->setUser($o_user);
            $o_comment->setComment($sComment);

            $oEm->persist($o_comment);
            $oEm->persist($o_book);

            $oEm->flush();
            return View::create("Comment added", Response::HTTP_OK);
        }
    }
}