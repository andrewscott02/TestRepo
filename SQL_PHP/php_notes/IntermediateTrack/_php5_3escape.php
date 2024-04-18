<!-- Working with $_GET and $_POST in PHP -->
<!-- https://teamtreehouse.com/library/working-with-get-and-post-in-php -->

<!-- Always Escape Outputs
    Output is any data that leaves your application headed for another application or client. For example, adding a record to a database, or outputting information to a web page.

    The goal of escaping output data is to represent data in a way that will not allow it to execute or get interpreted. Without escaping the output it's possible you could accidentally send malicious links to a user's browser, or try to submit data to a database that causes an error, or, even worse, executes malicious SQL.

    The three main functions for escaping HTML data using PHP are:
        * strip_tags() - https://www.php.net/manual/en/function.strip-tags.php
        * htmlspecialchars() - https://www.php.net/manual/en/function.htmlspecialchars.php
        * htmlentities() - https://www.php.net/manual/en/function.htmlentities.php
-->

<!-- strip_tags()
    The strip_tags() function removes all HTML tags except the ones you specify. For example, say you had a form that let a user submit a custom HTML snippet -- like a paragraph of text, with their name, and their photo. This could be part of a custom blogging system that lets users create their own web page.

    You wouldn't however want the user to add links or JavaScript <script> tags, since those could be used to link other users to malicious sites or execute malicious code. In this example, you only want to allow <p> and <img> tags, nothing else.

    Here's where the strip_tags function comes in handy. It takes two arguments:
        * The string to process
        * A string containing the tags you want to allow
-->

<!-- Malicious string -->
<?php
    $str = "<script>alert('You have been hacked!');</script><a href=\"http://bad-web-site.com/\">Click here</a> <p>My name's Sarah. <img src=\"https://picsum.photos/id/1005/5760/3840\" /></p>";
?>

<!-- Escaping the output with strip_tags($str, '<p> <img>''); converts the output -->
<?php
    $str = strip_tags($str, '<p> <img>');
?>

<!-- In this case, both the <script> and <a> tags were removed -->
<p>My name's Sarah. <img src="https://picsum.photos/id/1005/5760/3840" /></p>

<!-- htmlspecialchars() & htmlentities()

    When outputting data that might contain HTML, it's important to encode special characters in order to make sure you don't accidentally add malicious or broken HTML to a page. For example, say you wrote a script that reads a piece of data from a database, and output that data to a web page. If the data retrieved from the database was something like this -- <script>alert('You've been hacked');</script> -- then sending this to a web browser as-is could execute this JavaScript code.

    To prevent something like this (or worse) from happening, you can encode your data so that it won't execute in the browser. That's what the htmlspecialchars() and htmlentities() functions do. You'll use these functions both when outputting data for storage in a database, and when outputting data to a web page.

    Both functions encode, or convert, HTML characters into what are called an HTML "entity." For example, the < and > symbols have a special meaning in HTML since they are used to identify HTML tags. Those characters, when encoded, are converted to &lt; and &gt;

    The htmlspecialchars() function encodes fewer characters -- only the ones that would cause a problem when outputting data to a web page like " & < and >, while htmlentities() encodes every character that has an HTML entity equivalent.

-->

<!-- Use for when you want to display html without executing it, like in code snippets-->

<!-- No escape -->
<?php
    $str = '<body>♠ ♣ ♥</body>';
    echo $str;

    // Source Code:
    // <body>♠ ♣ ♥</body>

    // Browser View:
    // ♠ ♣ ♥
?>

<!-- htmlspecialchars() escape -->
<?php
    $str = '<body>♠ ♣ ♥</body>';
    echo htmlspecialchars($str);

    // Source Code:
    // &lt;body&gt;♠ ♣ ♥&lt;/body&gt;

    // Browser View:
    // <body>♠ ♣ ♥</body>
?>

<!-- htmlentities() escape -->
<?php
    $str = '<body>♠ ♣ ♥</body>';
    echo htmlentities($str);

    // Source Code:
    // &lt;body&gt;&spades; &clubs; &hearts;&lt;/body&gt;gt;

    // Browser View:
    // <body>♠ ♣ ♥</body>
?>

<!-- In general, htmlspecialchars() is a better choice...
    for escaping output most notably when outputting HTML or XML in UTF-8. It encodes fewer characters, handles the most important symbols, and avoids display problems that can appear when using htmlentities().
-->