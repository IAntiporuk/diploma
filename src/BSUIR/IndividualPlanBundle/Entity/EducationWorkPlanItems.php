<?php

namespace BSUIR\IndividualPlanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EducationWorkPlanItems
 */
class EducationWorkPlanItems
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $lectures;

    /**
     * @var integer
     */
    private $practicalLessons;

    /**
     * @var integer
     */
    private $labs;

    /**
     * @var integer
     */
    private $courseWork;

    /**
     * @var integer
     */
    private $sampleCalculation;

    /**
     * @var integer
     */
    private $calculationWork;

    /**
     * @var integer
     */
    private $individualPracticalWork;

    /**
     * @var integer
     */
    private $consultations;

    /**
     * @var integer
     */
    private $assessment;

    /**
     * @var integer
     */
    private $exams;

    /**
     * @var integer
     */
    private $reviews;

    /**
     * @var integer
     */
    private $controlIndependentWork;

    /**
     * @var integer
     */
    private $educationPractice;

    /**
     * @var integer
     */
    private $technologicalPractice;

    /**
     * @var integer
     */
    private $prediplomaPractice;

    /**
     * @var integer
     */
    private $diplomaDesign;

    /**
     * @var integer
     */
    private $gakConsultations;

    /**
     * @var integer
     */
    private $gakWorkCommission;

    /**
     * @var integer
     */
    private $gakProducingDepartment;

    /**
     * @var integer
     */
    private $gakExpert;

    /**
     * @var integer
     */
    private $controlHighStudents;

    /**
     * @var integer
     */
    private $checkHighStudents;

    /**
     * @var integer
     */
    private $controlGraduate;

    /**
     * @var integer
     */
    private $dropWeight;

    /**
     * @var string
     */
    private $note;

    /**
     * @var EducationWorkPlan
     */
    private $educationWorkPlan;

    /**
     * @var Groups
     */
    private $groups;

    /**
     * @var Disciplines
     */
    private $discipline;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    /**
     * @return array
     */
    static public function getFieldsForSum()
    {
        return array(
            'lectures' => 'Лекции',
            'practicalLessons' => 'Практические занятия',
            'labs' => 'Лабараторные',
            'courseWork' => 'Курсовые',
            'sampleCalculation' => 'Типовые рассчёты',
            'calculationWork' => 'Расчётные работы',
            'individualPracticalWork' => 'Индив.практ. работы',
            'consultations' => 'Консультации',
            'assessment' => 'Зачёты',
            'exams' => 'Экзамены',
            'reviews' => 'Рецензирование к.р.',
            'controlIndependentWork' => 'УСРС',
            'educationPractice' => 'Произв.практ. учебная',
            'technologicalPractice' => 'Произв.практ. технологическая',
            'prediplomaPractice' => 'Произв.практ. преддипломная',
            'diplomaDesign' => 'Дипломное проектирование (руков.)',
            'gakConsultations' => 'ГЭК консультант',
            'gakWorkCommission' => 'ГЭК раб.комиссия',
            'gakProducingDepartment' => 'ГЭК выпуск.кафедра',
            'gakExpert' => 'ГЭК специалист',
            'controlHighStudents' => 'Руков.студ.2 ступ.выс.обр.',
            'checkHighStudents' => 'Проверка реф.студ.2 ступ.выс.обр.',
            'controlGraduate' => 'Руков.аспирантами и т.д.',
            'dropWeight' => 'Снижение педнагрузки',
        );
    }

    /**
     * @return int
     */
    public function getSum()
    {
        $fields = self::getFieldsForSum();
        $result = 0;

        foreach ($fields as $field => $name) {
            $methodName = 'get' . ucfirst($field);
            $result += (int) $this->$methodName();
        }

        return $result;
    }

    /**
     * @return Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param Groups $groups
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    public function getGroupsString()
    {
        $result = '';
        /**
         * @var \BSUIR\IndividualPlanBundle\Entity\Groups $group
         */
        foreach ($this->groups as $group) {
            $result .= $group->getName() . ' ';
        }

        return $result;
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return EducationWorkPlanItems
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return EducationWorkPlanItems
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set lectures
     *
     * @param integer $lectures
     * @return EducationWorkPlanItems
     */
    public function setLectures($lectures)
    {
        $this->lectures = $lectures;

        return $this;
    }

    /**
     * Get lectures
     *
     * @return integer 
     */
    public function getLectures()
    {
        return $this->lectures;
    }

    /**
     * Set practicalLessons
     *
     * @param integer $practicalLessons
     * @return EducationWorkPlanItems
     */
    public function setPracticalLessons($practicalLessons)
    {
        $this->practicalLessons = $practicalLessons;

        return $this;
    }

    /**
     * Get practicalLessons
     *
     * @return integer 
     */
    public function getPracticalLessons()
    {
        return $this->practicalLessons;
    }

    /**
     * Set labs
     *
     * @param integer $labs
     * @return EducationWorkPlanItems
     */
    public function setLabs($labs)
    {
        $this->labs = $labs;

        return $this;
    }

    /**
     * Get labs
     *
     * @return integer 
     */
    public function getLabs()
    {
        return $this->labs;
    }

    /**
     * Set courseWork
     *
     * @param integer $courseWork
     * @return EducationWorkPlanItems
     */
    public function setCourseWork($courseWork)
    {
        $this->courseWork = $courseWork;

        return $this;
    }

    /**
     * Get courseWork
     *
     * @return integer 
     */
    public function getCourseWork()
    {
        return $this->courseWork;
    }

    /**
     * Set sampleCalculation
     *
     * @param integer $sampleCalculation
     * @return EducationWorkPlanItems
     */
    public function setSampleCalculation($sampleCalculation)
    {
        $this->sampleCalculation = $sampleCalculation;

        return $this;
    }

    /**
     * Get sampleCalculation
     *
     * @return integer 
     */
    public function getSampleCalculation()
    {
        return $this->sampleCalculation;
    }

    /**
     * Set calculationWork
     *
     * @param integer $calculationWork
     * @return EducationWorkPlanItems
     */
    public function setCalculationWork($calculationWork)
    {
        $this->calculationWork = $calculationWork;

        return $this;
    }

    /**
     * Get calculationWork
     *
     * @return integer 
     */
    public function getCalculationWork()
    {
        return $this->calculationWork;
    }

    /**
     * Set individualPracticalWork
     *
     * @param integer $individualPracticalWork
     * @return EducationWorkPlanItems
     */
    public function setIndividualPracticalWork($individualPracticalWork)
    {
        $this->individualPracticalWork = $individualPracticalWork;

        return $this;
    }

    /**
     * Get individualPracticalWork
     *
     * @return integer 
     */
    public function getIndividualPracticalWork()
    {
        return $this->individualPracticalWork;
    }

    /**
     * Set consultations
     *
     * @param integer $consultations
     * @return EducationWorkPlanItems
     */
    public function setConsultations($consultations)
    {
        $this->consultations = $consultations;

        return $this;
    }

    /**
     * Get consultations
     *
     * @return integer 
     */
    public function getConsultations()
    {
        return $this->consultations;
    }

    /**
     * Set assessment
     *
     * @param integer $assessment
     * @return EducationWorkPlanItems
     */
    public function setAssessment($assessment)
    {
        $this->assessment = $assessment;

        return $this;
    }

    /**
     * Get assessment
     *
     * @return integer 
     */
    public function getAssessment()
    {
        return $this->assessment;
    }

    /**
     * Set exams
     *
     * @param integer $exams
     * @return EducationWorkPlanItems
     */
    public function setExams($exams)
    {
        $this->exams = $exams;

        return $this;
    }

    /**
     * Get exams
     *
     * @return integer 
     */
    public function getExams()
    {
        return $this->exams;
    }

    /**
     * Set reviews
     *
     * @param integer $reviews
     * @return EducationWorkPlanItems
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * Get reviews
     *
     * @return integer 
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Set controlIndependentWork
     *
     * @param integer $controlIndependentWork
     * @return EducationWorkPlanItems
     */
    public function setControlIndependentWork($controlIndependentWork)
    {
        $this->controlIndependentWork = $controlIndependentWork;

        return $this;
    }

    /**
     * Get controlIndependentWork
     *
     * @return integer 
     */
    public function getControlIndependentWork()
    {
        return $this->controlIndependentWork;
    }

    /**
     * Set educationPractice
     *
     * @param integer $educationPractice
     * @return EducationWorkPlanItems
     */
    public function setEducationPractice($educationPractice)
    {
        $this->educationPractice = $educationPractice;

        return $this;
    }

    /**
     * Get educationPractice
     *
     * @return integer 
     */
    public function getEducationPractice()
    {
        return $this->educationPractice;
    }

    /**
     * Set technologicalPractice
     *
     * @param integer $technologicalPractice
     * @return EducationWorkPlanItems
     */
    public function setTechnologicalPractice($technologicalPractice)
    {
        $this->technologicalPractice = $technologicalPractice;

        return $this;
    }

    /**
     * Get technologicalPractice
     *
     * @return integer 
     */
    public function getTechnologicalPractice()
    {
        return $this->technologicalPractice;
    }

    /**
     * Set prediplomaPractice
     *
     * @param integer $prediplomaPractice
     * @return EducationWorkPlanItems
     */
    public function setPrediplomaPractice($prediplomaPractice)
    {
        $this->prediplomaPractice = $prediplomaPractice;

        return $this;
    }

    /**
     * Get prediplomaPractice
     *
     * @return integer 
     */
    public function getPrediplomaPractice()
    {
        return $this->prediplomaPractice;
    }

    /**
     * Set diplomaDesign
     *
     * @param integer $diplomaDesign
     * @return EducationWorkPlanItems
     */
    public function setDiplomaDesign($diplomaDesign)
    {
        $this->diplomaDesign = $diplomaDesign;

        return $this;
    }

    /**
     * Get diplomaDesign
     *
     * @return integer 
     */
    public function getDiplomaDesign()
    {
        return $this->diplomaDesign;
    }

    /**
     * Set gakConsultations
     *
     * @param integer $gakConsultations
     * @return EducationWorkPlanItems
     */
    public function setGakConsultations($gakConsultations)
    {
        $this->gakConsultations = $gakConsultations;

        return $this;
    }

    /**
     * Get gakConsultations
     *
     * @return integer 
     */
    public function getGakConsultations()
    {
        return $this->gakConsultations;
    }

    /**
     * Set gakWorkCommission
     *
     * @param integer $gakWorkCommission
     * @return EducationWorkPlanItems
     */
    public function setGakWorkCommission($gakWorkCommission)
    {
        $this->gakWorkCommission = $gakWorkCommission;

        return $this;
    }

    /**
     * Get gakWorkCommission
     *
     * @return integer 
     */
    public function getGakWorkCommission()
    {
        return $this->gakWorkCommission;
    }

    /**
     * Set gakProducingDepartment
     *
     * @param integer $gakProducingDepartment
     * @return EducationWorkPlanItems
     */
    public function setGakProducingDepartment($gakProducingDepartment)
    {
        $this->gakProducingDepartment = $gakProducingDepartment;

        return $this;
    }

    /**
     * Get gakProducingDepartment
     *
     * @return integer 
     */
    public function getGakProducingDepartment()
    {
        return $this->gakProducingDepartment;
    }

    /**
     * Set gakExpert
     *
     * @param integer $gakExpert
     * @return EducationWorkPlanItems
     */
    public function setGakExpert($gakExpert)
    {
        $this->gakExpert = $gakExpert;

        return $this;
    }

    /**
     * Get gakExpert
     *
     * @return integer 
     */
    public function getGakExpert()
    {
        return $this->gakExpert;
    }

    /**
     * Set controlHighStudents
     *
     * @param integer $controlHighStudents
     * @return EducationWorkPlanItems
     */
    public function setControlHighStudents($controlHighStudents)
    {
        $this->controlHighStudents = $controlHighStudents;

        return $this;
    }

    /**
     * Get controlHighStudents
     *
     * @return integer 
     */
    public function getControlHighStudents()
    {
        return $this->controlHighStudents;
    }

    /**
     * Set checkHighStudents
     *
     * @param integer $checkHighStudents
     * @return EducationWorkPlanItems
     */
    public function setCheckHighStudents($checkHighStudents)
    {
        $this->checkHighStudents = $checkHighStudents;

        return $this;
    }

    /**
     * Get checkHighStudents
     *
     * @return integer 
     */
    public function getCheckHighStudents()
    {
        return $this->checkHighStudents;
    }

    /**
     * Set controlGraduate
     *
     * @param integer $controlGraduate
     * @return EducationWorkPlanItems
     */
    public function setControlGraduate($controlGraduate)
    {
        $this->controlGraduate = $controlGraduate;

        return $this;
    }

    /**
     * Get controlGraduate
     *
     * @return integer 
     */
    public function getControlGraduate()
    {
        return $this->controlGraduate;
    }

    /**
     * Set dropWeight
     *
     * @param integer $dropWeight
     * @return EducationWorkPlanItems
     */
    public function setDropWeight($dropWeight)
    {
        $this->dropWeight = $dropWeight;

        return $this;
    }

    /**
     * Get dropWeight
     *
     * @return integer 
     */
    public function getDropWeight()
    {
        return $this->dropWeight;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return EducationWorkPlanItems
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return EducationWorkPlan
     */
    public function getEducationWorkPlan()
    {
        return $this->educationWorkPlan;
    }

    /**
     * @param EducationWorkPlan $educationWorkPlan
     */
    public function setEducationWorkPlan($educationWorkPlan)
    {
        $this->educationWorkPlan = $educationWorkPlan;
    }

    /**
     * LifecycleCallbacks
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * lifecycleCallbacks
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return Disciplines
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param Disciplines $discipline
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;
    }
}
