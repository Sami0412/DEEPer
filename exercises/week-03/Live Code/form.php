<?php

if (!empty($_POST)) {
    //form submitted
    var_dump($_POST);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="search-term">Search Term:</label>
        <input type="text" name="searchTerm" id="search-term">

        <button type="submit">Search</button>
    </form>
</body>
</html>
