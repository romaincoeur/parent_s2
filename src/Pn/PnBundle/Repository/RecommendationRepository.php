<?php

namespace Pn\PnBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RecommendationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RecommendationRepository extends EntityRepository
{

    public function getRecommandations($user)
    {
        $qb = $this->createQueryBuilder('r')
            ->where('r.receiver LIKE :user')
            ->setParameter('user', $user)
            ->orderBy('b.created_at', 'DESC');

        $query = $qb->getQuery();

        return $query->getResult();
    }

}
