//alert("I'm Javascript!")      Task 2

//TASK: "WORKING WITH VARIABLES"
// let admin;
// let name;
// name="John";
// admin=name;
// alert(admin);

//TASK: GIVING THE RIGHT NAME
// const ourPlanet;
// let currentUser;

//TASK: UPPERCASE CONSTANT?
// const BIRTHDAY = '18.04.1982'; //value known prior to execution
// const age = someCode(birthday);

//TASK: STRING QUOTES
// let name = "Ilya";
// alert(`Hello ${1}`);
// alert(`Hello ${"name"}`);
// alert(`Hello ${name}`);

//TASK: A SIMPLE PAGE
// let name = prompt("What is your name?", "Bob");
// alert(name);

//TASK: THE POSTFIX AND PREFIX FORMS
// let a = 1, b = 1;
// alert(++a);

//OBJECTS
// let user = {
//     name: "Sami",
//     age: 31,
// };

// let clone = {};
//
// for (let key in user) {
//     clone[key] = user[key];
// }

// let cats = {
//     likesCats: true
// }
// let dogs = {
//     likeDogs: false
// }
//
// Object.assign(user, cats, dogs);

//TASK: SUM OBJECT PROPERTIES
// let salaries = {
//     John: 100,
//     Ann: 160,
//     Pete: 130,
// }
// let sum = 0;
// for (let salary in salaries) {
//     sum += salaries[salary];
// };
// console.log(sum);

//TASK: MULTIPLY NUMERIC PROPERTY VALUES BY 2
// let menu = {
//     width: 200,
//     height: 300,
//     title: "My menu"
// };
//k
// function multiplyNumeric(obj) {
//     for (let prop in obj) {
//         if (typeof obj[prop] === "number") {
//             obj[prop] *= 2;
//         }
//     }
// }

//Create a script that prompts the visitor to enter two numbers and then shows their sum.

// let num1 = +prompt("Enter your first number", "");
// let num2 = +prompt("Enter your second number", "");
// let sum = num1 + num2;
// alert(sum);

function addHighlightClass() {
    var paragraph = document.getElementById("demo-paragraph");
    // paragraph.classList.add("highlight");
    paragraph.style.background = "yellow";
}

function removeHighlightClass() {
    var paragraph = document.getElementById("demo-paragraph");
    // paragraph.classList.remove("highlight");
    paragraph.style.background = "none";
}









