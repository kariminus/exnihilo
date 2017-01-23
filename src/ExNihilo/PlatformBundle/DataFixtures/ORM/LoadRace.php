<?php

namespace ExNihilo\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ExNihilo\PlatformBundle\Entity\Race;

class LoadRace implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $names = array('Humain', 'Nain', 'Elfe de la nuit', 'Gnome', 'Draeneï', 'Worgen', 'Pandaren', 'Orc', 'Mort-vivant', 'Tauren', 'Troll', 'Gobelin', 'Elfe de sang');
        foreach ($names as $name) {
            $race = new Race();
            $race->setName($name);
            $manager->persist($race);
        }
        $manager->flush();
    }
}