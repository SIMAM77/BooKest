<?php

// src/Controller/Library/LibraryController.php
namespace App\Controller\Library;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\BiblioUser;

class LibraryController extends Controller
{
    public function Index()
    {
        $s_secret = "AIzaSyAhuwOyHCANRqaNa66WtUdyrfFtK2-7S9M";
        $s_url="https://www.googleapis.com/books/v1/volumes?q=Couleur&maxresults=40&key=" . $s_secret . "";

        $curl = curl_init();
        $opts = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ];
        curl_setopt_array($curl, $opts);
        $response = curl_exec($curl);
        curl_close($curl);

        $res = json_decode($response);

        dump($res);

        $oEm = $this->getDoctrine()->getManager();
        $a_query = $oEm->createQuery('SELECT l FROM App\Entity\Livre l')->getResult();

        return $this->render('Library/index.html.twig', array(
            'aQuery' => $a_query[0]
        ));
    }
}