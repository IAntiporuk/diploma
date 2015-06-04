<?php

namespace BSUIR\IndividualPlanBundle\Repository;

use BSUIR\IndividualPlanBundle\Entity\EducationWorkPlan;
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

    /**
     * @param $fieldName
     * @param EducationWorkPlan $ewp
     * @param bool $forYear
     * @return mixed
     */
    public function findSumByField($fieldName, EducationWorkPlan $ewp, $forYear = false)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('sum(ewpi.' . $fieldName . ')')
            ->from($this->getClassName(), 'ewpi')
            ->innerJoin('ewpi.educationWorkPlan', 'ewp');

        if ($forYear) {
            $qb->innerJoin('ewp.individualPlan', 'ip')
                ->where('ip.id = :ip_id')
                ->setParameter(':ip_id', $ewp->getIndividualPlan()->getId());
        } else {
            $qb->where('ewp.id = :ewp_id')
                ->setParameter('ewp_id', $ewp->getId());
        }


        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByMonth(EducationWorkPlan $ewp, $month)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('ewpi')
            ->from($this->getClassName(), 'ewpi')
            ->innerJoin('ewpi.educationWorkPlan', 'ewp')
            ->where('ewp.id = :ewp_id')
            ->andWhere('ewpi.months LIKE :month')
            ->setParameters(array(
                ':ewp_id' => $ewp->getId(),
                ':month' => '%' . $month . '_%',
            ));

        return $qb->getQuery()->getResult();
    }


}
