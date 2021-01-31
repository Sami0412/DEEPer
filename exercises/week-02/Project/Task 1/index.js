//when small image clicked, large image url changes to that of the small & vice versa and css applied
let mainImage = document.getElementById("pic1");
let allImages = document.querySelectorAll(".small-pic");

allImages.forEach(function (thumbnail) {
    thumbnail.addEventListener("click", function changeImg(e) {
        mainImage.src = e.target.src;
    })
});
// remove image from array to be displayed,and add in previously displayed