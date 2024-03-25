//#region Objects - Creating an Object Literal

const person = 
{
    name: "Quincy",
    city: "London",
    age: 37,
    isStudent: true,
    skills: ["Javascript", "HTML", "CSS"]
};

//#endregion

//#region Objects - Accessing Object Variables

person.name;
person.name = "Helen";

const message = `Hi, I'm ${person.name}. I have ${person.skills.length} skills: ${person.skills.join(", ")}.`;
alert(message);
//#endregion

person.nickname = "Tank"; //You can even add properties that weren't declared before

for (let item in person)
{
    alert(`${[item]}: ${person[item]}`)
}