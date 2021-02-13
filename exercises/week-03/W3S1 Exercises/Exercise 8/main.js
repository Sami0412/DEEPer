window.addEventListener("DOMContentLoaded", function (e) {

    //This GET request runs on page load to populate table with previous calculations
    axios.get("maths.php")
        .then(function(response) {
            //console.log(response.data);
            $("#table").html(response.data);        //#table from HTML div
            //Use jQuery to target table row and add a click event
            $("#table tr").click(function (e) {
                //this == table tr. Look for child elements of this and apply a function to each
                $(this).children("td").each(function (index) {
                    if (index === 0) {
                        //Here, this == <td> of specified index
                        $("#a").val(this.innerText);
                    }
                    if (index === 1) {
                        $("#operation").val(this.innerText);
                    }
                    if (index === 2) {
                        $("#b").val(this.innerText);
                    }
                })
            })
        })
        .catch(function(error) {
            console.log(error);
        });

    //Only want this to run on submission
    $("#myForm").on("submit", function (e) {    //#myForm from HTML div
        //stops page reloading on submission
        e.preventDefault();
        //Calculator function only runs on form submission
        calculator();
    });

    function calculator() {
        //get a, b & operation input values using jQuery and assign to variables
        var a = $("#a").val();
        var b = $("#b").val();
        var op = $("#operation").children('option:selected').val();

        // Force Ajax header
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

        //Create a new FormData Object to send variables to PHP script
        var calcData = new FormData();
        calcData.append('a', a);    //creates key:value pairs e.g. 'a': 6
        calcData.append('b', b);
        calcData.append('op', op);

        //Send/(POST) FormData instance to PHP file, triggering PHP code within if block
        axios.post("maths.php", calcData)
            .then(function (response) {
                //result will appear in console
                console.log(response.data);
                //result will appear as value of #result input box on page
                $("#result").val(response.data);
                //Go back into PHP script to retrieve all calcs performed so far,
                //including the one within this post req, so table is updated immediately
                //Use timeout to give txt file a second to appear
                setTimeout(function() {
                    axios.get("maths.php")
                        .then(function (response) {
                            //console.log(response.data);
                            $("#table").html(response.data);    //#table from HTML div
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                }, 1000)

            })
            .catch(function (error) {
                console.log(error);
            })
    }

})


