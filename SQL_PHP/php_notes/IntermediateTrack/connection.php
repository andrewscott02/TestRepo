<?php
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
?>