<!-- PHP Standards and Best Practices -->
<!-- https://teamtreehouse.com/library/php-standards-and-best-practices -->

<!-- Choosing a Database Extension -->
mysqli - https://www.php.net/mysqli
pdo - https://www.php.net/pdo

<!-- Reccommend using PDO if you're unsure -->

<!-- Working with DateTime -->
<?php
    $date = new DateTime("2014, August 23");
    $date = new DateTime("2014-09-12");

    //Convert unsupported format to supported format
    $unsupportedDate = "10. 11. 1968";
    $date = DateTime::createFromFormat("d. m. Y", $unsupportedDate);

    echo $date->format("d/m/Y");
?>

<!-- Comparing Dates -->
<?php
    $a = new DateTime("2016-08-15");
    $b = new DateTime("2014-09-12");

    if ($a > $b)
    {
        echo "A is older";
    }
    else
    {
        echo "B is older";
    }

    $diff = $a->diff($b);
    echo $diff->format("There are %y years, %m months and %d days between the dates");
?>

<!-- Understanding Time Zones -->
<?php
    /** Important Notes on Time Zones
     * Not all time-zones are exactly 1 hours + or - UTC
     * Not all time-zones have daylight savings time
     * Political events can cause timezones to change their offset
    */

    //From UTC to Local
    $utcDateTime = new DateTime("2016-08-15", new DateTimeZone("UTC"));

    $localDateTime = clone $utcDateTime;
    $localDateTime->setTimeZone(new DateTimeZone("America/New_York"));

    echo $utcDateTime->format("d/m/Y H:i:s");
    echo "\n";
    echo $localDateTime->format("d/m/Y H:i:s");

    //From Local to UTC
    $localDateTime = new DateTime("2016-08-15", new DateTimeZone("America/New_York"));

    $utcDateTime = clone $localDateTime;
    $utcDateTime->setTimeZone(new DateTimeZone("UTC"));

    echo $utcDateTime->format("d/m/Y H:i:s");
    echo "\n";
    echo $localDateTime->format("d/m/Y H:i:s");
?>

<!-- Understanding UTF-8 -->
<?php
    //Get info on installed modules in browser - Check mbstring is listed and enabled
    // phpinfo();
    // exit;

    //UTF-8 preserves special characters, like accents
    //mbstring preserves functionality of string functions with accented characters

    mb_internal_encoding("UTF-8");
    mb_http_output("UTF-8");

    $string = "String is converted to utf-8 characters - é";

    header("Contend-Type: text/html: charset=utf-8");

    echo strtoupper($string) . "\n"; //Will not properly convert accented characters in upper case
    echo mb_strtoupper($string) . "\n"; //Properly converts strings as upper case

    echo strlen($string) . "\n";
    echo mb_strlen($string) . "\n";

    //mbstring replaces more string functions, just use mb_ in front
?>