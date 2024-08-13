<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasher $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname("Admin");
        $user->setLastname("Manager");
        $user->setUsername("admin_user");
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setCreatedAt(new \DateTimeImmutable());
        $user->setEmail("admin@testuser.com");
        $password = $this->hasher->hashPassword($user, "secret123");
        $user->setPassword($password);
        $manager->persist($user);

        $manager->flush();
    }
}
