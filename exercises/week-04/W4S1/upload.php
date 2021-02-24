<?php

if (!empty($_POST)) {
    var_dump($_POST);
}

if (!empty($_FILES)) {
    var_dump($_FILES);

    if (!empty($_FILES['profilePicture'])) {
        $file = $_FILES['profilePicture'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            //handle error
        }

        //Validate MIME type & size (how big a file you want)
        //Unique - overwrite existing?
        //filename safe? specify file type
        //Generate new file name (original name in DB)

        $targetPath = 'uploads/' . time() . '_' . $file['name'];
        if (!move_uploaded_file(
            $file['tmp_name'],
            $targetPath
        )) {
            throw new RuntimeException("Failed to move the file");
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="profile-pic">Profile Picture</label>
        <input type="file" name="profilePicture" id="profile-pic" class="form-control-file">
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>
</body>
</html>
