<?php

// src/Controller/Library/LibraryController.php
namespace App\Controller\Library;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Livre;

class LibraryController extends Controller
{
    public function Index(Request $request)
    {
        $sSecret = "AIzaSyAhuwOyHCANRqaNa66WtUdyrfFtK2-7S9M";

        $oEm = $this->getDoctrine()->getManager();
        $sQuery = $oEm->createQuery('SELECT l FROM App\Entity\Livre l');
        $aResult = $sQuery->getResult();

        $livre = new Livre();

        // Si la requête est en POST
        if ($request->isMethod('POST')) {
    
        $aIsbn = $request->request->all();
        $sIsbn = $aIsbn["isbn"];

        $sUrl="https://www.googleapis.com/books/v1/volumes?q=isbn:" . $sIsbn . "&key=" . $sSecret . "";

        // Curling Google Books API

        $fCurl = curl_init();
        $aOpts = [
            CURLOPT_URL => $sUrl,
            CURLOPT_RETURNTRANSFER => true,
        ];
        curl_setopt_array($fCurl, $aOpts);
        $response = curl_exec($fCurl);
        curl_close($fCurl);
        $res = json_decode($response);
        
        dump($res);

        $oMain = $res->items[0]->volumeInfo;

        $title = $oMain->title;
        $author = $oMain->authors[0];
        $synopsis = "";
        $isbn = $sIsbn;
        $genre = "";

        $livre
            ->setTitle($title)
            ->setAuthor($author)
            ->setSynopsis($synopsis)
            ->setIsbn($isbn)
            ->setStatus("0")
            ->setGenre($genre);
        $oEm->persist($livre); 
        $oEm->flush();
  
          $request->getSession()->getFlashBag()->add('notice', 'Le livre a bien été ajouté à votre bibliothèque personnelle.');
  
          // On redirige vers la page de visualisation de l'annonce nouvellement créée
      }

        return $this->render('Library/index.html.twig', array(
            'aResult' => $aResult
        ));
    }

}