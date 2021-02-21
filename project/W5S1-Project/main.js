//Ensure JS runs only after page load
window.addEventListener("DOMContentLoaded", function() {

    //Add submit event listener to form
    $("#myForm").on("submit", function (e) {
        //stops auto page reload on submission
        e.preventDefault();
        //Checkin function runs on submission
        checkIn();
        //Closes modal on submission
        $("#checkinModal").modal("hide");
        //Clears form on submission
        $('#checkinModal').on('hidden.bs.modal', function () {
            $(this).find('#myForm').trigger('reset');
        })
    });

    //Runs on submission
    function checkIn() {
        // Force Ajax header
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

        //Save values from input fields into variables
        var name = $("#userName").val();
        var rating = $("#rating").val();
        var review = $("#review").val();

        //Create new FormData object containing retrieved values
        var checkinData = new FormData();
        checkinData.append("userName", name);   //Creates key:value pairs
        checkinData.append("rating", rating);   //e.g. userName: 'Sami'
        checkinData.append("review", review);

        //Send POST request to index.php containing the hydrated FormData object
        axios.post("index.php", checkinData)
            //response data contains checkin data
            .then(function (response) {
                //Reveal success message on submission
                $("#success").html(response.data);
                console.log(response.data);
                //Don't need to print out review yet as this will be done in following GET request
                //$("#checkins").html(response.data);
            })
            .catch(function (error) {
                console.log(error);
        })

    }
});