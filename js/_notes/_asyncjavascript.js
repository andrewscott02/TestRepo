//#region Asynchronous Programming with JavaScript (https://teamtreehouse.com/library/asynchronous-programming-with-javascript)

//#region Basics

//Use setTimeout to perform code asynchronously
function carryOn()
{
    console.log("starting");
    setTimeout(()=>{
        console.log("finished!");
    }, 8000);
};

var btn = document.getElementById("btn)");
btn.addEventListener("click", carryOn);

//This is how you've been doing server requests with AJAX, with callback functions

//#endregion

//#region Basic Examples

//Examples
var fruits = [];
fruits.forEach( fruit => console.log(fruit) );

const capitalizedFruits = fruits.map( fruit => fruit.toUpperCase() );

const sNames = names.filter( name => {
    return name.charAt(0) === 'S';
});

//Continuation-passing stlye (chaining async functions together)
function add(x, y, callback)
{
    callback(x + y)
}

function subtract(x, y, callback)
{
    callback(x - y);
}

function multiply(x, y, callback)
{
    callback(x * y);
}

function calculate(x, callback)
{
    callback(x);
}

calculate(5, (n) => {
    add(n, 10, (n) => {
        subtract(n, 2, (n) => {
            multiply(n, 5, (n) => {
                console.log(n); // 65
            });
        });
    });
});

//#endregion

//#region Callback Functions

const astrosUrl = 'http://api.open-notify.org/astros.json';
const wikiUrl = 'https://en.wikipedia.org/api/rest_v1/page/summary/';
const peopleList = document.getElementById('people');
var btn = document.querySelector('button');

// Make an AJAX request
function getJSON(url, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open('GET', url);
  xhr.onload = () => {
    if(xhr.status === 200) {
      let data = JSON.parse(xhr.responseText);
      return callback(data);
    }
  };
  xhr.send();
}

function GetProfiles(json)
{
    json.people.map(person=>{
        getJSON(wikiUrl + person.name, generateHTML);
    });
}

// Generate the markup for each profile
function generateHTML(data) {
  const section = document.createElement('section');
  peopleList.appendChild(section);
  // Check if request returns a 'standard' page from Wiki
  if (data.type === 'standard') {
    section.innerHTML = `
      <img src=${data.thumbnail.source}>
      <h2>${data.title}</h2>
      <p>${data.description}</p>
      <p>${data.extract}</p>
    `;
  } else {
    section.innerHTML = `
      <img src="img/profile.jpg" alt="ocean clouds seen from space">
      <h2>${data.title}</h2>
      <p>Results unavailable for ${data.title}</p>
      ${data.extract_html}
    `;
  }
}

btn.addEventListener("click", (event)=> {
    getJSON(astrosUrl, GetProfiles);
    event.target.remove();
});

//#endregion

//#region Promises

//#region Promises - Basics

//Helps manage async operations
//Guarantees some return value, even on failure

var order = true;

const breakfastPromise = new Promise((resolve, reject)=>
{
    setTimeout(()=>{
        if (order)
        {
            //resolve(); //Calls the resolve callback
            resolve("Your order is ready"); //Can put parameters in the function
        }
        else
        {
            reject("There was a problem with your order"); //Calls the reject callback
        }
    }, 3000);
})

console.log(breakfastPromise); //Should log pending

breakfastPromise.then(val => console.log(val)); //When resolved, log val to the console

//#endregion

//#region Promises - Handling Failures

//Can use catch for failures
breakfastPromise.catch()(err => console.log(err));

//You can append catch to then
breakfastPromise
    .then(val => console.log(val))
    .catch(err => console.log(err));

//#endregion

//#region Promises - Using Normal Functions

breakfastPromise
    .then(OnResolve)
    .catch(OnReject);

function OnResolve(val)
{
    console.log(val)
}

function OnReject(err)
{
    console.log(err)
}

//#endregion

//#region Promises - Chaining

function addFive(n) {
    return n + 5;
}
function double(n) {
    return n * 2;
}
function finalValue(nextValue) {
    console.log(`The final value is ${nextValue}`);
}

const mathPromise = new Promise( (resolve, reject) => {
    setTimeout( () => {
        // resolve promise if 'value' is a number; otherwise, reject it
        if (typeof value === 'number') {
            resolve(value);
        } else {
            reject('You must specify a number as the value.')
        }
    }, 1000);
});

var value = 5;
mathPromise
.then(addFive)
.then(double)
.then(finalValue)
.catch( err => console.log(err) )

// The final value is 20

var value = 5;
mathPromise
  .then(addFive)
  .then(double)
  .then(addFive) // called twice
  .then(finalValue)
  .catch( err => console.log(err) )

// The final value is 25

var value = '5';
mathPromise
  .then(addFive)
  .then(double)
  .then(finalValue)
  .catch( err => console.log(err) )

// You must specify a number as the value.

//#endregion

//#region Promises - Multiple Promises

function GetProfiles(json)
{
    const profiles = json.people.map(person=>{
        return getJSON(wikiUrl + person.name);
    });
    return Promise.all(profiles); //Waits for all of the profiles to be finished, then returns data with all of the profiles
}

//#endregion

//#region Promises - Updating the Example

//Updated functions in Callback Functions Region (line 66)

//Make an AJAX request
function getJSON(url)
{
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', url);
        xhr.onload = () => {
        if(xhr.status === 200)
        {
            let data = JSON.parse(xhr.responseText);
            resolve(data);
        }
        else
        {
            reject(Error(xhr.statusText));
        }
        };
        xhr.onerror = ()=> reject(Error("A network error occured"));
        xhr.send();
    });
}

function GetProfiles(json)
{
    const profiles = json.people.map(person=>{
        return getJSON(wikiUrl + person.name);
    });
    return Promise.all(profiles); //All or none: Rejects if one fails, like a bt sequence
}

// Generate the markup for each profile
function generateHTML(data) {
    data.map(person=>{
        const section = document.createElement('section');
        peopleList.appendChild(section);
        // Check if request returns a 'standard' page from Wiki
        if (data.type === 'standard')
        {
            section.innerHTML = `
              <img src=${person.thumbnail.source}>
              <h2>${person.title}</h2>
              <p>${person.description}</p>
              <p>${person.extract}</p>
            `;
        }
        else
        {
            section.innerHTML = `
              <img src="img/profile.jpg" alt="ocean clouds seen from space">
              <h2>${person.title}</h2>
              <p>Results unavailable for ${person.title}</p>
              ${person.extract_html}
            `;
        }
    });
}

btn.addEventListener("click", (event)=> {
    getJSON(astrosUrl)
        .then(GetProfiles)
        .then(generateHTML)
        .catch(err=>console.log(err));

    event.target.remove();
});

//#endregion

//#region Promises - Cleanup with finally

breakfastPromise
    .then(OnResolve)
    .catch(OnReject)
    .finally(OnFinally);

function OnFinally()
{
    //Calls when promise is finished, regardless of success or failure
    //Code here
}

//Useful for code that needs to run regardless
btn.addEventListener("click", (event)=> {
    event.target.textContent = "Loading...";

    getJSON(astrosUrl)
        .then(GetProfiles)
        .then(generateHTML)
        .catch(err=>{
            peopleList.innerHTML= "<h3>Something went wrong</h3>";
            console.log(err);
        })
        .finally(()=>event.target.remove); //Fires after resolve or reject
});

//#endregion

//#region Promises - Updating the Example with Fetch

function GetProfiles(json)
{
    const profiles = json.people.map(person=>{
        const craft = person.craft; //Adding the info on craft
        return fetch(wikiUrl + person.name) //No longer need the getJSON function, returns string
            .then(response=>response.json()) //Parses as json formatted data
            .then(profile => {
                return {...profile, craft}; //Adding the info on craft
            })
            .catch(err => console.log("Error Fetching Wiki: ", err)); //Catches error earlier
    });
    return Promise.all(profiles);
}

// Generate the markup for each profile
function generateHTML(data) {
    data.map(person=>{
        const section = document.createElement('section');
        peopleList.appendChild(section);
        // Check if request returns a 'standard' page from Wiki
        if (data.type === 'standard')
        {
            //Adding the craft info in span element
            section.innerHTML = `
              <img src=${person.thumbnail.source}>
              <span>${person.craft}</span>
              <h2>${person.title}</h2>
              <p>${person.description}</p>
              <p>${person.extract}</p>
            `; 
        }
        else
        {
            section.innerHTML = `
              <img src="img/profile.jpg" alt="ocean clouds seen from space">
              <h2>${person.title}</h2>
              <p>Results unavailable for ${person.title}</p>
              ${person.extract_html}
            `;
        }
    });
}

btn.addEventListener("click", (event)=> {
    event.target.textContent = "Loading...";

    fetch(astrosUrl) //No longer need the getJSON function, returns string
        .then(response=>response.json()) //Parses as json formatted data
        .then(GetProfiles)
        .then(generateHTML)
        .catch(err=>{
            peopleList.innerHTML= "<h3>Something went wrong</h3>";
            console.log(err);
        })
        .finally(()=>event.target.remove); //Fires after resolve or reject
});

//#endregion

//#endregion

//#region Async/Await

//#region Async/Await - Basics

async function fetchData(url)
{
    /**
     * The await keyword pauses execution of async function and waits for the resolution of a promise
     * Resumes execution and returns the resolved value
     * Pausing execution in this way does not cause blocking behaviour
     * 
     * await can only be used in async function
     */
    const response = await fetch(url);
    const data = await response.json();

    return data;
}

//Async fuctions return a promise
var url = "";
fetchData(url)
    .then(data => console.log(data)); //Can use then, catch and finally, just like a promise

//#endregion

//#region Async/Await - Updating the Example with async functions

async function getJSON(url)
{
    try
    {
        const response = await fetchData(url);
        return await response.json();
    }
    catch (error)
    {
        throw error;
    }
}

async function GetPeopleInSpace(url)
{
    const peopleJSON = await getJSON(url);

    const profiles = peopleJSON.people.map( async person => {
        const craft = person.craft;
        const profileJSON = await getJSON(wikiUrl + person.name);

        return {...profileJSON, craft};
    });

    return Promise.all(profiles);
}

// Generate the markup for each profile
function generateHTML(data) {
    data.map(person=>{
        const section = document.createElement('section');
        peopleList.appendChild(section);
        // Check if request returns a 'standard' page from Wiki
        if (data.type === 'standard')
        {
            //Adding the craft info in span element
            section.innerHTML = `
              <img src=${person.thumbnail.source}>
              <span>${person.craft}</span>
              <h2>${person.title}</h2>
              <p>${person.description}</p>
              <p>${person.extract}</p>
            `; 
        }
        else
        {
            section.innerHTML = `
              <img src="img/profile.jpg" alt="ocean clouds seen from space">
              <h2>${person.title}</h2>
              <p>Results unavailable for ${person.title}</p>
              ${person.extract_html}
            `;
        }
    });
}

btn.addEventListener("click", (event)=> {
    event.target.textContent = "Loading...";

    GetPeopleInSpace(astrosUrl)
        .then(generateHTML)
        .catch(err => {
            peopleList.innerHTML = "<h3>Something went wrong!</h3>";
            console.error(err);
        })
        .finally(() => event.target.remove());
});

//#endregion

//#endregion

//#endregion

//#region Working with the Fetch API (https://teamtreehouse.com/library/working-with-the-fetch-api)

const select = document.getElementById("breeds");
const card = document.querySelector(".card");
const form = document.querySelector("form");

//#region Fetch Functions

function FetchData(url)
{
    return fetch(url)
                .then(CheckStatus)
                .then(res => res.json())
                .catch(err => console.log("Something went wrong", err));
}

//Can use Promise.All to only procede if both are successful
// Promise.all([
//     FetchData('https://dog.ceo/api/breeds/list'),
//     FetchData('https://dog.ceo/api/breeds/image/random')
// ])
// .then(data =>
// {
//     const breedList = data[0].message;
//     const randomImage = data[1].message;

//     GenerateOptions(breedList);
//     GenerateImage(randomImage);
// })

//Gets dog breeds
FetchData('https://dog.ceo/api/breeds/list')
    .then(data => GenerateOptions(data.message));

//Gets dog image
FetchData('https://dog.ceo/api/breeds/image/random')
    .then(data => GenerateImage(data.message));

//#endregion

//#region Helper Functions

function CheckStatus(response)
{
    if (response.ok)
    {
        return Promise.resolve(response);
    }
    else
    {
        return Promise.reject(new Error(response.statusText));
    }
}

function GenerateOptions(data)
{
    const options = data.map(item => `
        <option value="${item}">${item}</option>
    `).join("");
    select.innerHTML = options;
}

function GenerateImage(data)
{
    const html = `
        <img src="${data}" alt>
        <p>Click to view images of ${select.value}</p>
        `;
    card.innerHTML = html;
}

function FetchBreedImage()
{
    const breed = select.value;
    const img = card.querySelector("img");
    const p = card.querySelector("p");

    FetchData(`https://dog.ceo/api/breed/${breed}/images/random`)
        .then(data => {
            img.src = data.message;
            img.alt = breed;
            p.textContent = `Click to view more ${breed}s`;
        });
}

//#endregion

//#region Event Listeners

select.addEventListener("change", FetchBreedImage);
card.addEventListener("click", FetchBreedImage);
form.addEventListener("submit", PostData);

//#endregion

//#region Post Data

function PostData(event)
{
    event.preventDefault();
    const name = document.getElementById("name").value;
    const comment = document.getElementById("comment").value;

    const config = {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({name: name, comment: comment})
    }

    fetch('https://jsonplaceholder.typicode.com/comments', config)
        .then(CheckStatus)
        .then(res=> res.json())
        .then(data => console.log(data));
}

//#endregion

//#endregion