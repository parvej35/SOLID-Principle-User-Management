<?php

require_once __DIR__ . '/../Model/User.php';

// The user repository interface defines the contract for user data storage. (Interface Segregation Principle)

interface UserRepositoryInterface {
    public function getAll(): array;
    public function save(User $user): void;
    public function delete(string $userId): void;
    public function getById(string $userId): ?User;
}
