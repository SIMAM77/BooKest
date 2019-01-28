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
        $sSecret = "AIzaSyAhuwOyHCANRqaNa66WtUdyrfFtK2-7S9M";
        $url="https://www.googleapis.com/books/v1/volumes?q=Couleur&maxresults=40&key=" . $sSecret . "";

        $curl = curl_init();
        $opts = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        ];
        curl_setopt_array($curl, $opts);
        $response = curl_exec($curl);
        curl_close($curl);

        $res = json_decode($response);

      

        $oEm = $this->getDoctrine()->getManager();
        $aQuery = $oEm->createQuery('SELECT l FROM App\Entity\Livre l')->getResult();

        return $this->render('Library/index.html.twig', array(
            'aQuery' => $aQuery[0]
        ));
    }

    public function BookListPage()
    {
        $a_category = ['Arts & Music', 'Biographies', 'Business', 'Kids', 'Comics', 'Computers', 'Cooking' ];
        $s_secret = "AIzaSyAhuwOyHCANRqaNa66WtUdyrfFtK2-7S9M";

        $a_url = [];
        $a_datas = [];
        foreach($a_category as $api_parameter){
            $url="https://www.googleapis.com/books/v1/volumes?q=subject:" . $api_parameter . "&maxresults=10&key=" . $s_secret . "";
            $curl = curl_init();
            $opts = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
            ];
            curl_setopt_array($curl, $opts);
            $response = curl_exec($curl);
            curl_close($curl);
    
            $res = json_decode($response);
            if(!empty($res)){
                $a_url[] = $res;
            }

            $a_book = [];
            foreach ($a_url as $category) {
                if (!empty($category)) {
                    foreach($category->items as $book){    
                        if(!empty($book->volumeInfo->categories) && in_array($api_parameter, $book->volumeInfo->categories)){                      
                                            
                            $a_book[] = [
                                'titre'       => !empty($book->volumeInfo->title) ? $book->volumeInfo->title : 'null',
                                'auteur'      => !empty($book->volumeInfo->authors) ? $book->volumeInfo->authors : 'null',
                                'description' => !empty($book->volumeInfo->description) ? $book->volumeInfo->description : 'null',
                                'editeur'     => !empty($book->volumeInfo->publisher) ? $book->volumeInfo->publisher : 'null',
                                'genre'       => !empty($book->volumeInfo->categories) ? $book->volumeInfo->categories : 'null',
                                'publication' => !empty($book->volumeInfo->publishedDate) ? $book->volumeInfo->publishedDate : 'null',
                                'isbn'        => !empty($book->volumeInfo->industryIdentifiers[0]->identifier) ? $book->volumeInfo->industryIdentifiers[0]->identifier : 'null',
                            ];
                            $a_datas[$api_parameter] = $a_book;
                        }          
                    }
                }          
            }
        }
        return $this->render('Library/catalogue.html.twig', [
            'elements' => $a_datas
        ]
        );
    }
}