document.querySelector("main").insertAdjacentHTML("beforeend",  
`
    <h1>My Pets!</h1>
    <ul>
        ${createListItems(pets)}
    </ul>
`);

function createListItems(obj)
{
    let items = "";
    for (let i = 0; i < obj.length; i++)
    {
        items +=`<li>
        <h2>${obj[i].name}</h2>
        <img src="${obj[i].photo}">
        <p>${obj[i].animal} | ${obj[i].breed}</p>
        <p>Age: ${obj[i].age}</p>
        </li>`;
    }
    return items;
}