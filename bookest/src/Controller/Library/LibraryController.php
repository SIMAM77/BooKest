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

        // $tab_category = ['Arts & Music', 'Biographies', 'Business', 'Kids', 'Comics', 'Computers of Techn', 'Cooking', 'Hobbies & Crafts', 'Edu & Reference', 'Gay & Lesbian' ];
        // $sSecret = "AIzaSyAhuwOyHCANRqaNa66WtUdyrfFtK2-7S9M";

        // foreach($tab_category as $api_parameter){
        //     $url="https://www.googleapis.com/books/v1/volumes?q=subject:" . $api_parameter . "&maxresults=10&key=" . $sSecret . "";
        // }


        // // $url="https://www.googleapis.com/books/v1/volumes?q=martine&maxresults=4&key=" . $sSecret . "";
        // // $url="https://www.googleapis.com/books/v1/volumes?q=subject:romance&maxresults=10&key=" . $sSecret . "";


        // $curl = curl_init();
        // $opts = [
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        // ];
        // curl_setopt_array($curl, $opts);
        // $response = curl_exec($curl);
        // curl_close($curl);

        // $res = json_decode($response);

        $tab_category = ['Arts & Music', 'Biographies', 'Business', 'Kids', 'Comics', 'Computers of Techn', 'Cooking', 'Hobbies & Crafts', 'Edu & Reference', 'Gay & Lesbian' ];
        $sSecret = "AIzaSyAhuwOyHCANRqaNa66WtUdyrfFtK2-7S9M";

        $tab_url = [];
        foreach($tab_category as $api_parameter){
            $url="https://www.googleapis.com/books/v1/volumes?q=subject:" . $api_parameter . "&maxresults=10&key=" . $sSecret . "";

            $curl = curl_init();
            $opts = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
            ];
            curl_setopt_array($curl, $opts);
            $response = curl_exec($curl);
            curl_close($curl);
    
            $res = json_decode($response);
            $tab_url[$api_parameter] = $res;
        }

        
        
        $tab_book = [];
        $tab_toto = [];
        $i = 0;
        foreach ($tab_url as $key => $category) {
            // dump($category);
            if (!empty($category)) {
                foreach($category->items as $book){
                    // dump(implode($book->volumeInfo->categories));
                    // dump(strpos(implode($book->volumeInfo->categories), $key));
                    // if (strpos(implode($book->volumeInfo->categories), $key) !== false) {

                    if (in_array($key, $book->volumeInfo->categories)) {
                        $tab_book[] = [
                            'titre'       => !empty($book->volumeInfo->title) ? $book->volumeInfo->title : 'null',
                            'auteur'      => !empty($book->volumeInfo->authors) ? $book->volumeInfo->authors : 'null',
                            'description' => !empty($book->volumeInfo->description) ? $book->volumeInfo->description : 'null',
                            'editeur'     => !empty($book->volumeInfo->publisher) ? $book->volumeInfo->publisher : 'null',
                            'genre'       => !empty($book->volumeInfo->categories) ? $book->volumeInfo->categories : 'null',
                            'publication' => !empty($book->volumeInfo->publishedDate) ? $book->volumeInfo->publishedDate : 'null',
                            'isbn'        => !empty($book->volumeInfo->industryIdentifiers[0]->identifier) ? $book->volumeInfo->industryIdentifiers[0]->identifier : 'null',
                        ];
                    
                        // dump($tab_book['genre]);
                        // $tab_toto[$key] = $tab_book;
                    }
                }
            }
            $i++;
            
            
        }
        // dump($tab_url);
        // dump($tab_toto);
        // dump($tab_book);

        // foreach($tab_book as $temp){
        //     dump(implode($temp['genre']));
        // }

        return $this->render('Library/catalogue.html.twig', [
            'toto' => 'toto',
            'elements' => $tab_book
            ]
        );
    }
}