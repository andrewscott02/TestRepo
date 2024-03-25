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

        listContent.insertAdjacentHTML
        (
            "afterbegin",
            `<li>${input.value}</li>`
        );
    
        input.value = "";
    }
}

//Remove Task Button

var removeBtn = document.getElementById("btn-remove");
removeBtn.addEventListener("click", RemoveTask);

function RemoveTask()
{
    if (!show)
    {
        ToggleHideContent();
    }

    const lastItem = listContent.querySelector("li:last-child");

    lastItem.remove();
}

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