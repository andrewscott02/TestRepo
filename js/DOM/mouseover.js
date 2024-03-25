const heading = document.querySelector("h1");

const rawContent = heading.textContent;

heading.addEventListener("mouseover", ()=>
{
    heading.textContent = rawContent.toUpperCase();
})

heading.addEventListener("mouseout", ()=>
{
    heading.textContent = rawContent;
})