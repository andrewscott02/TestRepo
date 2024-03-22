const main = document.querySelector("main");
let html = "";

for (let i = 1; i <= 10; i++)
{
    html += `<div style="background-color:${GetRandomColour()}">${i}</div>`;
}

main.innerHTML = html;

function GetRandomColour()
{
    randomRGB = MakeColour(GetRandomColourValue(),
                            GetRandomColourValue(),
                            GetRandomColourValue())
    return randomRGB;
}

function MakeColour(red, green, blue)
{
    return `rgb(${red}, ${green}, ${blue})`;
}

function GetRandomColourValue()
{
    return Math.floor(Math.random() * 256);
}