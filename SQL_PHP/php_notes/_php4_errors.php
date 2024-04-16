<!-- Basic Error Handling in PHP -->
<!-- https://teamtreehouse.com/library/basic-error-handling-in-php -->

<!-- Types of Errors -->
<!-- Notice - Won't stop execution, but something may be wrong -->
<!-- Warning - More severe, but won't stop execution -->
<!-- Fatal Error - Will stop execution -->

<!-- Only display errors in development -->
<!-- DON'T DISPLAY ERRORS IN LIVE PRODUCTION SERVERS -->
<!-- Disclosed important info on your sites setup and is a security risk -->

<!-- Change Settings -->

<!-- In the php.ini file -->

<!-- If you can't access the php.ini file, use the .htaccess file -->
<!-- Rename to htaccess.txt, then change back to original name -->

<!-- Reporting Errors: On
php_flag display_startup_errors On
php_flag display_errors On
php_value error_reporting -1
php_flag html_errors On
 -->
<!-- Reporting Errors: Off
php_flag display_startup_errors Off
php_flag display_errors Off
php_value error_reporting 0
php_flag html_errors Off
 -->

<!-- If neither of these are available, change in your php code -->

<!-- Error Reporting On -->
<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set("html_errors", 1)
?>