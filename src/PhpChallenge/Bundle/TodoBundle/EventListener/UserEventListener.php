<?php
namespace PhpChallenge\Bundle\TodoBundle\EventListener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use PhpChallenge\Bundle\TodoBundle\Entity\TodoList;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserEventListener implements EventSubscriberInterface
{
    /** @var EntityManager  */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationCompleted'
        ];
    }

    public function onRegistrationCompleted(FilterUserResponseEvent $userEvent)
    {
        //when a new user registers create them a list
        $list = new TodoList();
        $list->setOwner($userEvent->getUser());

        $this->entityManager->persist($list);
        $this->entityManager->flush();

    }

}
