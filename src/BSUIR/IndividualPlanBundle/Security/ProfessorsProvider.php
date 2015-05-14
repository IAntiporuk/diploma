<?php

namespace BSUIR\IndividualPlanBundle\Security;

use Doctrine\ORM\EntityManager;
use BSUIR\IndividualPlanBundle\Entity\Professors;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfessorsProvider implements UserProviderInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritdoc
     */
    public function loadUserByUsername($email)
    {
        $user = $this->em->getRepository('BSUIRIndividualPlanBundle:Professors')->findOneByEmail($email);

        if ($user instanceof Professors) {
            return $user;
        } else {
            $message = sprintf(
                'Unable to find an active admin BSUIRIndividualPlanBundle:Professors object identified by "%s".',
                $email
            );
            throw new UsernameNotFoundException($message, 0);
        }

    }

    /**
     * @inheritdoc
     */
    public function refreshUser(UserInterface $user)
    {
        if ($user instanceof Professors) {
            return $this->loadUserByUsername($user->getEmail());
        } else {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

    }

    /**
     * @inheritdoc
     */
    public function supportsClass($class)
    {
        return $class === 'BSUIR\IndividualPlanBundle\Entity\Professors';
    }
}