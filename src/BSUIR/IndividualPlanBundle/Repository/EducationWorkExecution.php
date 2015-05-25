<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * EducationWorkExecution
 */
class EducationWorkExecution extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\EducationWorkExecution
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('ewe')
            ->from($this->getClassName(), 'ewe')
            ->innerJoin('ewe.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('ewe.id = :ewe_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'ewe_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
