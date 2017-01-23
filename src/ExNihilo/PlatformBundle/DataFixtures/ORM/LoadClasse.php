<?php

namespace ExNihilo\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ExNihilo\PlatformBundle\Entity\Classe;

class LoadSkill implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $names = array('Chevalier de la mort', 'Chasseur de démons', 'Druide', 'Chasseur', 'Mage', 'Moine', 'Paladin', 'Prêtre', 'Voleur', 'Chaman', 'Guerrier', 'Démoniste');
        foreach ($names as $name) {
            $classe = new Classe();
            $classe->setName($name);
            $manager->persist($classe);
        }
        $manager->flush();
    }
}