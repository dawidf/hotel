<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 27.07.15
 * Time: 14:36
 */

namespace Hotel\AdminBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hotel\AdminBundle\Entity\News;

class NewsFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $newsList = array();
        for($i=0; $i < 20; $i++)
        {
            $newsList[$i]['title'] = 'Title '.$i;
            $newsList[$i]['description'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin imperdiet viverra nunc nec venenatis. Phasellus vitae lorem purus. Etiam malesuada sagittis purus sit amet commodo. Quisque iaculis eget erat id tincidunt. Nam ut euismod dui. Sed bibendum fermentum sem, egestas sagittis nulla viverra quis. Duis et tempus mi. Sed quis elementum mauris, sit amet congue nulla. Etiam venenatis blandit sem, eget blandit nisi suscipit ut. Sed suscipit tincidunt augue non pellentesque. Vivamus bibendum lobortis mattis. Integer ornare eros vitae ipsum sodales molestie.';
            $newsList[$i]['author'] = 'admin1@admin.pl';
        }


        foreach($newsList as $id => $news)
        {
            $News = new News();
            $News->setAuthor($this->getReference('client_'.$newsList[$id]['author']));
            $News->setTitle($newsList[$id]['title']);
            $News->setDescription($newsList[$id]['description']);

            $manager->persist($News);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}