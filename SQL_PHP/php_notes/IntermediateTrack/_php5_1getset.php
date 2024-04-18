<!-- Working with $_GET and $_POST in PHP -->
<!-- https://teamtreehouse.com/library/working-with-get-and-post-in-php -->

<!-- The $_GET superglobal
    The $_GET superglobal is populated with information from the URL, in the form of a query string. You'll often build pages that use the information to display custom content to a user. For example, you could build a PHP website that displays profiles for different users. The user's profile name is sent along in the query string like this: http://localhost:8080/index.php?name=jonathan

    A query string starts with a ? and the $_GET superglobal grabs this URL fragment name=jonathan. The page's PHP code would use this information to display a profile page for Jonathan.

    A query string can include multiple parameters, like this: http://localhost:8080/index.php?name=jonathan&lang=php. This query string includes two items -- name=jonathan & lang=php. An & separates the query string variables.
-->

<body>
<!-- Ensure get method is set to index.php -->
<form method="get" action="index.php">
    <input type="text" name="name">
    <input type="text" name="lang">
    <input type="submit" value="submit">
</form>

<!-- Captures data from form and places it in <p> tags -->
<?php
    //Use if statement to check values have been set
   if (isset($_GET['name'], $_GET['lang']))
    {
        $name = $_GET['name'];
        $lang = $_GET['lang'];
        echo $name . '<br>'; 
        echo $lang;
    }
?>
</body>
<!-- Place wthin the <body> tags -->

<!-- Issues with $_Get
    While this behavior is useful, using query strings also pose a security vulnerability. Some of the implications of using the GET method with a form are:

    * A security risk because the query string is visible
    * Query strings can be modified easily and by anyone
    * You can only submit a limited amount of information in a query string, so they're not useful for lots of information such as a blog post.
    * Query strings and the $_GET superglobal are most useful for sending information that affects the content and presentation on a web page. For example, sending a product ID to a product page to present specific information on a single product.

-->

<?php
    if(isset($_GET['name']))
    {
        $name = $_GET['name']; 
    }

    function greeting()
    {
        if(isset($_GET['name']))
        {
            $name = $_GET['name']; 
            echo "Hello, " . $name;
        }
    }
    greeting(); 
?>

<!-- The $_POST superglobal
    The $_POST superglobal sends data to a server in the message body and is not displayed in the URL with a query string like the $_GET superglobal. The $_POST variable data is saved in an array called $_POST which allows you to use $_POST['name'] and $_POST['lang'] superglobal variables respectively. All you need to do is change $_GET to $_POST, like this:
-->

<body>
    <!-- Use post to sent data in body, not header -->
    <form method="post" action="index.php">
        <input type="text" name="name">
        <input type="text" name="lang">
        <input type="submit" value="submit">
    </form>

    <?php
        if (isset($_POST['name'], $_POST['lang']))
        {
            $name = $_POST['name'];
            $lang = $_POST['lang'];
            echo $name . '<br>'; 
            echo $lang;
        }
    ?>
</body>