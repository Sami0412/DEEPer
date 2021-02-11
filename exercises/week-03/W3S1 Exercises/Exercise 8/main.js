window.addEventListener("DOMContentLoaded", function (e) {
    //This GET request runs on page load to populate table with previous calculations
    axios.get("maths.php")
        .then(function (response) {
            //console.log(response.data);
            $("#table").html(response.data);
            console.log("HI");
            console.log(document.querySelector("#calcsTable"));
            $("#calcsTable tr").click(function (e) {
                console.log(this);
                var clonedHTML = $(e.target).clone()
                $("#a").val(this);
            })
        })
        .catch(function (error) {
            console.log(error);
        });

//Only want this to run on submission
    $("#myForm").on("submit", function (e) {
        //stops page reloading on submission
        e.preventDefault();
        //Calculator function only runs on form submission
        calculator();
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
                setTimeout(function() {
                    axios.get("maths.php")
                        .then(function (response) {
                            //console.log(response.data);
                            $("#table").html(response.data);
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

        // setTimeout(function updateTable() {
        //     axios.get("maths.php")
        //         .then(function(response) {
        //             //console.log(response.data);
        //             $("#table").html(response.data);
        //         })
        //         .catch(function(error) {
        //             console.log(error);
        //         })
        // }, 500)
//}


//
// function reuseValues() {
//     var selectedCell = $(this).find("td").html();
//     console.log(selectedCell);
// })



