<?php

namespace App\Controller\Library;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\StreetLibrary;


class StreetLibraryController extends Controller
{
    public function Map(Request $request)
    {
        // StreetLibrary entity query 
        $repository = $this->getDoctrine()->getRepository(StreetLibrary::class);
        $library = $repository->findAll();

        // // CSV INSERTION PART - TO USE TO UPDATE DATABASE THEN REMOVE

        // $tab_street = [];
        // $row = 0;
        // if (($handle = fopen("bible.csv", "r")) !== FALSE) {
        //     while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        //         $num = count($data);
        //         $tab_street[] = $data;
               
        //         for ($c=0; $c < $num; $c++) {
        //             // echo $data[$c] . "<br />\n";
        //         }
        //     }
        //     fclose($handle);
        // }
         // $entityManager = $this->getDoctrine()->getManager();
         // foreach($tab_stlknlknreet as $item){
         //
         //     if($item[2] == 'PARIS' || $item[2] == 'Paris' || $item[2] == 'paris' ){
         //         $row++;
         //         $library = new StreetLibrary();
         //         $library->setName('bibliothèque n°'. $row);
         //         $library->setAdress($item[0].','.' '.$item[1].','.' '.'PARIS');
         //         $library->setGeolocalization(str_replace(" ", "",$item[3]));
    
         // tell Doctrine you want to (eventually) save the library (no queries yet)
         // $entityManager->persist($library);
    
         // actually executes the queries (i.e. the INSERT query)
         // $entityManager->flush();
         //     }
         // }
        
         // Forward to template for rendering
         return $this->render('Street/street-library.html.twig', [
            'elements' => $library,
         ]);
    }
    
}