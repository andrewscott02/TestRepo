<!-- PHP Standards and Best Practices -->
<!-- https://teamtreehouse.com/library/php-standards-and-best-practices -->

<!-- Namespaces -->
<?php
    //Declare namespace
    namespace MyNamespace;

    function MyFunction()
    {
        echo "Hello world!";
    }
?>

<?php
    //Declare namespace
    namespace MyNamespace1;

    function MyFunction()
    {
        echo "Hello world from second namespace!";
    }
?>

<?php

    include './MyNamespace.php';
    include './MyNamespace1.php';

    MyNamespace\MyFunction();
    MyNamespace1\MyFunction();

?>

<!-- Autoloader -->
<?php //bootstrap.php file

    spl_autoload_register(function ($class)
    {	
        $CLASSpATH = str_replace("\\", "/", $class);
        include __DIR__ . "/src/" . $classPath . ".php";
    });

?>

<?php

    //Change includes
    include './bootstrap.php';

    MyNamespace\MyFunction();
    MyNamespace1\MyFunction();

?>