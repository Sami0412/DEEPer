//not necessary as code won't run until form submission anyway
window.addEventListener("DOMContentLoaded", function() {
//Only want this to run on submission
    $("#myForm").on("submit", function (e) {
        //stops page reloading on submission
        e.preventDefault();
        //Calculator function only runs on form submission
        calculator();
    });
});

function calculator() {
    //get a, b & operation values using jQuery and assign to variables
    var a = $("#a").val();
    var b = $("#b").val();
    var op = $("#operation").children('option:selected').val();

    // Force Ajax header
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    //Create a new FormData Object to store PHP variables into
    var calcData = new FormData();
    calcData.append('a', a);
    calcData.append('b', b);
    calcData.append('op', op);

    //Use axios to populate FormData object with values from PHP
    axios.post("maths.php", calcData)
        .then(function(response) {
            //result will appear in console
            console.log(response.data);
            //result will appear as value of #result input box on page
            $("#result").val(response.data);
        })
        .catch(function(error) {
            console.log(error);
    })
}