// Object-Oriented JavaScript (https://teamtreehouse.com/library/objectoriented-javascript-2)

//#region Object Literals

const objectLiteral = {
    //Declaring properties
    property1: "value",
    property2: 5,
    property3: false,

    //Declaring methods
    methodName: ()=>{
        //Code here
        console.log(this.property1);
    }
}

//Dot Notation
objectLiteral.property1; //Get
objectLiteral.property2 = 9; //Set
objectLiteral.methodName(); //Call methods from objects

objectLiteral.newProperty1 = "blue"; //Adds a new property called newProperty1

//Bracket Notation
objectLiteral["property1"]; //Get
objectLiteral["property2"] = 9; //Set
objectLiteral["methodName"](); //Call methods from objects

objectLiteral["newProperty2"] = "blue"; //Adds a new property called newProperty2

var prop = "breed";//This allows you to use variables to access properties
objectLiteral[prop]; //Useful for dynamic properties

//#endregion

//#region Classes

class Character
{
    constructor(x, y, size, speed, target = 0)
    {
        this.x = x;
        this.y = y;
        this.size = size;
        this.speed = speed;
        this.target = target;
    }

    get activity()
    {
        const today = new Date();
        const hour = today.getHours();

        if (hour > 8 && hour <= 20)
        {
            return "playing";
        }
        else
        {
            return "sleeping";
        }
    }

    get owner()
    {
        return this._owner;
    }

    set owner(owner)
    {
        this._owner = owner;
        console.log("setter called: " + owner);
    }

    get movement()
    {

    }

    tick()
    {
        console.log(this.target);
        //Code here for moving and rendering to the canvas
    }
}

const player = new Character(0, 40, 10, 25);
const stdEnemy = new Character(0, 0, 15, 1);
const fastEnemy = new Character(0, 0, 5, 1.5);
const slowEnemy = new Character(0, 0, 25, 0.5);

//#endregion

//#endregion