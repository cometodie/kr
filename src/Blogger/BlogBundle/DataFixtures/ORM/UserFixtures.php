<?php

namespace Blogger\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Blogger\BlogBundle\Entity\Role;
use Blogger\BlogBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class UserFixtures implements FixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // создание роли ROLE_ADMIN
        $role = new Role();
        $role->setName('ROLE_ADMIN');
        $role->setTitle('Администратор');

        $manager->persist($role);

        // создание роли ROLE_USER
        $role2 = new Role();
        $role2->setName('ROLE_USER');
        $role2->setTitle('Пользователь');

        $manager->persist($role2);

        // создание пользователя
        $user = new User();
        $user->setUsername("admin");
        $user->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('admin', $user->getSalt());
        $user->setPassword($password);

        $user->getUserRoles()->add($role);

        $manager->persist($user);


        $user2 = new User();
        $user2->setUsername("vasia");
        $user2->setSalt(md5(time()));

        // шифрует и устанавливает пароль для пользователя,
        // эти настройки совпадают с конфигурационными файлами
        $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
        $password = $encoder->encodePassword('vasia', $user2->getSalt());
        $user2->setPassword($password);

        $user2->getUserRoles()->add($role2);

        $manager->persist($user2);

        $manager->flush();
    }
}