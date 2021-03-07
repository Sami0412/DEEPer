<?php

require_once '../src/setup.php';

if (isset($_POST['name'], $_POST['dob'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'])) {
    if ($_POST['password'] === $_POST['confirmPassword']) {
        $formUser = new User();
        //hydration
        //password hashing
    }
    //handle passwords don;t match
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php' ?>
    <link rel="stylesheet" href="../src/beerlist.css">
    <title>Join Us!</title>
</head>
<body>
<div class="container">
    <img class="banner" src="../uploads/Beer_banner.jpeg">
    <?php include 'template_parts/navigation.php'?>
    <h1>Register</h1>
    <div class="card p-4">
        <form method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name">
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

