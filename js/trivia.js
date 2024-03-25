const questions = 
[
    {
        question: "The assassin had a scar on his cheek in the shape of a...",
        answer: "banana",
        film: "Johnny English"
    },
    {
        question: "Who broke the elevator?",
        answer: "leonard",
        film: "The Big Bang Theory"
    },
    {
        question: "What is the name of Joey's chair?",
        answer: "rosita",
        film: "Friends"
    },
    {
        question: "Who retrieved the pizza in the Darkest Timeline?",
        answer: "troy",
        film: "Community"
    }
]

const watched = [];
const notWatched = [];

let message;
let score = 0;

alert("Before allowing you to view the website, I must test your knowledge first.");

for(let i = 0; i < questions.length; i++)
{
    let guess = prompt(questions[i].question);
    let answer = questions[i].answer;

    if (guess.toLowerCase() === answer)
    {
        score ++;
        watched.push(questions[i].film);
        alert("Correct");
    }
    else
    {
        notWatched.push(questions[i].film);
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