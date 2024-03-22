let weather = prompt("What is the weather?");

switch(weather)
{
    case "sun":
        alert("It's sunny, swim")
        break;
    case "rain":
        alert("It's raining, stay indoors")
        break;
    case "wind":
        alert("It's windy, stay indoors")
        break;
    default: 
        alert("I don't know")
        break;
}