axios.get("http://localhost:8080/checkins")
.then(function (response) {
    console.log(response.data);

    if (response.data.length === 0) {
        $('<div>').text("No checkins available").appendTo("#checkins");
        return;
    }
    //loop for each response
    //create DOM object
    //build up each data item into DOM object
    //append DOM object to #checkins
    for (var i=0; i < response.data.length; i++) {
        var checkinEl = $("<div>").addClass("col-12 border p-3 mb-3");      //container
        var h3 = $("<h3>").text(response.data[i].name).appendTo(checkinEl); //Heading containing reviewer name, positioned within container
        var starRating = $("<div>").addClass("star-rating");                 //container for star rating
        var checkinRating = response.data[i].rating * 20;                   //rating/5, multiplied by 20 to make percentage
        $("<div>").css("width", checkinRating + "%").appendTo(starRating);   //custom div to display within starRating container
        starRating.appendTo(h3);                                            //append star rating to reviewer name - appears alongside
        $("<p>").text(response.data[i].review).appendTo(checkinEl);         //create p for review info, place within outer container under heading and star rating
        $("#checkins").append(checkinEl);
    }
})
.catch(function (error) {
    console.log(error);
});






