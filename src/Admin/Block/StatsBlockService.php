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
        
        $s_query = $em->createQuery('SELECT COUNT(l.id) FROM App\Entity\Livre l');
        $s_count_livre = $s_query->getSingleScalarResult();
        
        $s_query = $em->createQuery('SELECT COUNT(rep.id) FROM App\Entity\RelationEmprunteurPreteur rep');
        $s_count_relation = $s_query->getSingleScalarResult();

//        $s_query = $em->createQuery('SELECT COUNT(c.id) FROM App\Entity\Contact c JOIN App\Entity\Contact c');
//        $s_count_contact = $s_query->getSingleScalarResult();
 
        return $this->renderResponse('Block/stats.html.twig', array(
            'block'          => $blockContext->getBlock(),
            'base_template'  => $this->pool->getTemplate('layout'),         
            'settings'       => $blockContext->getSettings(),
            'count_user'     => $s_count_user,
            'count_livre'    => $s_count_livre,
            'count_relation' => $s_count_relation,
            //'count_contact'  => $s_count_contact,
        ), $response);
    }
}