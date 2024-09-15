<?php

require_once __DIR__ . '/src/Repository/UserRepository.php';
require_once __DIR__ . '/src/Service/UserService.php';
require_once __DIR__ . '/src/Controller/UserController.php';

$userRepository = new UserRepository();
$userService = new UserService($userRepository);
$userController = new UserController($userService);

$userId = $_GET['id'] ?? '';
$user = $userController->getUser($userId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Update User</h2>
    <?php if ($user): ?>
        <form action="action.php?action=update" method="POST">
            <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user->getName()); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user->getEmail()); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-warning" onclick="window.location.href='/'">Cancel</button>
        </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
