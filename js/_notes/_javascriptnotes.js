//#region Basics Course

//#region Basics - Writing messages

alert("Hello world");
console.log("Hello world");
document.write("Welcome to my webpage");

//#endregion

//#region Basics - Variables

//#region Variable Basics

//Generic variables that can be set and get, and can be declared multiple times
//Use for local variables
var a = 10;
var a = 5;

//Constant variables with a value that can never change
const pi = 3.14;

//Variable similar to var, but cannot declare a variable twice
//Use let for global variables used throughout and var for local 
let score = 0;
score = 5;

//#endregion

//#region Strings

const htmlSnippet = '<h1 class="class">Header</h1>'
var message1 = "I'm a programmer!";
var message2 = 'I\'m a programmer!';

//Use backslashes for multiline strings
var multiline = "Line\
Line\
Line";

//Use .length to get number of characters in a string
console.log(message1.length);

//Use .toLowerCase and .toUpperCase methods to change case of string
message1 = message1.toUpperCase();

//#endregion

//#endregion

//#region Basics - Logical Operators

//#region If Statements

if ("apple" < "bear")
{
    //Returns true if first string comes before seconds string in alphabetical order
    //Checks first letter only?
}

if ("3" == 3) //!=
{
    //Double equals returns true if the values are the same, even if the type isn't
}

if (3 === 3) //!==
{
    //Strict equals returns true if the type and values are the same
}

// Logical operators like && || ! and ^ operators work in javascript too

//#endregion

//#region Switch Statements

//Switch statements work in javascript

let weather = "sun";

switch(weather)
{
    case "sun":
        console.log("It's sunny, swim")
        break;
    case "sun":
        console.log("It's raining, stay indoors")
        break;
    default: 
        console.log("I don't know")
        break;
}

//#endregion

//#endregion

//#region Basics - Comments

// Comments can be done like this

/* Or like this */

/**
 * Or 
 * even 
 * like
 * this
*/

//#endregion

//#endregion

//#region Numbers Course

//#region Numbers - Convert Strings to Numbers

const num_string1 = "1";
const num_string2 = "2";

//Since prompts return a string, it will simply add the 2 strings together
//So this variable would be 12 instead of the expected 3
let total_num_string = num_string1 + num_string2;
console.log(typeof total_num_string); //Will output string

//Use parseInt or parseFloat to convert to numeric data types
let total_num = parseInt(num_string1) + parseInt(num_string2)
console.log(typeof total_num); //Will output integer

//Can also use a + before the variable
//Though it is less readable
total_num = +num_string1 + +num_string2;

//parseInt and parseFloat can also get values at the start of a string
var string = "18 is the minimum drinking age";
let ageReq = parseInt(string);
//ageReq will be 18

var string = "18.4 is the length of an image";
let distance_int = parseInt(string); //Will be 18
let distance_float = parseFloat(string); //Will be 18.4

//#endregion

//#region Numbers - NaN

var numRaw = prompt("Enter a number");
var num = parseInt(numRaw);

if (num) //Checks that the input is a valid int and not NaN
{
    //Do code
}

if (isNaN(num)) //Another way to check numer is not NaN
{
    //Do code
}

//#endregion 

//#region Numbers - Math Library

//Round Function
Math.round(2.2) //rounds to 2
Math.round(2.8) //rounds to 3

Math.floor(2.8); //rounds to 2, always rounds down
Math.floor(2.2); //rounds to 3, always rounds up

//Random Functions
Math.random(); //returns a random number between o (inclusive) and 1 (exclusive)

//Returns a random integer between o (inclusive) and 6 (exclusive)
Math.floor(Math.random() * 6);

//Returns a random integer between 1 (inclusive) and 7 (exclusive)
Math.floor(Math.random() * 6) + 1;

//#endregion

//#endregion

//#region Functions Course

//#region Functions - Basics

//#region Functions - Declaring and Calling

function FunctionName() //Declare functions
{
    //Code here
}

FunctionName(); //Call Functions

//#endregion

//#region Functions - Return Values

//You do not need to specify if a function has a return type
//You only need to return the value when needed
function getYear()
{
  const year = new Date().getFullYear();
  return year;
}

let currentYear = getYear();

//#endregion

//#region Functions - Inputs

//Add inputs in the brackets
//You do not need to specifiy the type for the inputs
function ReturnValue(value)
{
    return value;
}

function getArea(width, length, unit = "meters")
{
    const area = width * length;
    return `${area} ${unit}`;
}

//#endregion

//#region Functions - Scopes

var scopeVar;

function ScopeFunc()
{
    var scopeVar; //This is separate from the other scopeVar
    this.scopeVar; //Gets the scopeVar from the script scope
}

//#endregion

//#endregion

//#region Functions - Expressions and Arrow Syntax

//#region Functions - Expressions

//Can assign a function to a variable with expressions
const getRandomNumber = function(upper)
{
    const randomNumber = Math.floor(Math.random() * upper) + 1;
    return randomNumber;
};

//Call the expression like so
let randomNumber = getRandomNumber(5);

//These are not hoisted like regular expressions
//This means they do not load before code is run, so they cannot be called before they are declared

//#endregion

//#region Functions - Arrow Syntax

//Can assign a function to a variable with expressions
const FuncArrow = () =>
{
    //Code Here
};

//Note that, like regular expressions, these are not hoisted

//#endregion

//#region Functions - Shorthands for Arrow Syntax

//If you only have 1 parameter, you can omit the brackets
const FuncSingleInput = upper =>
{
    //Code here
};

//If you have multiple parameters, you need the brackets
const FuncMultiInput = (var1, var2) =>
{
    //Code here
};

//#endregion

//#region Functions - Implicit Returns for Arrow Syntax

//If the body only has a single line of code
//You can use a single-line function
const FuncIncrement = x => x + 1;

//Single-line functions with no inputs still requires brackets
const FuncNoInput = () => 1 + 1;

//You can return a multipline block using brackets instead of curly braces
const FuncIncrementMulti = x => 
(
    x + 1
);

//#endregion

//#endregion

//#region Functions - Function Parameters

//Can use default values by asigning a value to it
function sayGreeting(greeting = "Hello", name = "student")
{
    return `${greeting} ${name}`
}

//Use undefined to skip parameters
sayGreeting(undefined, "AL");

/**
 * Can use these types of comments to describe functions
 * @param {int} param1 - Description of parameter 1
 * @param {float} param2 - Description of parameter 2
 * @returns {string} Description of return type
 */
function commentTest(param1, param2)
{
    return `${param1} ${param2}`
}

//#endregion

//#region Functions - Random Range Function Example

/**
 * 
 * @param {int} minRaw - Minimum value
 * @param {int} maxRaw - Maximum value (exclusive)
 * @returns {int} A random integer between the input values
 */
function RandomRange(minRaw = 0, maxRaw = 0)
{
    var min = parseInt(minRaw);
    var max = parseInt(maxRaw);
    
    if (min && max) //This checks that the numbers are not NaN
    {
        var range = parseInt(max) - parseInt(min);
        var result = Math.floor(Math.random() * range) + parseInt(min);
        return result;
    }
    else
    {
        alert("Inputs are not valid inputs");
        throw Error("Inputs are not valid inputs");
    }
}

var rand = RandomRange(0, 7);

if (rand)
{
    alert(rand);
}

//#endregion

//#endregion

//#region Loops Course

//#region Loops - Loop types

//#region Loops - While Loop

while(true)
{
    //Runs indefinately
}

var i = 10;

while(i > 0)
{
    //Runs until i is 0 or less
    i --;
}

//#endregion

//#region Loops - Do While Loop

var i = 10;
do
{
    //Runs like the while loop
    //Distinction is that the code executes before condition is checked
    //Useful for if the code must run at least once
    i --;
} while(i > 0);

//#region Example, repeats until secret is correct
let secret;
do
{
    // Display the prompt dialogue while the value assigned to `secret` is not equal to "sesame"
    secret = prompt("What is the secret password?");
} while(secret !== "sesame");
// This should run after the loop is done executing
alert("You know the secret password. Welcome!");
//#endregion

//#endregion

//#region Loops - For Loop

for (let i = 0; i < 10; i++)
{
    //Executes 10 times
}

//#endregion

//#endregion

//#region Loops - Displaying HTML Content with Loops

const main = document.querySelector("main");
let html = "";

for (let i = 1; i <= 10; i++)
{
    html += `<div style="background-color:${GetRandomColour()}">${i}</div>`;
}

main.innerHTML = html;

function GetRandomColour()
{
    randomRGB = MakeColour(GetRandomColourValue(),
                            GetRandomColourValue(),
                            GetRandomColourValue())
    return randomRGB;
}

function MakeColour(red, green, blue)
{
    return `rgb(${red}, ${green}, ${blue})`;
}

function GetRandomColourValue()
{
    return Math.floor(Math.random() * 256);
}

//#endregion

//#endregion

//#region Arrays Course

//#region Arrays - Basics

//#region Arrays - Declaring Arrays

//Declares an empty array
var array = [];

//Declares an array with some values
var planets = ["Mercury", "Venus", "Earth", "Mars"];

//Arrays can even store different value types
var data = ["string", 1, true]

//#endregion

//#region Arrays - Accessing Elements

var shoppingList = ["bread", "butter", "honey"];

shoppingList[0]; //Accesses the first item in the array

//Can use loops to access items in list
for(let i = 0; i < shoppingList.length; i++)
{
    shoppingList[i];
}

//#endregion

//#region Arrays - Adding Items

var array = [];

array.unshift("item"); //Adds an item to the start of the array
array.push("item"); //Adds an item to the end of the array

//You can even add multiple items at once with these functions
array.push("item1", "item2"); 

//Both of these functions returns the length of the array
//After the item is added
var arrayLength = array.unshift("item");

//#endregion

//#region Arrays - Removing Items

array.shift(); //Removes the first item
array.pop(); //Removes the last item

//Both of these functions returns the item so you can access it
var lastItem = array.pop();

//#endregion

//#region Arrays - Copying & Combining Arrays

const instructors = ["Al", "Rose", "Ian"]
const fighters = ["Lewis", "Sam1"]
const students = ["Sam", "Evie", "John", "Emma", "Sam2"]
// Use the spread operator (...) will add all items from the array
const members = [...instructors, ...fighters, ...students];
//Members will include all instructors, fighters and students

students.pop(); //This will update the students, but not the members

var numbers = [1, 2, 21, 3, 53, 32, 54];
Math.max(...numbers) //Passes all of the numbers in the array as arguments

//#endregion

//#region Arrays - Using Arrays to Add HTML Content

const playlist = 
[
    "What a Wonderful World",
    "The Way You Look Tonight",
    "The Way You Make Me Feel"
];

function createListItems(arr)
{
    let items = "";
    for (let i = 0; i < arr.length; i++)
    {
        items += `<li>${arr[i]}</li>`;
    }
    return items;
}

document.querySelector("main").innerHTML = 
`
    <ol>
        ${createListItems(playlist)}
    </ol>
`;

//#endregion

//#region Arrays - Useful Array Methods

var daysInWeek = 
[
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday",
    "Sunday"
]

//Returns as single-line, comma delineated list
var joinedArray = daysInWeek.join();
//Returns as single-line list, with no separation
var joinedArray = daysInWeek.join(""); 
//Returns as single-line, comma delineated list with spacing
var joinedArray = daysInWeek.join(", "); 

//Returns true if array contains item
var includesItem = daysInWeek.includes("Monday");

//Returns index of item
var includesItem = daysInWeek.indexOf("Wednesday"); //Should return 2

//#endregion

//#endregion

//#region Arrays - Multidimensional Arrays

//Multidimensional array containing other arrays
var multiArray = [];
var student1 = ["Al", 5]
var student2 = ["Rose", 7]
var student3 = ["Ian", 3]
multiArray = [student1, student2, student3];

multiArray[2][0]; //Gets the 3rd item, then the 1st item in that array

//#endregion

//#endregion

//#region Objects Course

//#region Objects - Basics

//#region Objects - Creating an Object Literal

const person = 
{
    name: "Quincy",
    city: "London",
    age: 37,
    isStudent: true,
    skills: ["Javascript", "HTML", "CSS"]
};

//#endregion

//#region Objects - Accessing Object Variables

person.name;
person.name = "Helen";

const message = `Hi, I'm ${person.name}. I have ${person.skills.length} skills: ${person.skills.join(", ")}.`;

person.nickname = "Tank"; //You can even add properties that weren't declared before

//#endregion

//#region Objects - Iterating through properties with For Loops

//Similar to Foreach Loop
for (let item in person)
{
    alert(`${[item]}: ${person[item]}`)
}

//#endregion

//#region Objects - Useful Methods

let objectKeys = Object.keys(person); //Returns an array of all of the property names in the object
objectKeys.length; //You can access all of the standard array properties and methods too

let objectValues = Object.values(person); //Returns an array with values instead

//You can use the spread operator to merge objects
const nameObj =
{
    firstName: 'Reggie',
    lastName: 'Williams',
};
  
const roleObj =
{
    title: 'Software developer',
    skills: ['JavaScript', 'HTML', 'CSS'],
    isTeacher: true
};
  
// merge `name` and `role` into a `person` object
const person =
{  
    ...nameObj,
    ...roleObj
};

//#endregion

//#endregion

//#region Objects - Store Objects in Arrays

//Instead of using multidimensional arrays,
//You can use arrays of objects to groups similar data
const questions = 
[
    {
        question: "The assassin had a scar on his cheek in the shape of a...",
        answer: "banana",
        film: "Johnny English"
    },
    {
        question: "Who broke the elevator?",
        answer: "leonard",
        film: "The Big Bang Theory"
    },
    {
        question: "What is the name of Joey's chair?",
        answer: "rosita",
        film: "Friends"
    },
    {
        question: "Who retrieved the pizza in the Darkest Timeline?",
        answer: "troy",
        film: "Community"
    }
]

//#endregion

//#endregion

//#region Javascript and the DOM Course

//#region DOM - Document Object Model

//Document, HTML, Head, Body and other HTML elements can be used as objects in Javascript
//Structuted as a tree; Head and Body are children of HTML, which is a child of Document
//H1, P and UL are children of Body, LIs are children of ULs
//Title is a child of Head

/**
*                 Document
*              |            |
*            Head          Body
*             |         |    |   |
*          Title       H1    P   UL
*                                 |
*                                 LI
*/

location.href; //Returns the URL

document; //This object is the root of every node in the DOM

//You can access different parts like so
document.title;
document.body;

//You can even change values here
document.title = "New web page title";
document.body.style.backgroundColor = "tomato";
document.body.innerHTML = "<h1>Hello world!</h1>";

//#endregion

//#region DOM - Browser Events and Event Listeners

document.body.addEventListener("click", OnClick);

function OnClick()
{
    document.querySelector("main").innerHTML += "<h1>Clicked</h1>";
}

//#endregion

//#region DOM - Selecting Elements

//#region DOM - Selecting an Element by ID

var headline = document.getElementById("headline"); //Gets an object by id
headline.style.border = "solid 2px red";

//#region DOM - Adding Click Events to specific elements

var btn = document.getElementById("btn");
btn.addEventListener("click", OnBtnClick);

function OnBtnClick()
{
    document.getElementById("content").innerHTML += "<h1>Clicked</h1>";
    headline.style.border = headlineBorder;
}

//#endregion

//#endregion

//#region DOM - Selecting Elements by HTML Tag

let tagElements = document.getElementsByTagName("li"); //Returns multiple elements by tag in the order they appear on the page

//Note: This is not an array, but it is similar
//This means they do not have the same properties and methods

for (let i = 0; i < tagElements.length; i++)
{
    tagElements[i].style.color = "white";
}

//#endregion

//#region DOM - Selecting Elements by Class Name

let highlights = document.getElementsByClassName("highlights");

//Foreach Loop
for (const highlight of highlights)
{
    highlight.style.backgroundColor = "cornsilk";
}

//#endregion

//#region DOM - Selecting Elements with CSS Queries

document.querySelector("li"); //Gets first item with the li tag
document.querySelector(".btn"); //Gets first item with the btn class
document.querySelectorALL(".highlights"); //Gets all items with the highlights class

//#endregion

//#endregion

//#region DOM - Getting and Setting Content

//The following have the same effect, note that I do not need the 
document.querySelector("h1").innerHTML = "<h1>New Text Content</h1>";
document.querySelector("h1").textContent = "New Text Content";

//Making a basic searchbar and changing header content to input value
var searchBtn = document.getElementById("btn-search");
searchBtn.addEventListener("click", SearchButton);

var input = document.getElementById("form-search");

function SearchButton()
{
    headline.textContent = input.value;
    headline.style.border = "solid 2px red";

    input.value = "";
}

//#endregion

//#region DOM - Setting Element Attributes

var input = document.getElementById("form-search");

input.type; //Returns current type
input.type = "checkbox"; //Sets type to checkbox

input.class; //Class is reserved in Javascript, use className to get class instead
input.className;
input.classList; //Gets all classes?

//#endregion

//#region DOM - Setting Styles

var hideBtn = document.getElementById("btn-hide");
hideBtn.addEventListener("click", ToggleHideContent);

var show = true;

function ToggleHideContent()
{
    show = !show;
    content.style.display = show ? "inline" : "none";
    hideBtn.textContent = show ? "Hide" : "Show";
}

//#endregion

//#region DOM - New DOM Elements

var listContent = document.getElementsByTagName("ol");

const newElement = document.createElement("li"); //Create the element
newElement.textContent = "New Text Value"; //Setting the text value of the element

listContent.append(newElement); //Adding the element to the DOM at the end
listContent.prepend(newElement); //Adding the element to the DOM at the start

//#region DOM - Inserting HTML at Specified Positions

var listContent = document.querySelector("ol");

listContent.insertAdjacentHTML
(
    "afterbegin",
    `<li>Text Content</li>`
);

//#endregion

//#endregion

//#region DOM - Removing DOM Elements

var listContent = document.getElementsByTagName("ol");
const lastItem = listContent.querySelector("li:last-child");
lastItem.remove();

//#endregion

//#endregion

//#region Interacting with the DOM

//#region DOM - Functions as Parameters

function SayHi()
{
    console.log("Hello");
}

function HiAndBye(func)
{
    func();
    console.log("Hello");
}

HiAndBye(SayHi);

HiAndBye(()=>
{
    console.log("This is an anonymous function");
});

//#endregion

//#region DOM - The Event Object

document.addEventListener("click", (event)=>{
    console.log(event); //Returns info about the event
    console.log(event.target); //Returns the element that triggered the event (could be a specific tag like <a> or <li>)
})

//#endregion

//#region DOM - Event Bubbling and Delegation

for (let item of listContent.getElementsByTagName("li"))
{
    item.addEventListener("mouseover", ()=>{
        item.textContent = rawContent.toUpperCase();
    })
}

//Instead of looping through all of the elements and adding listeners
//you can listen to the parent 
//This simplifies code, optimises memory and allows for dynamic elements to be included

listContent.addEventListener("mouseover", (event)=>{
    if (event.target.tagName === "LI")
    {
        event.target.textContent = event.target.textContent.toUpperCase();
    }
})

//#endregion

//#region DOM - Select Children and Parents

function AttachRemoveButton(li)
{
    let removeBtn = document.createElement("button");
    removeBtn.className = "remove";
    removeBtn.textContent = "Remove";

    li.appendChild(removeBtn);

}

listContent.children; //Gets all children of this element

listContent.addEventListener("click", (event)=>{
    if (event.target.tagName === "BUTTON")
    {
        const button = event.target;
        const li = button.parentNode; //Gets Parent Node
    }
})

//#endregion 

//#endregion