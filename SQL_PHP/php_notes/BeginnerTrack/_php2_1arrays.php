<!-- PHP Arrays and Control Structures -->
<!-- https://teamtreehouse.com/library/php-arrays-and-control-structures -->


<!-- Negation operators -->
<?php
    $a = 5;
    $b = 6;

    if ($a <> $b)
    {
        //code if a is less than or greater than b
    }

    if ($a != $b)
    {
        //code if a is not equal to b
    }

    if ($a !== $b)
    {
        //code if a is not identical to b
    }
?>

<!-- Conditionals -->
<?php
    $a = 5;
    $b = 6;

    if ($a == $b && $a ==5)
    {
        //code if a is equal to b and a is 5
    }

    if ($a == $b || $a ==5)
    {
        //code if a is equal to b or a is 5
    }

    //Can also use the AND OR keywords instead

    if ($a == $b AND $a ==5)
    {
        //code if a is equal to b and a is 5
    }

    if ($a == $b OR $a ==5)
    {
        //code if a is equal to b or a is 5
    }

    //However, these keywords have a low precedence
    $var1 = true && false; //False
    $var1 = (true && false); //Visualisation

    $var1 = true AND false; //True, because = sign has a higher precedence
    ($var1 = true) AND false; //Visualisation
    $var1 = (true AND false); //Fix by using parenthesis around the expression
?>

<!-- Switch Statements -->
<?php
    switch (date("l"))
    {
        case "Monday":
            echo "Monday one day";
            break;
        case "Tuesday":
            echo "Tuesday two day";
            break;
        case "Wednesday":
            echo "Wednesday when huh what day?";
            break;
        case "Thursday":
            echo "Thursday the third day";
            break;
        default:
            echo "Joey didn't get that far";
            break;
    }
?>

<!-- Admin Check -->
<?php
    //Available roles: admin, editor, author, subscriber
    if (!isset($role))
    {
        $role = 'subscriber';
    }

    //change to switch statement
    switch ($role)
    {
    case "admin":
        echo "As an admin, you can add, edit, or delete any post.";
        break;
    case "editor":
        echo "As an editor, you can add or edit any post, and delete your own posts.";
        break;
    case "author":
        echo "As an author, you can add, edit, or delete your own post.";
        break;
    default:
        echo "You do not have access to this page. Please contact your administrator.";
        break;
    }
?>

<!-- Arrays -->
<?php
    #region Basics

    $arrayVar = array("str1", "str2", "str3");
    var_dump($arrayVar);

    echo $arrayVar[0]; //Outputs first string in value
    //echo $arrayVar; //Array to String Conversion Error
    echo implode("\n", $arrayVar); //Outputs entire array, separated with new lines
    
    #endregion

    #region Adding to array

    $arrayVar[] = "New string value"; //Adds value at end of array
    array_push($arrayVar, "newStr1", "newStr2"); //Add multiple values to end of array
    array_unshift($arrayVar, "newStr1", "newStr2"); //Add multiple values to start of array

    #endregion

    #region Removing from array

    array_pop($arrayVar); //Remove value from end of array
    array_shift($arrayVar); //Remove value from start of array

    //These functions return the removed item
    echo "removed " + array_pop($arrayVar);

    //Removing from specific index
    unset($arrayVar[2]); //Removes 2nd and 3rd items from array

    //NOTE: Unset does not update index of other array items, so you need to use array_values
    $arrayVar = array_values($arrayVar); //Resets the index values of array items

    unset($arrayVar[0], arrayVar[1]); //Removes 1st and 2nd items from array
    $arrayVar = array_values($arrayVar);

    #endregion

    #region Updating Array Items

    $arrayVar[2] = "Updated Value"; //Updates value of 3rd item

    #endregion
?>

<!-- Associative Arrays -->
<?php
    //Can specify your own key values, kind of like a dictionary
    $arrayVar = array("Mark" => 5,
                        "Liz" => 12,
                        "Dave" => 4);

    echo $arrayVar["Mark"];
    echo $arrayVar["mark"]; //Arrays are case-sensitive, this will be null

    $arrayVar["Terry"] = 2; //Adds item to array with key
    $arrayVar["Terry"] = 2; //Will set not add, keys must be unique
    $arrayVar["Mark"] = 2; //Values don't have to be unique
?>

<!-- Multidimensional Arrays -->
<?php
    #region Basics

    $arrayVar1 = array(
        "name" => "Mark",
        "count" => 5);

    $arrayVar2 = array(
        "name" => "Liz",
        "count" => 12);
                        
    $arrayVar3 = array(
        "name" => "Dave",
        "count" => 4);

    $multiArray1 = array($arrayVar1, $arrayVar2, $arrayVar3);

    echo $multiArray1[1]["name"]; //Should echo Liz

    #endregion

    #region Alternate method of creating a multidimensional array

    $multiArray2[] = array(
        "name" => "Mark",
        "count" => 5);

    $multiArray2[] = array(
        "name" => "Liz",
        "count" => 12);
                        
    $multiArray2[] = array(
        "name" => "Dave",
        "count" => 4);

    #endregion

    #region [] Shorthand

    $multiArray3[] = [
        "name" => "Mark",
        "count" => 5
    ];

    $multiArray3[] = [
        "name" => "Liz",
        "count" => 12
    ];
                        
    $multiArray3[] = [
        "name" => "Dave",
        "count" => 4
    ];

    #endregion
?>

<!-- Multidimensional Arrays Challenge -->
<?php
    //edit this array
    $contacts[] = ["name" => 'Alena Holligan', "email" => "alena.holligan@teamtreehouse.com"];
    $contacts[] = ["name" => 'Dave McFarland', "email" => "dave.mcfarland@teamtreehouse.com"];
    $contacts[] = ["name" => 'Treasure Porth', "email" => "treasure.porth@teamtreehouse.com"];
    $contacts[] = ["name" => 'Andrew Chalkley', "email" => "andrew.chalkley@teamtreehouse.com"];
    echo "<ul>\n";

    //$contacts[0] will return 'Alena Holligan' in our simple array of names.
    echo "<li>" . $contacts[0]['name'] . " : " . $contacts[0]['email'] . "</li>\n";
    echo "<li>" . $contacts[1]['name'] . " : " . $contacts[1]['email'] . "</li>\n";
    echo "<li>" . $contacts[2]['name'] . " : " . $contacts[2]['email'] . "</li>\n";
    echo "<li>" . $contacts[3]['name'] . " : " . $contacts[3]['email'] . "</li>\n";
    echo "</ul>\n";
?>

<!-- Sorting Arrays -->
<?php 
    #region Sorting By Values

    $arrayVar = ["Value", "Add", "Subtract"];
    echo implode(" | ", $arrayVar);
    echo("\n");

    asort($arrayVar); //Sorts in ascending order (alphabetically in this case)
    echo implode(" | ", $arrayVar);
    echo("\n");

    rsort($arrayVar); //Sorts in reverse order
    echo implode(" | ", $arrayVar);
    echo("\n");

    shuffle($arrayVar); //Sorts in random order
    echo implode(" | ", $arrayVar);
    echo("\n");

    #endregion

    #region Sorting By Keys

    $arrayVar = array("Mark" => 5,
                        "Liz" => 12,
                        "Dave" => 4);

    //Will not work if array contains both named and numeric keys 
    ksort($arrayVar); //Sorts by key in ascending order
    echo implode(" | ", $arrayVar);
    echo("\n");

    //Will not work if array contains both named and numeric keys 
    krsort($arrayVar); //Sorts by key in reverse order
    echo implode(" | ", $arrayVar);
    echo("\n");

    #endregion
?>