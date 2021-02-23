<?php

require_once 'setup.php';

use Carbon\Carbon;

class Photo
{
    public $name;
    public $dob;
    public $email;
    public $picture;
    public $submitted;
}

//Only runs on form submission
if (!empty($_POST)) {
    //Hydrate Photo class with form values
    $submission = new Photo();
    $submission->name = $_POST['name'];     //$_POST property names come from name values on html element
    $submission->dob = $_POST['DoB'];
    $submission->email = $_POST['email'];
    $submission->submitted = Carbon::now()->timestamp;
    }

//Runs if file submitted
if (!empty($_FILES)) {

    if (!empty($_FILES['photo'])) { //$_FILES is an array containing name, type, tmp_name, error and size
        //Save array to variable
        $file = $_FILES['photo'];

        //Error handling
        if ($file['error'] !== UPLOAD_ERR_OK) {
           //display error bootstrap alert
            $responseMsg = '<div class="alert alert-warning" role="alert">An error has occurred, please try again</div>';
        } else {
            //Create path name e.g. 'uploads/cat.jpg
            $targetPath = 'uploads/' . $file['name'];
            //Replace temporary file path with newly created path
            if (!move_uploaded_file(
                $file['tmp_name'],
                $targetPath
            )) {
                throw new RuntimeException('Failed to move file');
            }
            //Add new file path into photo class instance
            $submission->picture = $targetPath;
            //Serialise & store the hydrated class instance using timestamp as name
            $serialisedSubmission = serialize($submission);
            file_put_contents("$submission->submitted" . ".txt", $serialisedSubmission);

            //Show bootstrap success alert on submission
            $responseMsg = '<div class="alert alert-success" role="alert">Photo uploaded successfully!</div>';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="photosub.css">
    <title>Photo Submission</title>
</head>
<body class="container">
<h1 class="text-center">Photo Submission</h1>
<p class="text-center">Please complete all fields before submitting your photo</p>
<div class="row">
    <div class="col-12">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row centre-div">
                <div class="form-group col-12">
                    <label for="name">Full Name:</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="DoB">Date of Birth:</label>
                    <input type="date" name="DoB" id="DoB" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group col-12">
                    <label for="photo">Select photo to upload:</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
                <button type="submit" class="btn btn-info btn-lg ml-3">Submit</button>
                <?php if (isset($responseMsg)){
                    echo $responseMsg;
                }?>
            </div>
        </form>
    </div>

    <div class="col-12 mt-5 mb-5">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner">
                <!--Remove hidden dot files from directory before looping-->
                <?php
                $images = array_diff(scandir('uploads/', SCANDIR_SORT_NONE), array('..', '.'));
                //assign first element (first file in uploads) to variable as one needs to be 'active' in carousel
                $head = $images[0];
                echo "<div class='carousel-item active'>";
                echo "<img src='uploads/$head' class='d-block w-100'>";
                echo "</div>";
                //assign rest of array to another variable
                function getTail($i) {
                    return $i > 0;
                }
                //Iterate over each value in the array passing them to the callback function. If the callback function returns true, the current value from array is returned into the result array.
                $tail = array_filter($images, 'getTail', ARRAY_FILTER_USE_KEY);
                 foreach ($tail as $image) {
                    echo "<div class='carousel-item'>";
                    echo "<img src='uploads/$image' class='d-block w-100'>";
                    echo "</div>";
                } ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>