

namespace NotificationBundle\Repository;

use App\Entity\User;

/**
 * notificationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class notificationRepository extends \Doctrine\ORM\EntityRepository
{


    public function findread()
    {
        /* $qb=$this->getEntityManager()->createQueryBuilder()
             ->select('c')
             ->from($this->_entityName,'c');
         $query=$qb->getQuery();*/
        $query = $this->getEntityManager()
            ->createQuery("select n.title from NotificationBundle:notification n where n.readn = 0");
        return $results = $query->getResult();
    }

}
