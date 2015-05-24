<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * ScientificItems
 */
class OtherItems extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\OtherItems
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('oi')
            ->from($this->getClassName(), 'oi')
            ->innerJoin('oi.otherWork', 'ow')
            ->innerJoin('ow.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('oi.id = :oi_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'oi_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
