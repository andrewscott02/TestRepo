<!-- File Handling with PHP -->
<!-- https://teamtreehouse.com/library/file-handling-with-php -->

<!-- Get All Files From Directory -->
<?php
    scandir(); //Returns files in input directory

    $files = scandir("data");

    //Shows all files in list
    echo "<ul>";
    foreach($files as $file)
    {
        if (substring($file, 0, 1) != ".") //Only show if first character isn't a . (this prevents hidden files from displaying)
        {
            echo "<li>$file</li>";
        }
    }
    echo "/<ul>";
?>

<!-- Recursive Function to Get All Files Within Directory -->
<?php
    function GetFiles($directory)
    {
        $files = scandir($directory);

        //Shows all files in list
        echo "<ul>";
        foreach($files as $file)
        {
            if (substr($file, 0, 1) != ".") //Only show if first character isn't a . (this prevents hidden files from displaying)
            {
                echo "<li>";
                if (is_dir($directory . "/" . $file))
                {
                    echo ($file);
                    GetFiles($directory . "/" . $file);
                }
                else
                {
                    echo "<a href='" . $directory . "/" . $file . "'>" . $file . "</a>";
                }
                echo "</li>";
            }
        }
        echo "/<ul>";
    }

    GetFiles(__DIR__);
?>

<!-- Reading files using fopen() -->
<?php
    fopen("data/html/states.html", "r"); //Opens connection to file and returns a file handler
    
    //Same thing as includes, but more control
    if ($fh = fopen("data/html/states.html", "r")) //If we have access
    {
        while(!feof($fh))
        {
            $line = fgets($fh);
            echo $line;
        }

        fclose($fh);
    }
?>

<!-- Reading files using fopen() and manipulating files -->
<?php
    if ($fh = fopen("data/html/states.html", "r")) //Same thing as includes, but more control
    {
        while(!feof($fh))
        {
            $line = fgets($fh);
            //This allows us to have more control over how the file is used
            //compared to includes, ie. we could select a specific option by default
            if (strpos($line, "Oregon"))
            {
                echo str_replace(">Oregon", " selected>Oregon", $line);
            }
            else
            {
                echo $line;
            }
        }

        fclose($fh);
    }
?>

<!-- Reading files into a string or array -->
<?php
    $states = file_get_contents("data/html/territories.html");
    $states_array = file("data/html/armed_forces.html");
?>

<!-- Using different read file methods to generate dropdown -->
<form>
	<label for="country">Country</label>
	<select name="country" id="country">
        <!-- Include read file method -->
		<?php include "data/html/countries.html"; ?>
	</select>

	<label for="state">State</label>
	<select name="state" id="state">
		<?php
            // fnopen() read file method
			if ($fh = fopen("data/html/states.html", "r"))
            {
                while(!feof($fh))
                {
                    $line = fgets($fh);
                    if (strpos($line, "Oregon"))
                    {
                        echo str_replace(">Oregon", " selected>Oregon", $line);
                    }
                    else
                    {
                        echo $line;
                    }
                }

                fclose($fh);
            }

            // file_get_contents() read file method
            echo "<optgroup label='US Outlying Territories'>";
            $states = file_get_contents("data/html/territories.html");
            echo strtolower($states);
            echo "</optgroup>";

            // file() read file method
            echo "<optgroup label='Armed Forces'>";
            $states_array = file("data/html/armed_forces.html");
            foreach ($states_array as $line)
            {
                echo str_replace("Armed Forces ", "", $line);
            }
            echo "</optgroup>";
		?>
	</select>
</form>

<!-- Writing files using fopen() -->
<?php
    fopen("data/html/states.html", "w"); //Opens connection to file for writing
?>

<!-- Writing files using fopen() -->
<?php
    //Warning! Erases file or creates new file

    if ($fh = fopen("data/html/combined.html", "w")) //If we have access
    {
		echo "<h1>Access</h1>";
		
        fwrite($fh, file_get_contents("data/html/states.html"));

        fwrite($fh, PHP_EOL . "<optgroup label='US Outlying Territories'>");
        fwrite($fh, PHP_EOL . file_get_contents("data/html/territories.html"));
        fwrite($fh, PHP_EOL . "</optgroup>");

        fwrite($fh, PHP_EOL . "<optgroup label='Armed Forces'>");
        fwrite($fh, PHP_EOL . file_get_contents("data/html/armed_forces.html"));
        fwrite($fh, PHP_EOL . "</optgroup>");

        fclose($fh);
    }
	else
	{
		echo "<h1>No Access</h1>";
	}

echo "<select>";
include "data/html/combined.html";
echo "</select>";
?>

<!-- Writing files all at once -->
<?php
    $states = array_merge(
        file("data/html/states.html", FILE_IGNORE_NEW_LINES), 
        file("data/html/territories.html", FILE_IGNORE_NEW_LINES), 
        file("data/html/armed_forces.html", FILE_IGNORE_NEW_LINES)
    );

    function CompareStrings($a, $b)
    {
        return strcasecmp(strip_tags($a), strip_tags($b));
    }

    usort($states, "CompareStrings");
    file_put_contents("data/html/combined_sorted.html", implode(PHP_EOL, $states));

    echo "<select>";
    include "data/html/combined_sorted.html";
    echo "</select>";
?>