<?php

use Monolog\Logger;

require_once '../src/setup.php';

if (isset($_POST['email'], $_POST['password'])) {
    $user = $userDbProvider->getUserByEmail($_POST['email']);

    if ($user && password_verify($_POST['password'], $user->password)) {
        //session id stored on local browser
        $_SESSION['LoginId'] = $user->id;
        header('Location: product_list.php');
        exit();
    } else {
        $logger->alert('Incorrect log in details entered');
        $errorMessage = "Incorrect email and password combination, please try again";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<?php include 'template_parts/header_includes.php'; ?>
    <link rel="stylesheet" href="index.css">
    <title>Log In</title>
</head>
<body>
<div class="container">
    <img class="banner" src="../uploads/Beer_banner.jpeg">
    <?php include 'template_parts/navigation.php'; ?>
    <h1>Log In</h1>
    <?php if (isset($errorMessage)): ?>
    <div class="alert alert-warning"><?= $errorMessage; ?></div>
    <?php endif; ?>
    <form method="post" autocomplete="off">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $_POST['email'] ?? '' ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-warning btn-lg btn-block mt-4">Log In</button>
            </div>
        </div>
    </form>





</div>
<?php include 'template_parts/footer_includes.php'; ?>
</body>
</html>
