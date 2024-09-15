<?php

/**
 * The UserService handles business logic related to users.
 *
 * The UserService class is solely responsible for handling user-related business logic (Single Responsibility).
 * It depends on the UserRepositoryInterface abstraction (Dependency Inversion).
 */

require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Interface/UserRepositoryInterface.php';
require_once __DIR__ . '/../Interface/UserServiceInterface.php';

class UserService implements UserServiceInterface {

    private UserRepositoryInterface $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository The user repository instance.
     */
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Gets all users from the repository.
     * @return array An array of User objects.
     */
    public function getAllUsers(): array {

        $users = $this->userRepository->getAll();
        usort($users, function ($a, $b) {
//            return $a->getCreatedAt() <=> $b->getCreatedAt(); // ASC
             return $b->getCreatedAt() <=> $a->getCreatedAt(); // DESC
        });

        return $users;
    }

    /**
     * Creates a new user and saves it to the repository.
     * @param string $name The name of the user.
     * @param string $email The email of the user.
     * @return User The created user object.
     */
    public function createUser(string $name, string $email): User {
        $user = new User($name, $email);
        $user->setCreatedAt(new DateTime());
        $this->userRepository->save($user);
        return $user;
    }

    /**
     * Updates an existing user in the repository.
     * @param string $id The ID of the user to update.
     * @param string $name The new name of the user.
     * @param string $email The new email of the user.
     * @return User|null The updated user object, or null if not found.
     */
    public function updateUser(string $id, string $name, string $email): ?User {
        $user = $this->userRepository->getById($id);
        if ($user) {
            $user->setName($name);
            $user->setEmail($email);
            $user->setUpdatedAt(new DateTime());
            $this->userRepository->save($user);
            return $user;
        }
        return null;
    }

    /**
     * Deletes a user from the repository.
     * @param string $userId The ID of the user to delete.
     */
    public function deleteUser(string $userId): void {
        $this->userRepository->delete($userId);
    }

    /**
     * Gets a user by ID from the repository.
     * @param string $userId The ID of the user to get.
     * @return User|null The found user, or null if not found.
     */
    public function getUser(string $userId): ?User {
        return $this->userRepository->getById($userId);
    }
}
