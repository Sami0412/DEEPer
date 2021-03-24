<?php

use App\Hydrator\UserHydrator;

require_once '../src/setup.php';

$registered = false;

if (isset($_POST['username'], $_POST['dob'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'])) {
    $dob = $_POST['dob'];
    if (time() < strtotime('+18 years', strtotime($dob))) {
        $message = "You must be over 18 to use this site.";
        exit;
    } else {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            $formUser = [
                'username' => strip_tags($_POST['username']),
                'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];

            $hydrator = new UserHydrator();
            $formUser = $hydrator->hydrateUser($formUser);

            $user = $dbProvider->createUser($formUser);
            $registered = true;

        } else {
            $message = "Your email or password did not match. Please try again";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php' ?>
    <link rel="stylesheet" href="beerlist.css">
    <title>Join Us!</title>
</head>
<body>
<div class="container">
    <img class="banner" src="../uploads/Beer_banner.jpeg">
    <?php include 'template_parts/navigation.php'?>
    <h1>Register</h1>
    <?php if ($registered): ?>
    <div class="alert alert-success">You have successfully registered. Please <a href="login.php" title="log in">log in</a></div>
    <?php endif; ?>
    <div class="card p-4">
        <form method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="username" id="name">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob">
                <small class="form-text text-muted">You must be over 18 to join our site</small>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>




<?php include 'template_parts/footer_includes.php'?>
</body>
</html>

