setTimeout(() => {

    const password = "banana";
    const pass = prompt("The assassin had a scar on his cheek in the shape of a...");

    if (pass.toLowerCase() != password)
    {
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
    }
    else
    {
        alert("Password correct, retrieving files...");
    }
});