// Understanding Closures in JavaScript (https://teamtreehouse.com/library/understanding-closures-in-javascript)

//#region Outer and Inner Functions

function OuterFunction()
{
    //Sets up a private scope for variables
    var count = 0;

    function InnerFunction()
    {
        count++;
        console.log(`Called ${count} times`);
    }

    return InnerFunction();
}

counter1 = OuterFunction();
counter2 = OuterFunction();

counter1(); //Called 1 times
counter1(); //Called 2 times
counter2(); //Called 1 times
counter1(); //Called 3 times

//#endregion

//#region General Counter Function

function MakeCounter(noun)
{
    //Sets up a private scope for variables
    var count = 0;

    function InnerFunction()
    {
        count++;
        console.log(`There are ${count} ${noun}s`);
    }

    return InnerFunction();
}

birdCounter = MakeCounter("birds");
dogCounter = MakeCounter("dogs");

birdCounter(); //There are 1 birds
birdCounter(); //There are 2 birds
dogCounter(); //There are 1 dogs
birdCounter(); //There are 3 birds

//Use cases are for packages, so they don't include global variables that must not be overwritten

//#endregion

//#region Use for Buttons

var buttons = document.getElementsByTagName("button");

//Problem with this function is that the button name will only ever be the last button's name
//So it will log the last button name
for(var i = 0; i < buttons.length; i++)
{
    var button = buttons[i];
    var buttonName = button.innerHTML;

    button.addEventListener("click", ()=>{
        console.log(buttonName); //Bug, will only log the last button
    });
}

//This fixes the issue
for(var i = 0; i < buttons.length; i++)
{
    var button = buttons[i];
    var buttonName = button.innerHTML;

    button.addEventListener("click", CreateButtonHandler(buttonName));
}

function CreateButtonHandler(name)
{
    return ()=>{
        console.log(name);
    }
}

//Alternatively, using let keyword for the variable
for(var i = 0; i < buttons.length; i++)
{
    var button = buttons[i];
    let buttonName = button.innerHTML; //Creates a new block scope

    button.addEventListener("click", ()=>{
        console.log(buttonName);
    });
}

//#endregion