//Important: Cannot use AJAX locally...
//Need to set up a local server or view from github

// AJAX Basics (https://teamtreehouse.com/library/ajax-basics-2)

//#region AJAX Basics - Basic Info

//#region What is AJAX?

//Asynchronous JavaScript and XML (AJAX for short)

//Request info from server
//Generate HTML content and update the page without needing to refresh it

//#endregion

//#region 4 Steps of Using AJAX

// 1 - Setup a variable for the XHR object
var xhr = new XMLHttpRequest();

// 2 - Create a callback function for what happens when the server sends a respons
xhr.onreadystatechange = ()=>{
    if (xhr.readyState === 4)
    {
        //0 - 3 are early stages (0 is when object is created, 3 response is coming)
        //State 4 is executed on complete
        //Request is done and server has sent back a reponse

        //Code here
        document.getElementById("ajax").innerHTML = xhr.responseText;
    }
};

// 3 - Open a Request
xhr.open("GET", "sidebar.html");

// 4 - Send the Request
xhr.send();

function sendAJAX(){
    xhr.send(); //Sends the request via function, could be called on button click
    /* Can call function from button in HTML like this
    <button id="load" onclick="sendAJAX()">AJAX button</button>
    */
}

//#endregion

//#region GET and POST

//Get appears in the url, so don't use for sensitive data or if there's a lot of it
//Use for search forms or if you're only getting info from a web server
xhr.open("GET", "sidebar.html");

//Post appears in the url, so use for sensitive data or if there's a lot of it
xhr.open("POST", "sidebar.html");


//#endregion

//#region AJAX Response Formats

//Reponses may be in XML or JSON
//JSON is more popular

//#endregion

//#region AJAX Limitations

//Reponses may only be from the same server, website, protocols and port
//Can circumvent this using a Web Proxy, JSONP or CORS
//Use for files or images from other sites

//Can only use when using a server, so it won't work for local files
//Unless you use WAMP for Windows and view your page through that

//#endregion

//#endregion

//#region AJAX Basics - Example Projects

//#region Request Validation

xhr.onreadystatechange = ()=>{
    if (xhr.readyState === 4)
    {
        switch (xhr.status)
        {
            case 200:
                //Success
                document.getElementById("ajax").innerHTML = xhr.responseText;
                break;
            case 404:
                //File not found
                alert(`Error: 404 (File not found)`);
                break;
            case 500:
                //Server error
                alert(`Error: 500 (Server error)`);
                break;
            default:
                alert(`Error: ${xhr.status}`);
                break;
        }
    }
};

//#endregion

//#region Storing data with JSON (In different file)

//JSON strings must be in double quotes
[
    {
        "name": "Aimee", //JSON strings must be in double quotes
        "inoffice": true
    },
    {
        "name": "John",
        "inoffice": false
    },
    {
        "name": "Travis",
        "inoffice": false
    },
    {
        "name": "Edwin",
        "inoffice": true
    }
]

//#endregion

//#region Parsing JSON Data


xhr.onreadystatechange = ()=>{
    if (xhr.readyState === 4 && xhr.status === 200)
    {
        xhr.responseText; //Returns reponse as a string
        var employees = JSON.parse(xhr.responseText); //Parses response as JSON object
    }
};

//#endregion

//#region Employees in Office Example

var xhr = new XMLHttpRequest();

xhr.onreadystatechange = ()=>{
    if (xhr.readyState === 4)
    {
        switch (xhr.status)
        {
            case 200:
                //Success
                xhr.responseText; //Returns reponse as a string
                var employees = JSON.parse(xhr.responseText); //Parses response as JSON object
                var statusHTML = `<ul class="bulleted">`;
                for (let i = 0; i < employees.length; i++)
                {
                    statusHTML += `<li class="${employees[i].inoffice ? "in" : "out"}">${employees[i].name}</li>`;
                }
                statusHTML += `</ul>`;
                document.getElementById("employeeList").innerHTML = statusHTML;
                break;
            case 404:
                //File not found
                alert(`Error: 404 (File not found)`);
                break;
            case 500:
                //Server error
                alert(`Error: 500 (Server error)`);
                break;
            default:
                alert(`Error: ${xhr.status}`);
                break;
        }
    }
};

xhr.open("GET", "data/employees.json"); //Data array stored in above section

function sendAJAX(){
    xhr.send();
}

//#endregion

//#region Available Rooms Example

var roomsRequest = new XMLHttpRequest();

roomsRequest.onreadystatechange = ()=>{
    if (roomsRequest.readyState === 4)
    {
        switch (roomsRequest.status)
        {
            case 200:
                var rooms = JSON.parse(roomsRequest.responseText); //Parses response as JSON object
                var statusHTML = `<ul class="rooms">`;
                for (let i = 0; i < rooms.length; i++)
                {
                    statusHTML += `<li class="${rooms[i].available ? "empty" : "full"}">${rooms[i].room}</li>`;
                }
                statusHTML += `</ul>`;
                document.getElementById("roomList").innerHTML = statusHTML;
                break;
            case 404:
                //File not found
                alert(`Error: 404 (File not found)`);
                break;
            case 500:
                //Server error
                alert(`Error: 500 (Server error)`);
                break;
            default:
                alert(`Error: ${xhr.status}`);
                break;
        }
    }
};

roomsRequest.open("GET", "data/rooms.json"); //Data array stored in above section

roomsRequest.send();

//#endregion

//#endregion

