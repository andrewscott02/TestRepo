<!-- Working with $_GET and $_POST in PHP -->
<!-- https://teamtreehouse.com/library/working-with-get-and-post-in-php -->

<!-- The filter_input() function
    The filter_input() function filters and validates external variables coming from insecure sources, such as input forms. This function is commonly used to prevent some security threats like SQL Injection(SQLi) attacks.
-->

<!-- Imagine this is the url
    http://yourdomain.com/index.php?name=<a href="https://google.com">Click Me</a>
-->

<!-- Using this with the above link would add a button, 
which is not what we want and poses a security risk -->
<?php
    //We expect the name to be a string of a name
    //but what stops someone from putting html?
    //ie name=<a href="https://google.com">Click Me</a>
    echo $_GET[‘name’];
?>

<!-- 
    The above example would output a link to Google -- this is harmless. However, you can imagine a link to a phishing site, or a link that executes a malicious script. To avoid input that could lead to improper links or executing malicious code, you should filter all input with the filter_input() function like this:
-->

<?php
    //Removes all tags and only returns the string
    //In this case, it would contain the string Click Me
    echo filter_input(INPUT_GET, ‘name’, FILTER_SANITIZE_STRING );
?>

<!-- 
    filter_input() provides added security by stripping or filtering code or malicious scripts from the query string. You should always filter inputs.
-->

<!-- The PHP filter_input() function accepts three arguments:

    * The filter type:
        INPUT_GET
        INPUT_POST
        INPUT_COOKIE
        INPUT_SERVER
        INPUT_ENV

    * The name of the variable

    * The ID or name of the filter to apply
        FILTER_SANITIZE_STRING for strings
        FILTER_SANITIZE_EMAIL for emails
        Other types of Filters (https://www.php.net/manual/en/filter.filters.php)
-->

<!-- 
    In this example, the first argument -- INPUT_GET -- identifies the input as coming from a query string. 'name' is the variable in the query string to filter. And the final argument is the filter to apply: when the input is a query string use the FILTER_SANITIZE_STRING argument. But there are also filters for numbers, email, special characters and more. If you were filtering an email, you would use FILTER_SANITIZE_EMAIL. To learn more about filter types check out the Sanitize Filters in the PHP manual.
-->