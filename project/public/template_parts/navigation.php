
<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <a class="navbar-brand" href="product_list.php">Raise The Beer</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="product_list.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="add_product.php">Add Your Beer</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if (!empty($loggedInUser)): ?>
            <li class="nav-item">
                <div class="nav-link">Hello, <?= $loggedInUser->name ?></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">| Log Out</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="login.php">Log In</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
