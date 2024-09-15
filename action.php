<?php

require_once __DIR__ . '/src/Repository/UserRepository.php';
require_once __DIR__ . '/src/Service/UserService.php';
require_once __DIR__ . '/src/Controller/UserController.php';

$userRepository = new UserRepository();
$userService = new UserService($userRepository);
$userController = new UserController($userService);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $userController->create();
            break;
        case 'update':
            $userController->update();
            break;
        case 'delete':
            $userController->delete();
            break;
        default:
            $userController->list();
            break;
    }
}