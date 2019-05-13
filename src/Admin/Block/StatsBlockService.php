<?php 
// src/App/Admin/Block 
namespace App\Admin\Block; 
 
use Sonata\BlockBundle\Block\BlockContextInterface; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface; 
use Sonata\AdminBundle\Form\FormMapper; 
use Sonata\AdminBundle\Validator\ErrorElement; 
use Sonata\AdminBundle\Admin\Pool; 
use Sonata\BlockBundle\Model\BlockInterface; 
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage; 
use Doctrine\ORM\EntityManager; 
 
class StatsBlockService extends AbstractBlockService
{ 
    /** * @var TokenStorage */
    protected $securityContext; 
 
    /** * @var EntityManager */
    public $em; 
 
    public function __construct(
      $name, 
      EngineInterface $templating, 
      Pool $pool, 
      EntityManager $em, 
      TokenStorage $securityContext) { 
        parent::__construct($name, $templating); 
        $this->pool = $pool;
        $this->em = $em;
        $this->securityContext = $securityContext;
    } 
 
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $user_current   = $this->securityContext->getToken()->getUser();
        $user_id        = $user_current->getId();

        // Requêtes pour afficher les différentes statistiques
        $em = $this->em;
        $s_query = $em->createQuery('SELECT COUNT(u.id) FROM App\Entity\User u');
        $s_count_user = $s_query->getSingleScalarResult();
        
        $s_query = $em->createQuery('SELECT COUNT(b.id) FROM App\Entity\Book b');
        $s_count_book = $s_query->getSingleScalarResult();
        
        $s_query = $em->createQuery('SELECT COUNT(s.id) FROM App\Entity\Share s');
        $s_count_share = $s_query->getSingleScalarResult();

//        $s_query = $em->createQuery('SELECT COUNT(c.id) FROM App\Entity\Contact c JOIN App\Entity\Contact c');
//        $s_count_contact = $s_query->getSingleScalarResult();
 
        return $this->renderResponse('Block/stats.html.twig', array(
            'block'          => $blockContext->getBlock(),
            'base_template'  => $this->pool->getTemplate('layout'),         
            'settings'       => $blockContext->getSettings(),
            'count_user'     => $s_count_user,
            'count_book'    => $s_count_book,
            'count_share' => $s_count_share,
            //'count_contact'  => $s_count_contact,
        ), $response);
    }
}