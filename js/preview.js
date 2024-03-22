const name = prompt("What is your name?");

if (name != null)
{
  alert(`Hi, ${name}. Want to see something cool?`);
  document.querySelector('h1').innerHTML = `
    Welcome to ${name}'s site!
    <img src="https://media.giphy.com/media/JIX9t2j0ZTN9S/giphy.gif">
  `;
}