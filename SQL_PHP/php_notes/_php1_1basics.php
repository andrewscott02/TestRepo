<!-- PHP Basics -->
<!-- https://teamtreehouse.com/library/php-basics-2 -->

<!-- Hello world programming -->
<?php
    echo "Hello World!";
?>

<!-- Comments -->
<?php
    //This is a comment
    echo "Hello World!"; //Comment

    /*
    This is a multi-line comment
    */

    /**
     * This is a multi-line comment
     */
?>

<!-- Number Variables -->
<?php

    /*Variables cannot start with numbers, the following is invalid
    $1stVariable;
    */

    #region Integers

    $int_one = 1;
    $int_two = 2;
    $int_three = 3;

    //Var dump returns the type and value of the input
    var_dump($int_one);
    var_dump(1);
    var_dump("1");
    var_dump($int_one + $int_two - $int_three);

    #endregion

    #region Floats

    $float_one = 1.2;
    $float_two = 2.5;

    var_dump($float_one + $float_two + $int_one); //Can still add ints
    var_dump($float_one + $float_two + 0.3); //Will still be a float, even if it is a whole number

    #endregion

    #region Basic Arithmetic

    $a = 5;
    $b = 10;

    //Multiply and Divide
    var_dump($a * $b);
    var_dump($a / $b);

    //Increment
    $a++;
    $a += 5;
    var_dump($a);

    //Decrement
    $a--;
    $a -= 5;
    var_dump($a);

    //Order of Increments and Decrements
    var_dump(5++); //Returns 5, then increments 5 to 6
    var_dump(++5); //Increments 5 to 6, then returns 6

    #endregion
?>

<!-- Unit Conversion Tool -->
<?php
    #region pounds to kilograms

    $pounds = 140;

    $lb_to_kg = 0.453592;

    $kilograms = $pounds * $lb_to_kg;

    echo "Weight: ";
    echo $pounds;
    echo " lb = ";
    echo $kilograms;
    echo " kg";

    #endregion

    #region miles to kilometers

    $miles = 2.5;

    $miles_to_km = 1.60934;

    $kilometers = $miles * $miles_to_km;

    echo "Distance: ";
    echo $miles;
    echo " miles = ";
    echo $kilometers;
    echo " kilometers";

    #endregion
?>

<!-- String Variables -->
<?php
    #region String Basics

    $name = "Paul"
    $stringVar = 'Hello $name'; //Variables do not get expanded in single quotes
    $stringVar = "Hello $name"; //Variables only get expanded in double quotes
    echo $stringVar;

    #endregion

    #region Escape Sequences

    $stringVar = "Hello \$name"; //Use \ to escape and interpret $ as is
    $stringVar = "Learning to display \"Hello $name\" to the console.";
    echo $stringVar;

    // Use \n to add a new line
    $stringVar = "Learning to display \"Hello $name\" to the console.\n";
    echo $stringVar;

    #endregion

    #region String Concatenation

    $stringOne = "One";
    $stringTwo = "Two";
    $stringConcat = $stringOne . $stringTwo;
    $stringConcat = $stringOne . " " . $stringTwo;

    $stringVar = "Learning to display \"Hello $name\" to the console.\n";
    $stringVar = `Learning to display "Hello ` . $name . `!" to the console.` . "\n";

    //Can display over multiple lines like this
    $stringVar = `Learning to display`
        . `"Hello `
        . $name
        . `!" to the console.`
        . "\n";

    //Or like this
    $stringVar = `Learning to display`
    $stringVar.= `"Hello `
    $stringVar.= $name
    $stringVar.= `!" to the console.`
    $stringVar.= "\n";

    echo(stringVar);

    #endregion
?>

<!-- Boolean Variables -->
<?php
    #region Boolean Basics

    $boolVar = true;
    $boolVar = false;

    var_dump(1 + "2");
    $a = 10;
    $b = "10";
    var_dump($a == $b); //True: values are the same even if types aren't
    var_dump($a === $b); //False: types are not strictly equal

    #endregion
    
    #region Conditional Statements

    $name = "Paul";
    $stringVar = "Learning to display \"Hello $name\" to the console.\n";

    if($stringVar == `Learning to display "Hello Paul" to the console.`)
    {
        echo "Values match";
    }
    elseif ($stringVar == "")
    {
        echo "String is empty";
    }
    else
    {
        echo "Values do not match";
    }

    #endregion
?>

<!-- Daily Exercise Program -->
<?php
    #region Exercises

    $exercise1 = "One";
    $exercise2 = "Two";
    $exercise3 = "Three";
    $exercise4 = "Four";
    $exercise5 = "Five";

    #endregion

    $day = date("N"); //Gets the date in a numeric representation (1-7)

    if ($day == 1)
    {
        echo $exercise1;
    }
    elseif ($day == 2)
    {
        echo $exercise2;
    }
    elseif ($day == 3)
    {
        echo $exercise3;
    }
    elseif ($day == 4)
    {
        echo $exercise4;
    }
    elseif ($day == 5)
    {
        echo $exercise5;
    }
    else
    {
        echo "It's the weekend";
    }
?>