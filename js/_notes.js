//#region Basics

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

//#endregion

//#endregion

