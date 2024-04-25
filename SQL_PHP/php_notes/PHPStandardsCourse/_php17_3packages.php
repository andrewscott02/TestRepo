<!-- PHP Standards and Best Practices -->
<!-- https://teamtreehouse.com/library/php-standards-and-best-practices -->

<!-- Info for making and distributing a package -->

<!-- Install unit tests package -->
composer require phpunit/phpunit --dev

<!-- Style Guides -->
<!-- PSR-1 -->
<?php ?> <!-- Use long tags -->
<?= "Output" ?> <!-- Use short echo tags -->

<!-- 
    * Namespaces and classes in Pascal Case
    * Methods in camel Case
-->

<!-- PSR-2 -->
<!-- 
    * Use spaces instead of tabs
    * Code ideally should be less than 80 characters
    * Code shouldn't be more than 120 characters
    * 1 blank line after namespace and use declarations
    * Curly braces on their own lines

    * Visibility must be declared on all properties and methods
    * Abstract and final before visibility
    * Static after visibility

    * Methods have no space between them and the brackets eg. function Func()
    * Control statement must have a space eg. if ()
    * Curly braces start on the same line as the statement eg. if () {
    * No spaces between braces for functions and control statements eg. if (true) and not if ( true )
    

-->

<!-- Test PSR Compliance -->
./vendor/bin/phpcs src --standard-PSR1
./vendor/bin/phpcs src --standard-PSR2

<!-- Update composer.json metadata -->
<!-- 
    Example
    {
        "name" : "treehouse/example",
        "description" : "This is an example package.",
        "keywords" : ["example", "treehouse", "squirrel"],
        "license" : "MIT",
        "authors" : [
            {
                "name" : "Phil Sturgeon",
                "email" : "phil@example.org",
                "homepage" : "http://treehouse.com/",
                "role" : "Developer"
            }
        ],
        "require" : {
            "php" : ">=5.4"
        },
        "require-dev": {
            "phpunit/phpunit": "4.2.*",
            "squizlabs/php_codesniffer": "*"
        },
        "autoload" : {
        "psr-4" : {
            "Treehouse\\Example\\" : "src"
        }
        }
    }

-->

<!-- Then run following command: -->
composer validate

<!-- From here you can look into publishing the package -->