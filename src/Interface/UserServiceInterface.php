<?php
require_once __DIR__ . '/../Model/User.php';

// The user service interface defines the contract for user management. (Interface Segregation Principle)

interface UserServiceInterface {
    public function getAllUsers(): array;
    public function getUser(string $userId): ?User;
    public function createUser(string $name, string $email): User;
    public function updateUser(string $id, string $name, string $email): ?User;
    public function deleteUser(string $userId): void;
}
