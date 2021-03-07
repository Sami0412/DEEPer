<?php
require_once '../src/index.php';
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php' ?>
    <link rel="stylesheet" href="../src/index.css">
    <title>Craft Beer Ratings</title>
</head>
<body class="container">
<img class="banner" src="../uploads/Beer_banner.jpeg">
<?php include 'template_parts/navigation.php'?>
<h1><?= $product->title ?></h1>
<section id="intro">
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
            <p id="description"><?= $product->description ?></p>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#checkinModal">Review</button>
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

<section id="additional-info">
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
            <b>ABV</b>
        </div>
        <div class="col-6"><?= $product->abv; ?>%</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <b>Beer Style</b></div>
        <div class="col-6"><?= $product->beerStyle; ?></div>
    </div>
    <hr>
    <div class="row mb-4">
        <div class="col-6">
            <b>Brewery</b></div>
        <div class="col-6"><?= $product->brewery; ?></div>
    </div>
</section>

<h2>Recent Reviews</h2>

<section id="checkins">
    <?php if (!count($product->getCheckIns())) : ?>
    <div class="p-4 mb-4">No reviews yet</div>
    <?php else: foreach ($product->getCheckIns() as $checkIn): ?>
        <div class="border border-warning p-4 my-4">
            <div class="row">
                <h3 class="col-2"><?= $checkIn->name ?></h3>
                <div class="star-rating"><div style="width:<?= $checkIn->rating * 20; ?>%;"></div></div>
            </div>
            <p><?= $checkIn->review ?></p>
            <p><?= $checkIn->posted ?></p>
        </div>
        <?php endforeach; endif; ?>
</section>

<?php include 'template_parts/footer_includes.php'?>
<script src="../src/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>