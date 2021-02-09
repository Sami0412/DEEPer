window.addEventListener("DOMContentLoaded", function() {
    $("myForm").on("submit", function (e) {
        e.preventDefault();
        checkIn();
    });
});

function checkIn() {
    // Force Ajax header
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    var name = $("name").val(); //do for each
    var data = new FormData();
    data.append() //append above variables to formdata
}