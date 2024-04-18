<!-- Browser Persistent Data with PHP -->
<!-- https://teamtreehouse.com/library/browser-persistent-data-with-php -->

<!-- Types of Persistence -->
<!-- 
    * Reccomendations
    * Locations
    * Managing shopping cart
    * Sensitive data (passwords/emails)
    * Tracking data through multiple pages
-->

<!-- Using Forms for Persistence -->
<?php
    $total = 5;
    $page = filter_input(INPUT_GET, "p", FILTER_SANITIZE_NUMBER_INT);
    if (empty($page))
    {
        $page = 1;
    }

    if ($page > $total)
    {
        header('location: story.php');
        exit;
    }

    //Replace get with post for pages
    // echo '<form method="get" action="play.php?=' . ($page+1) . '">';
    echo '<form method="post" action="play.php?=' . ($page+1) . '">';
?>

<!-- Using Sessions to Track Data -->
<!-- Sessions terminate on browser close or timeout (default is 24 minutes) -->
<?php
    session_start(); //Starts the session, do before anything is outputted to the browser

    if (isset($_POST["word"]))
    {
        $_SESSION["word"][$page-1] = filter_input(INPUT_POST, "word", FILTER_SANITIZE_STRING);
    }

    if (empty($page))
    {
        $page = 1;
        session_destroy(); //Destroy all saved data when loading first page
    }
?>

<!-- Changes to story.php -->
<?php
    session_start();

    if (!isset($_SESSION["word"]))
    {
        //Redirect if word array is not set
        header('location:play.php');
        exit;
    }
    else
    {
        for($i = 1; $i <= count($_SESSION["word"]); $i++)
        {
            $_SESSION["word"][$i] = trim($_SESSION["word"][$i]); //Removes whitespace at start and end of string
            if (empty($_SESSION["word"][$i]))
            {
                //Redirect if any of the words are not set
                header('location:play.php?p=' . $i);
                exit;
            }
        }
    }
    
    $word1 = htmlspecialchars($_SESSION["word"][1]);
    $word2 = htmlspecialchars($_SESSION["word"][2]);
    $word3 = htmlspecialchars($_SESSION["word"][3]);
    $word4 = htmlspecialchars($_SESSION["word"][4]);
    $word5 = htmlspecialchars($_SESSION["word"][5]);

    // Check that the session variables are valid
?>

<!-- Saving Stories with Cookies -->
<?php
    session_start();
	
	if (isset($_GET["save"]))
	{
		$name = urlencode($_SESSION["word"][2]) . time();
		setcookie($name, implode(":", $_SESSION["word"]), strtotime("+30 days"), "/");
		header("location:/index.php");
		exit;
	}

    // Change save story button iun story.php
    echo ' <a class="btn btn-default btn-lg" href="inc/cookie.php?save" role="button">Save Story</a>';
?>

<!-- Reading and Deleting Cookies (index.php) -->
<?php
    if (isset($_COOKIE))
    {
        foreach($_COOKIE as $key => $value)
        {
            if ($key != "PHPSESSID")
            {
                echo "<div class='form-group'>";
                echo
                    "<a class='btn btn-info' href='inc/cookie.php?read="
                    . urlencode($key)
                    . "'>";
                echo 
                    substr($key, 0, -10)
                    . " "
                    . date("d M Y H:i:s", (int)substr($key, -10));
                echo "</a>";
                echo "</div>";
            }
        }
    }
?>

<!-- Reading and Deleting Cookies (cookie.php) -->
<?php
    if (isset($_GET["save"]))
	{
		$name = urlencode($_SESSION["word"][2]) . time();
		setcookie($name, implode(":", $_SESSION["word"]), strtotime("+30 days"), "/");
	}
	elseif (isset($_GET["read"]))
	{
		$_SESSION["word"] = array_combine(range(1, 5), explode(":", $_COOKIE[$_GET["read"]]));
		header("location:/story.php");
		exit;
	}
	elseif (isset($_GET["delete"]))
	{
        setcookie($_GET['delete'], "", time() - 3600, '/');
	}

    header("location:/index.php");
    exit;
?>