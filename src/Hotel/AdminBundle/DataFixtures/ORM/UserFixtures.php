<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 23.07.15
 * Time: 09:13
 */

namespace Hotel\AdminBundle\DataFixtures\ORM;



use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hotel\AdminBundle\Entity\User;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface
{

        /**
         * Load data fixtures with the passed EntityManager
         *
         * @param ObjectManager $manager
         */
        public function load(ObjectManager $manager)
    {
        $clients = array(
            array(
                'email' => 'admin1@admin.pl',
                'userName' => 'admin1',
                'password' => 'admin1',
                'name' => 'admin1Name',
                'surname' => 'adminSurname',
                'adress' => 'ul. adminowa 89',
                'postalCode' => '65-999',
                'city' => 'Kraków',
                'phoneNumber' => '+48956845215'
            ),
            array(
                'email' => 'admin2@admin.pl',
                'userName' => 'admin2',
                'password' => 'admin2',
                'name' => 'admin2Name',
                'surname' => 'admin2Surname',
                'adress' => 'ul. adminowa 89',
                'postalCode' => '65-999',
                'city' => 'Kraków',
                'phoneNumber' => '+48956845215'
            ),
            array(
                'email' => 'admin3@admin.pl',
                'userName' => 'admin3',
                'password' => 'admin3',
                'name' => 'admin3Name',
                'surname' => 'admin3Surname',
                'adress' => 'ul. adminowa 89',
                'postalCode' => '65-999',
                'city' => 'Kraków',
                'phoneNumber' => '+48956845215'
            ),
            array(
                'email' => 'admin4@admin.pl',
                'userName' => 'admin4',
                'password' => 'admin4',
                'name' => 'admin4Name',
                'surname' => 'adminSurname',
                'adress' => 'ul. adminowa 89',
                'postalCode' => '65-999',
                'city' => 'Kraków',
                'phoneNumber' => '+48956845215'
            ),
        );

        foreach ($clients as $key => $value) {
            $User = new User();
            $User->setEmail($value['email']);
            $User->setUsername($value['userName']);
            $User->setSurname($value['surname']);
            $User->setPlainPassword($value['password']);
            $User->setName($value['name']);
            $User->setAdress($value['adress']);
            $User->setPostalCode($value['postalCode']);
            $User->setCity($value['city']);
            $User->setPhoneNumber($value['phoneNumber']);
            $User->setEnabled(true);
            $User->setRoles(array(User::ROLE_SUPER_ADMIN, User::ROLE_DEFAULT));



            $manager->persist($User);
            $this->addReference('client_'.$value['email'], $User);
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
        return 0;
    }





}