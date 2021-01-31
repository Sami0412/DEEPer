let button = document.getElementById("colour-button");
button.onclick = function colourChange() {
    //take colour from input
    let newColour= document.getElementById("input-colour").value;
    //assign a new class to form with that colour
    let formBackground = document.getElementById("my-form");
    formBackground.style.background = newColour;
    return false;
};
