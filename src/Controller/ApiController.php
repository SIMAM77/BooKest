<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use App\Entity\Users;

class ApiController extends Controller
{

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

}