let score = 0;

alert("Before allowing you to view the website, I must test your knowledge first.");

let guess = prompt("The assassin had a scar on his cheek in the shape of a...");
let answer = "banana";

if (guess.toLowerCase() === answer)
{
    score ++;
    alert("Correct");
}
else
{
    alert("Incorrect");
}

guess = prompt("Who broke the elevator?");
answer = "leonard";

if (guess.toLowerCase() === answer)
{
    score ++;
    alert("Correct");
}
else
{
    alert("Incorrect");
}

guess = prompt("What is the name of Joey's chair");
answer = "rosita";

if (guess.toLowerCase() === answer)
{
    score ++;
    alert("Correct");
}
else
{
    alert("Incorrect");
}

let message;

switch(score)
{
    case 3: 
    message = "Well done agent: Perfect Score";
    break;
    case 2: 
    message = "Good enough agent";
    break;
    case 1: 
    message = "Eh you got one right";
    break;
    case 0: 
    // 1. Display an alert dialog with the content: "Warning! This message will self-destruct in"
    alert("Warning! This message will self destruct in...");
    
    // 2. Display a "3... 2... 1..." countdown using 3 alert dialog boxes
    for( let i = 3; i > 0; i--) {
        alert(`${i}...`);
    }

    // 3. This statement selects the <h1> element and replaces its text with "BOOM!".
    document.querySelector("body").innerHTML = "<h1>🔥BOOM!🔥</h1>";

    // 4. Log "Message destroyed!" to the console
    console.log("Message destroyed!");
    break;
    default:
        break;
}

if (message != null)
{
    alert(message);
    alert("Retrieving files...");
}