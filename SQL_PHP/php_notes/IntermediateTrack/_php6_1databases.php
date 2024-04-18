<!-- Integrating PHP with Databases -->
<!-- https://teamtreehouse.com/library/integrating-php-with-databases -->

<!-- Objects in PHP -->
<?php
    //Access properties and methods from objects with ->
    $mail->subject; //Accesses the subject property on the mail object
    $mail->send(); //Calls the send method on the mail object
?>

<!-- Classess in PHP -->
<?php
    //Access properties and methods from classes with ::
    PDO::ATTR_ERRMODE; //Accesses the ATTR_ERRMODE property on the PDO object
    PDO::setAttribute (); //Calls the setAttribute method on the PDO object
?>

<!-- Create a PDO object to store the database -->
<?php
    $database = new PDO("sqlite:" . __DIR__ . "/database.db");

    // __DIR__ Gets the current directory
    // Input string should be something like sqlite:<directory of database file>
?>

<!-- Connect to Database and Query it -->
<?php
    #region Connect to Database
    //  Use try...catch to catch errors
    try
    {
        $database = new PDO("sqlite:" . __DIR__ . "/database.db");
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e)
    {
        echo "Unable to connect to database";
        echo $e->getMessage(); //Calls the getMessage function on the exception object
        exit;
    }
    #endregion

    #region Query Database
    try
    {
        //Input string is SQL query
        $results = $database->query("SELECT title, category FROM Media");
        echo "Retrieved Results";
    }
    catch(Exception $e)
    {
        echo "Unable to retrieve results";
        exit;
    }
    #endregion

    #region Fetch All

    $results->fetchAll(); //Fetches all results in an array, gets both numeric and associative arrays
    $results->fetchAll(PDO:FETCH_NUM); //Fetches all results in a numeric array
    $results->fetchAll(PDO:FETCH_ASSOC); //Fetches all results in an associative array

    $catalog = ($results->fetchAll(PDO:FETCH_ASSOC));

    #endregion
?>

<!-- Functions for querying database -->
<?php
    function full_catalog_array()
    {
        include("connection.php");

        #region Query Database

        try
        {
            //Input string is SQL query
            $results = $database->query(
                "SELECT media_id, title, category, img
                FROM Media"
            );
            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        #endregion

        $catalog = ($results->fetchAll(PDO:FETCH_ASSOC));
        return $catalog;
    }

    function single_item_array($id)
    {
        include("connection.php");

        #region Query Database

        try
        {
            //Input string is SQL query
            $results = $database->query(
                "SELECT media_id, title, category, img, format, year, genre, publisher, isbn
                FROM Media
                JOIN Genres ON Media.genre_id = Genres.genre_id
                LEFT OUTER JOIN Books ON Media.media_id = Books.media_id
                WHERE Media.media_id = $id"
            );

            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        #endregion

        $catalog = $results->fetch();
        return $catalog;
    }
?>

<!-- Get info on page -->
<?php
    //Include functions
    $catalog = full_catalog_array();

    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
        if (isset($catalog[$id]))
        {
            $item = $catalog[$id];
        }
    }

    if (!isset($item))
    {
        header("location:catalog.php");
        exit;
    }

    $pageTitle = $item["title"];
    $section = null;
?>