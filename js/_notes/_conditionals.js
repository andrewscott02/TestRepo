// Exploring JavaScript Conditionals (https://teamtreehouse.com/library/exploring-javascript-conditionals)

//#region If Else Statements

var isTrue = true;

if (isTrue)
{
    //Code if true
}
else
{
    //Code if false
}

//#endregion

//#region Switch Statements

var count = 2;

switch(count)
{
    case 0:
        //Code if 0
        break;
    case 1:
        //Code if 1
        break;
    case 2:
        //Code if 2
        break;
    case 3:
        //Code if 3
        break;
    default:
        //Code if no other values match
        break;
}

//#endregion

//#region Ternary Operator

isTrue ? console.log("TRUE") : console.log("FALSE");

var message = isTrue ? "TRUE" : "FALSE";
console.log(message);

//#endregion

//#region Short Circuits

//Only runs console.log if all other statements are true
3 === 3 && "a" === "a" && console.log("log");

function isAdult(age)
{
    return age && age >= 18; //Short circuiting
}

function CountToFive(start)
{
    start = start || 1; //Shortcircuit, if undefined, set start to
    //Bug: 0 is falsy, so this prevents 0 from being used

    for(var i = start; i <=5; i++)
    {
        console.log(i);
    }
}

function CountToFive(start = 1) //Sets default without overiding 0
{
    for(var i = start; i <=5; i++)
    {
        console.log(i);
    }
}

function greet(name)
{
    name && console.log(`Hi, ${name}!`); //If name is truthy, logs name
}

greet(); //Will not log
greet("Sam"); //Logs "Hi Sam!"

//#endregion