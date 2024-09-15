<?php
require_once __DIR__ . '/src/Model/User.php';
require_once __DIR__ . '/src/Repository/UserRepository.php';
require_once __DIR__ . '/src/Service/UserService.php';
require_once __DIR__ . '/src/Controller/UserController.php';

$userRepository = new UserRepository();
$userService = new UserService($userRepository);
$userController = new UserController($userService);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
<!--    <link rel="stylesheet" href="css/styles.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">User List</h1>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Created On</th>
            <th>Updated On</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userController->list() as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user->getName()); ?></td>
                <td><?= htmlspecialchars($user->getEmail()); ?></td>
                <td><?= $user->getCreatedAt()->format('d-m-Y H:i:s'); ?></td>
                <td><?php
                    if (($user->getUpdatedAt() != null) || ($user->getUpdatedAt() != '')) {
                        echo $user->getUpdatedAt()->format('d-m-Y H:i:s');
                    } ?>
                </td>
                <td>
                    <form action="action.php?action=delete" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="update.php?id=<?php echo $user->getId(); ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="create.php" class="btn btn-primary">Add User</a>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!--<script src="js/scripts.js"></script>-->
</body>
</html>
