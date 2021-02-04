//var starRating=`<span class="fa fa-star checked"></span>`;
//var stars=response.data[i].rating;

axios.get("http://localhost:8080/checkins")
.then(function (response) {
    console.log("response");
    if (response.data.length>0) {
        for (var i=0; i < response.data.length; i++) {
            var review = $("<div></div>").addClass("col-12 border p-3 mb-3");
            var name = $("<h6></h6>").text(response.data[i].name).appendTo(review);
            var starRating = $("<div></div>").addClass("star-rating");
            // var stars = $("<i></i>").addClass("fa fa-star checked");
            var stars = $("<img src='data:image/jpeg;base64,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'>")
            Array(response.data[i].rating)
                .fill(0)
                .forEach(s=>{
                    console.log(s);
                    starRating.append(stars)
                });
            //var rating = response.data[i].rating * 20;
            //$("<img src='data:image/png;base64,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' />").css("width", rating + "%").appendTo(starRating);
            starRating.appendTo(name);
            name.appendTo(review);
            // var starRating = $("<div></div>").addClass("star-rating");
            // var rating = response.data[i].rating;


            // for (var j=1; j <= rating; j++) {
            //     $(starRating).append(stars);
            // }
            // starRating.appendTo(name);
            var comment = $("<p></p>").text(response.data[i].review).appendTo(review);
            var datetime = $("<p></p>").text(response.data[i].dateTime).appendTo(review);
            $("#checkins").append(review);
        }
    }
})