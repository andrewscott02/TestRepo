// Understanding Closures in JavaScript (https://teamtreehouse.com/library/understanding-closures-in-javascript)

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