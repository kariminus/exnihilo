<?php

namespace ExNihilo\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ExNihilo\PlatformBundle\Entity\Classe;
use ExNihilo\PlatformBundle\Entity\Race;
use ExNihilo\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $classe = new Classe();
        $classe->setName("moine");

        $race = new Race();
        $race->setName("orc");

        $user1 = new User();
        $user1->setUsername("admin");
        $user1->setEmail("admin@gmail.com");
        $user1->setPassword("admin");
        $user1->setPlainPassword("admin");
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setClasse($classe);
        $user1->setRace($race);
        $user1->setGender(0);
        $user1->setIsGuildMember(0);


        $manager->persist($user1);
        $manager->flush();

    }
}