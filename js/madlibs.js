const adjective = prompt("Give me an adjective");
const job = prompt("Give me a job");
const verb = prompt("Give me a verb in past tense");
const noun = prompt("Give me a noun");

let message = `<p>There was once a ${adjective} ${job} who ${verb} a ${noun}.</p>`

document.querySelector("body").innerHTML = message;