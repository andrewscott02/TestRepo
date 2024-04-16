<!-- PHP Arrays and Control Structures -->
<!-- https://teamtreehouse.com/library/php-arrays-and-control-structures -->

<!-- While Loops -->
<?php

    $currentYear = date("Y");
    $year = $currentYear - 100;

    //While loop
    while(++$year <= $currentYear)
    {
        echo $year . "<br />\n";
    }

    $year = $currentYear - 100;

    //Do...While loop
    do
    {
        echo $year . "<br />\n";
    } while(++$year <= $currentYear)
?>

<!-- Each Loop -->
<?php
    $arrayVar = array("str1", "str2", "str3", "str4", "str5");
    
    while(list($key, $val) = each($arrayVar))
    {
        echo("$key is $val\n");
    }

    //Combine with sort or shuffle functions and only show top 3 values
    shuffle($arrayVar);
    while((list($key, $val) = each($arrayVar)) && ($count++ < 3))
    {
        echo("$key is $val\n");
    }
?>

<!-- Ping Pong Game -->
<?php
    $player1 = 0;
    $player2 = 0;
    $round = 0;

    while(abs($player1- $player2) < 2 || ($player1 < 11 && $player2 < 11))
    {
        $round++;
        echo "<h2>Round $round</h2>\n";
        if (rand(0, 1))
        {
            $player1++;
        }
        else
        {
            $player2++;
        }
        echo "Player 1 = $player1<br />\n";
        echo "Player 2 = $player2<br />\n";
    }

    echo "<h1>";

    if ($player1 > $player2)
    {
        echo "Player 1 wins";
    }
    else
    {
        echo "Player 2 wins";
    }
    echo "</h1>\n";

?>

<!-- For Loops -->
<?php
    for(/* First Expression (At start of loop) */;
        /*Conditional Expression (Evaluates at beginning of each iteration)*/;
        /*Third Expression (At end of each iteration*/)

    for($i = 0; $i <= 5; $i++)
    {
        echo("index is $i\n");
    }

    //Refactoring year function above
    for($currentYear = date("Y"), $i = $currentYear - 100;
    $i <= $currentYear; $i++)
    {
        echo $year . "<br />\n";
    }

    $arrayVar = array("str1", "str2", "str3", "str4", "str5");
    
    for($i = 0; $i <= count($arrayVar); $i++)
    {
        echo("$i is $arrayVar[$i]\n");
    }
?>

<!-- For Eachs Loops -->
<?php
    $arrayVar = array("str1", "str2", "str3", "str4", "str5");

    foreach ($arrayVar as $item)
    {
        echo("Item is $item\n");
    }

    //Gets the key associated with the items (index in this case)
    foreach ($arrayVar as $key => $item)
    {
        echo("Item $key is $item\n");
    }
?>

<!-- Todo List -->
<?php
    include 'list.php';
    
    $status = "all";
    $field = "priority"; //Sort by title, priority, due or complete
    $filter = [];

    foreach ($list as $originalKey => $item)
    {
        if ($item["complete"] == $status || $status === "all")
        {
            if (isset($field) && isset($item[$field]))
            {
                $filter[$originalKey] = $item[$field];
            }
            else
            {
                $filter[$originalKey] = $item["priority"] + 12;
            }
        }
        echo $key . '=' . $item['title'] . "<br />\n";
    }

    asort($filter);

    echo '<table>';
    echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Priority</th>';
    echo '<th>Due Date</th>';
    echo '<th>Complete</th>';
    echo '</tr>';
    foreach ($filter as $id => $value)
    {
        echo '<tr>';
        echo '<td>' . $list[$id]['title'] . "</td>\n";
        echo '<td>' . $list[$id]['priority'] . "</td>\n";
        echo '<td>' . $list[$id]['due'] . "</td>\n";
        echo '<td>';

        if ($list[$id]['complete'])
        {
            echo 'Yes';
        }
        else
        {
            echo 'No';
        }

        echo "</td>\n";
        echo '</tr>';
    }
    echo '</table>';
?>