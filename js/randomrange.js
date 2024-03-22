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

const minRaw = prompt("Input an integer for the minimum value (Inclusive)");
const maxRaw = prompt("Input an integer for the maximum value (Exclusive)");

var rand = RandomRange(minRaw, maxRaw);

if (rand)
{
    alert(`${rand} is a random number between ${minRaw} and ${maxRaw}`);
}