<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use App\Entity\Place;

class PlaceController extends Controller
{

    /**
     * Retrieves a Place resource
     * @Rest\Get("/places/")
     */
    public function getPlaces(): View
    {
        $o_place = $this->getDoctrine()->getRepository(Place::class)->findAll();

        if(empty($o_place)){
            return View::create("Il n'y a aucune ville à afficher.", Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_place, Response::HTTP_OK);
        }
        
    }

    /**
     * Retrieves a Place resource
     * @Rest\Get("/place/{placeId}")
     */
    public function getPlace(int $placeId): View
    {
        $o_place = $this->getDoctrine()->getRepository(Place::class)->findById($placeId);

        $s_error = "Il n'y a aucune ville à afficher";

        if(empty($o_place)){
            return View::create($s_error, Response::HTTP_NOT_FOUND);
        } else {
            return View::create($o_place, Response::HTTP_OK);
        }
        
    }

}