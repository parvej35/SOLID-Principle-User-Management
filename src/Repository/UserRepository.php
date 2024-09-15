<?php

/**
 * Class UserRepository
 * Manages user data storage and retrieval using PHP sessions.
 */
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../Interface/UserRepositoryInterface.php';
require_once __DIR__ . '/../Interface/UserServiceInterface.php';

// Responsible for CRUD operations with the database.

// The user repository class is responsible for managing user data storage and retrieval. (Single Responsibility Principle)
// It uses PHP sessions to store user data.

//The repository can be extended (e.g., to use a different storage mechanism) without modifying existing code. (Open/Closed Principle)

class UserRepository implements UserRepositoryInterface {
    private const SESSION_KEY = 'users';

    /**
     * UserRepository constructor.
     * Initializes session storage if not already initialized.
     */
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = [];
        }
    }

    /**
     * Gets all users from session storage.
     * @return array An array of User objects.
     */
    public function getAll(): array {
        return $_SESSION[self::SESSION_KEY];
    }

    /**
     * Saves a user to session storage.
     * @param User $user The user to save.
     */
    public function save(User $user): void {
        $_SESSION[self::SESSION_KEY][$user->getId()] = $user;
    }

    /**
     * Deletes a user from session storage.
     * @param string $userId The ID of the user to delete.
     */
    public function delete(string $userId): void {
        unset($_SESSION[self::SESSION_KEY][$userId]);
    }

    /**
     * Finds a user by ID.
     * @param string $userId The ID of the user to find.
     * @return User|null The found user or null if not found.
     */
    public function getById(string $userId): ?User {
        return $_SESSION[self::SESSION_KEY][$userId] ?? null;
    }
}
