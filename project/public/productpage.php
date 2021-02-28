<?php
require_once '../src/index.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../src/index.css">
    <title>Craft Beer Ratings</title>
</head>
<body class="container p-2">
<section id="intro" class="border p-2">
    <div id="intro-row" class="row">
        <div id="images" class="col-12 col-lg-6">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../<?= $product->image_path ?>" alt="A Beer">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="../<?= $product->image_path ?>" alt="A Beer">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 mh-75" src="../<?= $product->image_path ?>" alt="A beer">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <article class="col-lg-6">
            <h1><?= $product->title ?></h1>
            <p><?= $product->description ?></p>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#checkinModal">Check In</button>
                </div>
                <div id="success" class="justify-content-center mr-5 mb-n4 mt-n2"></div>
            </div>
            <div class="modal fade" id="checkinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Check In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" id="myForm">
                                <div class="form-group">
                                    <label for="userName">Name:</label>
                                    <input type="text" name="userName" id="userName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="rating">Rating:</label>
                                    <input type="number" max="5" name="rating" id="rating" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="review">Review:</label>
                                    <textarea name="review" id="review" class="form-control"></textarea>
                                </div>
                                <div class="g-recaptcha" data-sitekey="6LfWvWEaAAAAAAJGEAI9jrH15qSOyzBFBwOewuGo"></div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<h2>Additional Information</h2>

<section id="additional-info" class="border p-4">
    <hr>
    <div class="row">
        <div class="col-6">
            <b>Average Rating</b>
        </div>
        <div class="star-rating">
            <div style="width:<?= $product->avg_rating * 20; ?>%;"></div>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <b>Another Statistic</b>
        </div>
        <div class="col-6">78/100</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <b>Yet Another Statistic</b></div>
        <div class="col-6">Something</div>
    </div>
</section>

<h2>Recent Checkins</h2>

<section id="checkins">
    <?php foreach ($product->getCheckIns() as $checkIn): ?>
        <div class="container border p-4 mb-4">
            <div class="row">
                <h3 class="col-2"><?= $checkIn->user_name ?></h3>
                <div class="star-rating"><div style="width:<?= $checkIn->rating * 20; ?>%;"></div></div>
            </div>
            <p><?= $checkIn->review ?></p>
            <p><?= $checkIn->submitted ?></p>
        </div>
        <?php endforeach; ?>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
<script src="../src/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>