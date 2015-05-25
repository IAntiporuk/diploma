<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * OtherWork
 */
class OtherWork extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\OtherWork
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {

        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('ow')
            ->from($this->getClassName(), 'ow')
            ->innerJoin('ow.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('ow.id = :ow_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'ow_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
