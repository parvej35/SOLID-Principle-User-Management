<?php

/**
 * Class UserController
 * Handles HTTP requests for user operations.
 */

//The controller is responsible only for handling HTTP requests related to user (Single Responsibility Principle).
//This controller interacts with the UserServiceInterface, ensuring it only depends on the necessary methods (Interface Segregation Principle).

//The controller depends on the service interface, and the service depends on the repository interface, allowing for flexible and interchangeable components (Dependency Inversion Principle).

class UserController {

    private UserServiceInterface $userService;

    /**
     * UserController constructor.
     * @param UserServiceInterface $userService The user service instance.
     */
    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;
    }

    /**
     * Handles the creation of a user.
     */
    public function create(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $this->userService->createUser($name, $email);
            header('Location: /index.php');
            exit();
        }
    }

    /**
     * Handles the update of a user.
     */
    public function update(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $this->userService->updateUser($id, $name, $email);
            header('Location: /index.php');
            exit();
        }
    }

    /**
     * Handles the deletion of a user.
     */
    public function delete(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $this->userService->deleteUser($id);
            header('Location: /index.php');
            exit();
        }
    }

    /**
     * Gets a list of all users.
     * @return array An array of User objects.
     */
    public function list(): array {
        return $this->userService->getAllUsers();
    }

    /**
     * Gets a user by ID.
     * @param string $userId The ID of the user to get.
     * @return User|null The found user, or null if not found.
     */
    public function getUser(string $userId): ?User {
        return $this->userService->getUser($userId);
    }
}
?>
