<!-- PHP Functions -->
<!-- https://teamtreehouse.com/library/php-functions-2 -->

<!-- Functions Basics -->
<?php
    #region Basics

    function CustomFunction()
    {
        echo "Hello World!";
    }

    CustomFunction();

    #endregion

    #region Accessing values in functions using global scope

    $currentUser = "Mike";

    function IsMike()
    {
        global $currentUser; //Need to set global variable to access a variable outside the function scope
        if ($currentUser == "Mike")
        {
            echo "Is Mike";
        }
        else
        {
            echo "Is not Mike";
        }
    }

    IsMike();

    #endregion

    #region Accessing values in functions using arguments

    function IsMikeArg($currentUser)
    {
        if ($currentUser == "Mike")
        {
            echo "Is Mike";
        }
        else
        {
            echo "Is not Mike";
        }
    }

    IsMikeArg("Mike");
    IsMikeArg("Bob");

    #endregion
?>

<!-- Function Arguments -->
<?php
    function Hello($name = "friend", $time = null)
    {
        if (is_array($name))
        {
            foreach ($name as $name)
            {
                echo "Hello, $name?\n";
            }
        }
        else
        {
            if ($time)
            {
                echo "Hello $name, good $time!\n";
            }
            else
            {
                echo "Hello $name, whassup!";
            }
        }
    }

	Hello("Mike");
	Hello(["Sal", "Bob"]);

	Hello();
	Hello("Mike", "Morning");
	//Hello($time: "Morning");
?>

<!-- Function Return Values -->
<?php
    #region Basics

    function IsMike($name = "friend")
    {
        if ($name == "Mike")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

	echo IsMike("Mike");

    #endregion

    #region Basic Add Function

    function add($a, $b)
    {
        return $a + $b;
    }

    echo add(5, 2);

    #endregion

    #region Add Function with Multiple Returns

    function add_w_args($a, $b)
    {
        $args = [$a, $b, "Sum" => $a + $b];
        return $args;
    }

    echo implode(" | ", add_w_args(5, 2));
    echo "\n";
    print_r(add_w_args(5, 2));
    echo "\n";

    echo add_w_args(5, 2)[0];
    echo "\n";

    echo add_w_args(5, 2)["Sum"];
    echo "\n";

    #endregion

    #region Update Hello Function

    function Hello($name = "friend", $time = null)
    {
        if (is_array($name))
        {
            foreach ($name as $name)
            {
                return "Hello, $name?\n";
            }
        }
        else
        {
            if ($time)
            {
                return "Hello $name, good $time!\n";
            }
            else
            {
                return "Hello $name, whassup!";
            }
        }
    }

	echo Hello("Mike");
	echo Hello(["Sal", "Bob"]);

	echo Hello();
	echo Hello("Mike", "Morning");

    #endregion
?>

<!-- Functions as Variables -->
<?php
    function CustomFunction($name = "World")
    {
        echo "Hello $name!";
    }

    $funcVar = 'CustomFunction';
    $funcVar();
    $funcVar("Chris");
?>

<!-- Closures -->
<?php
    $name = "friend";

    $funcClosure = function() use($name){
        echo "Hello $name!";
    };

    $funcClosure();
?>

<!-- String Functions -->
<?php
    //Get string length
    echo strlen("Hannah"); //Should echo length of string (6)

    //Gets part of the string, based on given indexes
    echo substr("Hannah", 0, 2); //Should echo Han
    echo substr("Hannah", 1, 3); //Should echo ann
    echo substr("Hannah", 2); //Should echo nnah
    //Spaces count
    echo substr("Han nah", 2, 4); //Should echo n na

    //Get index of string within string
    echo strpos("Can find index of specific string within string", "find"); //Should return 5

    //Combining functions
    $phrase = "Can find index of specific string within string"
    $stringIndex = strpos($phrase, "specific");
    echo substr(phrase, &stringIndex);
?>

<!-- Array Functions -->
<?php
    #region array_keys
    //Get keys of array (both numeric and string)

    $names = [
        "Mike" => "Frog",
        "Chris" => "Teacher",
        "Hamptom" => "Teacher"
    ];

    var_dump(array_keys($names));

    foreach(array_keys($names) as $key)
    {
        echo "Hello, $key!\n";
    }

    #endregion

    #region array_walk
    //Calls a function based on every item in the array

    $names = [
        "Mike" => "Frog",
        "Chris" => "Teacher",
        "Hamptom" => "Teacher"
    ];

    function print_info($value, $key)
    {
        echo "$key is a $value.\n";
    }

    array_walk($names, "print_info");

    #endregion

    #region array_combine
    //Combines 2 arrays, using the values in one as the keys and values in the other as values

    $name = ['hampton', 'charley'];
    $fav_food = ['sushi', 'mac and cheese'];
    $result = array_combine($name, $fav_food);

    //result should be ["hamptom" => "sushi", "charley" => "mac and cheese];

    #endregion
?>