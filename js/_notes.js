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

var multiArray = [];

var student1 = ["Al", 5]
var student2 = ["Rose", 7]
var student3 = ["Ian", 3]

//#endregion

//#endregion