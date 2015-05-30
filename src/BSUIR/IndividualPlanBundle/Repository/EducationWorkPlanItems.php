<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * EducationWorkPlanItems
 */
class EducationWorkPlanItems extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\EducationWorkPlanItems
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('ewpi')
            ->from($this->getClassName(), 'ewpi')
            ->innerJoin('ewpi.educationWorkPlan', 'ewp')
            ->innerJoin('ewp.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('ewpi.id = :ewpi_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'ewpi_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
