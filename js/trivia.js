const questions = 
[
    ["The assassin had a scar on his cheek in the shape of a...", "banana", "Johnny English"],
    ["Who broke the elevator?", "leonard", "The Big Bang Theory"],
    ["What is the name of Joey's chair?", "rosita", "Friends"],
    ["Who retrieved the pizza in the Darkest Timeline?", "troy", "Community"]
]

const watched = [];
const notWatched = [];

let message;
let score = 0;

alert("Before allowing you to view the website, I must test your knowledge first.");

for(let i = 0; i < questions.length; i++)
{
    let guess = prompt(questions[i][0]);
    let answer = questions[i][1];

    if (guess.toLowerCase() === answer)
    {
        score ++;
        watched.push(questions[i][2]);
        alert("Correct");
    }
    else
    {
        notWatched.push(questions[i][2]);
        alert("Incorrect");
    }
}

switch(score)
{
    case questions.length: 
    message = "Well done agent: Perfect Score";
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
    message = "Good enough agent";
    break;
}

if (message != null)
{
    alert(message);
    alert("Retrieving files...");

    document.querySelector("main").innerHTML = 
    `
        <h1>You got ${score} right!</h1>
        <p>You've probably seen</p>
        <ol>
            ${createListItems(watched)}
        </ol>

        <p>You should probably watch these</p>
        <ol>
            ${createListItems(notWatched)}
        </ol>
    `;
}

function createListItems(arr)
{
    let items = "";
    for (let i = 0; i < arr.length; i++)
    {
        items += `<li>${arr[i]}</li>`;
    }
    return items;
}