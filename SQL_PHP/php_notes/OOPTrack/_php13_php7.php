<!-- Introduction to PHP7 -->
<!-- https://teamtreehouse.com/library/introduction-to-php7 -->

<!-- Type Declarations -->
<?php
    //Requires specific inputs
    function Adder(int $a, int $b) : int // Specifies return type as well
    {
        return $a + $b;
    }

    echo Adder(5, 4); //Returns 9
    echo Adder(5, "4"); //Returns 9 (string is converted to an int)
    echo Adder(5, 4.5); // Returns 9 (4.5 is converted to 4)
?>

<?php

    //At top of file
    declare(strict_types=1); //Sets how strict type declarations are
    function Adder(int $a, int $b) : int
    {
        return $a + $b;
    }

    function AnyAdder($a, $b) : int
    {
        return int($a + $b); //May need to cast when input is not specified
    }

    echo Adder(5, 4); //Returns 9
    echo Adder(5, "4"); // Throws error, "4" is not an int
    echo Adder(5, 4.5); // Throws error, 4.5 is not an int
?>

<!-- Important notes with declare(strict_types=1)
    * Strict is enabler per file, not a php.ini setting
    * Strict applies to the file the call is made, not where the function is defined
    * Ints wil be "widened" into floats by adding .0
-->

<!-- New Operators -->
<?php
    #region Spaceship Operator <=>

    //Spaceship operator <=> checks each operator individually

    $compare = 2 <=> 1;

    //If 2<1 returns -1
    //If 2=1 returns 0
    //If 2>1 returns 1

    //This operator can be used when sorting

    #endregion

    #region Null Coalesce Operator

    //If first name is not null, it will assign the value from $firstName
    //Else it sill set guest
    $name = $firstName ?? "Guest";

    //Can stack multiple null coalesce operators
    $name = $firstName ?? $username ?? $placeholder ?? "Guest";

    #endregion
?>

<!-- CSPRNG - Cryptographically secure pseudorandom number generator -->
<?php
    //Generates secure random numers

    $bytes = random_bytes(5); //Length in bytes

    //Generates random int in range
    $randInt = random_int(1, 20); //Includes 1 and 20
?>