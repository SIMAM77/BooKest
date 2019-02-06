<?php

// src/Controller/Library/StreetLibraryController.php
namespace App\Controller\Library;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\BiblioRue;

class StreetLibraryController extends Controller
{
    public function Map(Request $request)
    {

        $repository = $this->getDoctrine()->getRepository(BiblioRue::class);

        $bibliotheque = $repository->findAll();
        dump($bibliotheque);

        // $tab_rue = [];
        // $row = 0;
        // if (($handle = fopen("bible.csv", "r")) !== FALSE) {
        //     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        //         // dump($data);
        //         $num = count($data);
        //         $tab_rue[] = $data;
                
        //         for ($c=0; $c < $num; $c++) {
        //             // dump($data[$c]);
        //             // echo $data[$c] . "<br />\n";
        //         }
        //     }
        //     fclose($handle);
        // }

        // $entityManager = $this->getDoctrine()->getManager();

        // foreach($tab_rue as $item){
        //     // dump(str_replace(" ", "",$item[3]));
        //     if($item[2] == 'PARIS' || $item[2] == 'Paris' || $item[2] == 'paris' ){
        //         $row++;
        //         $bibliotheque = new BiblioRue();
        //         $bibliotheque->setName('bibliothèque n°'. $row);
        //         $bibliotheque->setAdress($item[0].','.' '.$item[1].','.' '.'PARIS');
        //         $bibliotheque->setGeolocalization(str_replace(" ", "",$item[3]));
    
        //         // tell Doctrine you want to (eventually) save the bibliotheque (no queries yet)
        //         $entityManager->persist($bibliotheque);
    
        //         // actually executes the queries (i.e. the INSERT query)
        //         $entityManager->flush();
        //     }
        // }
        
        return $this->render('Library/map.html.twig', [
            'elements' => $bibliotheque,
            ]
        );
    }
    
}