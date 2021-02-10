window.addEventListener("DOMContentLoaded", function() {
    $("myForm").on("submit", function (e) {
        e.preventDefault();
        checkIn();
    });
});

function checkIn() {
    // Force Ajax header
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    var name = $("#userName").val();
    var rating = $("#rating").val();
    var review = $("#review").val();

    var checkinData = new FormData();
    checkinData.append("name", name);
    checkinData.append("rating", rating);
    checkinData.append("review", review);

    axios.post("index", checkinData)
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    })

}