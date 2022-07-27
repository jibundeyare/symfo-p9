<?php

namespace App\DataFixtures;

use App\Entity\Editor;
use App\Entity\User;
use App\Entity\Writer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Writer
        $user = new User();
        $user->setEmail('writer@example.com');
        $user->setRoles(['ROLE_WRITER']);
        $password = $this->hasher->hashPassword($user, '123');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();

        $writer = new Writer();
        $writer->setUser($user);

        $manager->persist($writer);
        $manager->flush();

        // Editor
        $user = new User();
        $user->setEmail('editor@example.com');
        $user->setRoles(['ROLE_EDITOR']);
        $password = $this->hasher->hashPassword($user, '123');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();

        $editor = new Editor();
        $editor->setUser($user);

        $manager->persist($editor);
        $manager->flush();
    }
}
