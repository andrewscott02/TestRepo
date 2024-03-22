//Can assign a function to a variable with expressions
const getRandomNumber = function(upper)
{
    const randomNumber = Math.floor(Math.random() * upper) + 1;
    return randomNumber;
};

//Call the expression like so
let randomNumber = getRandomNumber(5);

alert(randomNumber);
