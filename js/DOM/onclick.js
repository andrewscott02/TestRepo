$("#headline").hide();
$("#headline").fadeIn(1000);

var content = document.getElementById("content");
var listContent = content.getElementsByTagName("ol")[0];

var headline = document.getElementById("headline"); //Gets an object by id
var headlineBorder = headline.style.border;

var input = document.getElementById("form-search");

//Create Task Button

var createBtn = document.getElementById("btn");
createBtn.addEventListener("click", CreateTask);

function CreateTask()
{
    if (input.value != "")
    {
        if (!show)
        {
            ToggleHideContent();
        }

        const li = document.createElement("li");
        li.textContent = input.value;
        AttachRemoveButton(li);
        listContent.prepend(li);
    
        input.value = "";
    }
}

//Remove Task Button

function AttachRemoveButton(li)
{
    let removeBtn = document.createElement("button");
    removeBtn.className = "remove";
    removeBtn.textContent = "Remove";

    li.appendChild(removeBtn);

}

listContent.addEventListener("click", (event)=>{
    if (event.target.tagName === "BUTTON")
    {
        const button = event.target;
        const li = button.parentNode;
        li.remove();
    }
})

//Hide Button

var hideBtn = document.getElementById("btn-hide");
hideBtn.addEventListener("click", ToggleHideContent);

var show = true;

function ToggleHideContent()
{
    show = !show;
    content.style.display = show ? "inline" : "none";
    hideBtn.textContent = show ? "Hide" : "Show";
}

//Hover on List Items

listContent.addEventListener("mouseover", (event)=>{
    if (event.target.tagName === "LI")
    {
        event.target.style.backgroundColor = "red";
    }
})