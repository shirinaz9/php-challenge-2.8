<?php

namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\TodoBundle\Entity\todo;

class LoadEvents implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $wayne = $manager->getRepository('UserBundle:User')
            ->findOneByUsernameOrEmail('shirin');

        $task = new Task();
        $task->setTask('yy!');
        $task->setDescription('!!!');
        $task->setCompleate('');
        $task->setTime(new \DateTime('today'));
        
        $manager->persist($task);

      

        // the queries aren't done until now
        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}
