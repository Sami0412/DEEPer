axios.get("http://localhost:8080/checkins")
.then(function (response) {
    console.log("response");

    if (response.data.length>0) {
        //$("#rating").text(response.data[0].rating);
        for (var i=0; i < response.data.length; i++) {
            var review = $("<div></div>").addClass("col-12 border p-3 mb-3");
            var name = $("<h6></h6>").text(response.data[i].name).appendTo(review);
            var rating = $("<span></span>").text(response.data[i].rating).appendTo(review);
            var comment = $("<p></p>").text(response.data[i].review).appendTo(review);
            var datetime = $("<p></p>").text(response.data[i].dateTime).appendTo(review);
            $("#checkins").append(review);
        }
    }
})