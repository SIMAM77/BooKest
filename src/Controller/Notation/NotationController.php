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

  public function BookNotation ($id, $notation) {
    $elements = $this->getDoctrine()->getRepository(Livre::class);
    $book = $elements->find($id);

    $book_notation = $book->getNotation();
    $new_notation = array_push($book_notation, $notation);

    $book->setNotation($new_notation);
    $book->save();

    return;
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