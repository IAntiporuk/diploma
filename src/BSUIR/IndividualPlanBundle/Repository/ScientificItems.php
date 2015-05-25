<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * ScientificItems
 */
class ScientificItems extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\ScientificItems
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('si')
            ->from($this->getClassName(), 'si')
            ->innerJoin('si.scientificWork', 'sw')
            ->innerJoin('sw.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('si.id = :si_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'si_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
