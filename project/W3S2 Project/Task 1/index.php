<?php

class CheckIn {
    public $name;
    public $rating;
    public $review;
    public $timestamp;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <title>Beers!</title>
</head>
<body class="container p-2">
<section id="intro" class="container border p-2">
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
                        <img class="d-block w-100" src=https://www.sciencenews.org/wp-content/uploads/2020/05/050620_mt_beer_feat-1028x579.jpg" alt="One Beer">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://static.euronews.com/articles/stories/04/60/38/82/773x435_cmsv2_becaff49-2b06-5659-9cd3-a6eeefadcde4-4603882.jpg" alt="Two Beers">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 mh-75" src="https://2rdnmg1qbg403gumla1v9i2h-wpengine.netdna-ssl.com/wp-content/uploads/sites/3/2015/08/beerAllergy-1165339040-770x553-1-650x428.jpg" alt="Four Beers">
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
            <h1>Lorem Ipsum</h1>
            <p>Imperial wheat beer glass dry hopping. hydrometer heat exchanger; bacterial hydrometer dextrin dry hopping pitching original gravity imperial sour/acidic! barleywine copper pitching infusion pitching cask conditioned ale. becher, copper pitching yeast brewhouse ale, aroma hops abv. hefe becher mead, specific gravity, berliner weisse hard cider finishing hops? mead tulip glass, brewpub bacterial fermentation? hand pump brew mash: shelf life; primary fermentation brewhouse. top-fermenting yeast length bottom fermenting yeast??? barrel hefe alcohol lambic mash tun.</p>
            <button type="button" class="btn btn-primary">Check In</button>
        </article>
    </div>
</section>

<span class="container">
    <h2>Additional Information</h2>
</span>

<section id="additional-info" class="container border p-4">
    <hr>
    <div class="row">
        <div class="col-6">
            <b>Average Rating</b>
        </div>
        <div class="col-6">
            <img src="stars.png" alt="Star Rating">
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

<span class="container">
    <h2>Recent Checkins</h2>
</span>

<section id="checkins" class="container"></section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>
</html>