<?php
declare(strict_types=1);

namespace App\Model\User;

class UserService
{
    /**
     * @var UsersRepository
     */
    private UsersRepository $repository;

    /**
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository) {
        $this->repository = $usersRepository;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User {
        return $this->repository->findBy(['id' => $id])->fetch();
    }
}