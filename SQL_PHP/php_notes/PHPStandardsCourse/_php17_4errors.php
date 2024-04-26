<!-- PHP Standards and Best Practices -->
<!-- https://teamtreehouse.com/library/php-standards-and-best-practices -->

<!-- Error Handling -->
<?php
    error_reporting(E_All); //In development

    ini_set("display_errors", 1);
?>

<!-- Exceptions -->
<?php
    ini_set('display_errors', 1);

    include "./vendor/autoload.php";

    // Make some custom exceptions
    class HttpRedirectException extends Exception {}
    class HttpClientException extends Exception {}
    class HttpServerException extends Exception {}


    function fetchHttpBody($url)
    {
        $browser = new Buzz\Browser();
        $response = $browser->get($url);
        
        $content = $response->getContent();
        $statusCode = $response->getStatusCode();
    
        $statusGroup = substr((string) $statusCode, 0, 1);

        switch ($statusGroup) {
            case '2':
                return $content;
            case '3':
                throw new HttpRedirectException('HTTP request was redirected', $statusCode);
            case '4':
                throw new HttpClientException('You made a bad request', $statusCode);
            case '5':
                throw new HttpServerException('The server you tried calling is not ok', $statusCode);
            default:
                throw new Exception('Got an unexpected status code of '.$statusGroup);
        }
    }

    // Now try this request
    try {
        echo fetchHttpBody('https://example.org/');

    } catch(HttpRedirectException $e) {
        printf('Redirect Error: %s (code %d)', $e->getMessage(), $e->getCode());
    
    } catch(HttpClientException $e) {
        printf('Client Error: %s (code %d)', $e->getMessage(), $e->getCode());
    
    } catch(HttpServerException $e) {
        printf('Server Error: %s (code %d)', $e->getMessage(), $e->getCode());
    
    } catch (Exception $e) {
        echo "General Error: ".$e->getMessage();
    }
?>

<!-- Recap - Converting errors to exception -->
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

<!-- Logging with PSR-3 -->
<?php

    include "./vendor/autoload.php";

    use Monolog\Logger;
    use Monolog\Handler\BrowserConsoleHandler;

    // create a log channel
    $log = new Logger('my_app');

    $log->pushHandler(new BrowserConsoleHandler());
    // Specify log severity
    $log->pushHandler(new BrowserConsoleHandler(Logger::WARNING)); //Warning or higher
    $log->pushHandler(new BrowserConsoleHandler(Logger::ERRORS)); //Errors or higher
    $log->pushHandler(new BrowserConsoleHandler(Logger::CRITICAL)); //Only critical

    foreach (range(1, 10) as $foo) {
        $log->debug('Something is happening.', ['foo' => $foo]);
    }

    $log->warning('Maybe bad.');

    $log->error('Bad.');

    $log->critical('Super Bad.');

    echo "Check the logs to see whats happening in here...";

?>