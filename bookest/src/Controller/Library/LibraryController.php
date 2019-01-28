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

      

        if(isset($res->items)){

            $oMain = $res->items[0]->volumeInfo;

            $title = $oMain->title;

            if(isset($res->authors)){
                
                for ($i = 1; $i <= 10; $i++) {
                    $author = $oMain->authors[$i];
                }

            } else {

                $author = "Auteur Inconnu";

            }

            if(isset($res->description)){

                $synopsis = $oMain->description;

            } else {

                $synopsis = "Résumé indisponible";

            }

            $isbn = $sIsbn;

            if(isset($res->categories)){

                for ($i = 1; $i <= 10; $i++) {
                    $genre = $oMain->categories[$i];
                }

            } else {

                $genre = "Inconnu";

            }

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

        } else {

            $request->getSession()->getFlashBag()->add('notice', 'Le livre n\'existe pas, veuillez réessayer.');

        }

      }

        return $this->render('Library/index.html.twig', array(
            'aResult' => $aResult
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