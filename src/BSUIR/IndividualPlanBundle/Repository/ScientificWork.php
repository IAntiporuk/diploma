<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * ScientificWork
 */
class ScientificWork extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\ScientificWork
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {

        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('sw')
            ->from($this->getClassName(), 'sw')
            ->innerJoin('sw.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('sw.id = :sw_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'sw_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
