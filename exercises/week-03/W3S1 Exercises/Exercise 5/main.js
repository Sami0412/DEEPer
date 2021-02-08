//Only want this to run on submission
$("#myForm").on("submit", function(e) {
    e.preventDefault();
    //get a, b & operation values using jQuery and assign to variables
    var a = $("#a").val();
    var b = $("#b").val();
    var op = $("#operation").val();

   //Place data into object to use with axios
    var data = {
        a: a,
        b: b,
        op: op
    }

    //console.log(data);

    axios.post("maths.php", data)
        .then(function(response) {
            $("#result").val(response.data);
        })
        .catch(function(error) {
            console.log(error);
    })
})