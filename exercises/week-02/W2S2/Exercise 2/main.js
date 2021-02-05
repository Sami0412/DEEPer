axios.get("https://api.jokes.one/jod?category=animal")
.then(function (response) {
    console.log(response);
    $('#joke').text(response.data.contents.jokes[0].joke.text).appendTo();
})
.catch(function (error) {
    console.log(error);
})