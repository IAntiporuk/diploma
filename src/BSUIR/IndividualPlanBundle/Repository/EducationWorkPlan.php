<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * EducationWorkPlan
 */
class EducationWorkPlan extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\EducationWorkPlan
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('ewp')
            ->from($this->getClassName(), 'ewp')
            ->innerJoin('ewp.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('ewp.id = :ewp_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'ewp_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
