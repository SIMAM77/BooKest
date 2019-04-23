<?php
// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivreNotationForm extends Controller
{
  public function addAction(Request $request)
  {
    // On crée un objet Advert
    $advert = new LivreNotation();

    // On crée le FormBuilder grâce au service form factory
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $advert);

    // On ajoute les champs de l'entité que l'on veut à notre formulaire
    $formBuilder
      ->add('livre',      IntegerType::class)
      ->add('emprunteur', TextType::class)
      ->add('prêteur',    TextType::class)
      ->add('notation',   IntegerType::class)
      ->add('date',       DateType::class)
      ->add('save',       SubmitType::class)
    ;
    // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

    // À partir du formBuilder, on génère le formulaire
    $form = $formBuilder->getForm();

    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('OCPlatformBundle:LivreNotation:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
}