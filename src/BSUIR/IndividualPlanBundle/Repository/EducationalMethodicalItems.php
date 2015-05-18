<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\Professors;
use Doctrine\ORM\EntityRepository;

/**
 * EducationalMethodicalItems
 */
class EducationalMethodicalItems extends EntityRepository
{
    /**
     * @param $id
     * @param Professors $professors
     * @return \BSUIR\IndividualPlanBundle\Entity\EducationalMethodicalItems
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIdAndProfessor($id, Professors $professors)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('emi')
            ->from($this->getClassName(), 'emi')
            ->innerJoin('emi.educationalMethodicalWork', 'emw')
            ->innerJoin('emw.individualPlan','ip')
            ->innerJoin('ip.professor','p')
            ->where('emi.id = :emi_id')
            ->andWhere('p.id = :p_id')
            ->setParameters(array(
                'emi_id' => $id,
                'p_id' => $professors->getId(),
            ))
            ->getQuery()
            ->getOneOrNullResult();
    }
}
