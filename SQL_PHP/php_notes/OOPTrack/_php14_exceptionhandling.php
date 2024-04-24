<!-- Basic Exception Handling with PHP -->
<!-- https://teamtreehouse.com/library/basic-exception-handling-with-php -->

<!-- Recap on exceptions using try...catch -->
<?php
    try
    {
        $db = new PDO("sqlite:" . __DIR__ . "/database.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e)
    {
        echo "Unable to connect to database";
        echo $e->getMessage(); //Calls the getMessage function on the exception object
        exit;
    }
?>

<!-- Disable errors in production -->
<?php
    //Don't display errors in production servers as this can cause security concerns
    ini_set("display_errors", "Off");
?>

<!-- Setting up our own exceptions -->
<?php
    error_reporting(1); //Only displays fatal errors

    try
    {
        if (!$file = fopen("data.txt", "r"))
        {
            throw new Exception("Unable to access file");
        }
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
?>

<!-- Refactor using OOP principles -->
<?php
    error_reporting(1); //Only displays fatal errors

    class DataClass
    {
        function getData()
        {
            if (!$file = fopen("data.txt", "r"))
            {
                throw new Exception("Unable to access file");
            }
        }
    }
    
    $data = new DataClass();

    try
    {
        $data->getData();
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
?>

<!-- Converting errors to exception -->
<?php
    ini_set("display_errors", "Off");

    function exception_error_handler($severity, $message, $file, $line)
    {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    set_error_handler("exception_error_handler");

    try
    {
        strpos();
    }
    catch(Exception $e)
    {
        echo "ERROR! " . $e->getMessage();
    }
?>

<!-- Setting up a default exception handler -->
<?php
    ini_set("display_errors", "Off");

    set_exception_handler("exception_handler");

    function exception_handler($e)
    {
        echo "Uncaught exception: " . $e->getMessage();
    }

    echo 10/0;
?>