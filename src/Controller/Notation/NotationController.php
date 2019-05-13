<?php

// src/Controller/Library/LibraryController.php
namespace App\Controller\Notation;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Book;
use App\Form\LivreNotationForm;

class NotationController extends Controller
{
    public function BookNotationForm ($id = null, $notation = null) {

        $notation_new = new Notation();

        $form = $this->createFormBuilder($notation_new)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();

        return $this->render('notation.html.twig', [
            'notation_form' => $form
        ]);
    }

  public function BookNotationController ($id = null, $notation = null, $comment = null) {


    $notation_new = new Notation();

    $elements = $this->getDoctrine()->getRepository(Book::class);
    $book = $elements->find($id);

    $book_notation = $book->getNotation();
    $new_notation = array_push($book_notation, $notation);
    $new_comment = array_push($book_notation, $notation);
    

    $book->setNotation($new_notation);
    $book->setComment($new_comment);
    
    $book->save();

    return ;
  
  }

  public function UserNotation ($id, $notation) {
    $elements = $this->getDoctrine()->getRepository(User::class);
    $user = $elements->find($id);

    $user_notation = $user->getNotation();
    $new_notation = $user_notation + $notation;

    $user->setNotation($new_notation);
    $user->save();

    return;
  }
}