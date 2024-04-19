<!-- File Handling with PHP -->
<!-- https://teamtreehouse.com/library/file-handling-with-php -->

<!-- Reading CSV -->
<?php
    if (($fh = fopen("data/csv/people.csv", "r")) !== false)
    {
        fgetcsv($fh); //reads each line as a row of columns in a CSV file
        fclose($fh);
    }
?>

<!-- Getting data from csv -->
<?php
    if (($fh = fopen("data/csv/people.csv", "r")) !== false)
    {
        $header = fgetcsv($fh);
        extract(array_flip($header));
        
        
        echo '<div class="row">';
        
        $count = 0;
        
        while(($contact = fgetcsv($fh)) !== false)
        {
            if ($count > 0 && $count % 4 == 0) //For every 4 items, make a new row
            {
                echo "</div>\n";
                echo '<div class="row">';
            }
            $count++;
            echo '<div class="col-xs-6 col-md-3">';
            echo '<div class="thumbnail">';
            echo '<img src="' . $contact[$img] . '" />';
            echo '<div class="caption">';
            echo '<h4 class="media-heading">' . $contact[$first] . ' ' . $contact[$last] . '</h4>';
            echo '<a href="http://' . $contact[$website] . '" target="_blank">' . $contact[$website] . '</a>';
            echo '<br />';
            echo 'Twitter: <a href="https://twitter.com/' . $contact[$twitter] . '" target="_blank">@' . $contact[$twitter] . '</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>';
        
        fclose($fh);
    }
?>

<!-- Writing CSV -->
<?php
    $new_person = [
        filter_input(INPUT_POST, "first", FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, "last", FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, "website", FILTER_SANITIZE_URL),
        filter_input(INPUT_POST, "twitter", FILTER_SANITIZE_STRING),
        filter_input(INPUT_POST, "img", FILTER_SANITIZE_URL),
    ];

    if (($fh = fopen("../data/csv/people.csv", "a+")) !== false)
    {
        fseek($fh, -1, SEEK_END);
        if (fgets($fh) != PHP_EOL)
        {
            fputs($fh, PHP_EOL);
        }
        fputcsv($fh, $new_person);
        fclose($fh);
    }

    header("location: /people.php");
?>

<!-- Reading JSON -->
<?php
    $books = json_decode(file_get_contents("data/json/top_programming_books.json"));

    if (is_object($books->collection->books[0]))
    {
        foreach($books->collection->books as $book)
        {
            //Loop through books
        }
    }
?>

<!-- Showing Books -->
<?php
    $books = json_decode(file_get_contents("data/json/top_programming_books.json"));
    if (is_object($books->collection->books[0]))
    {
        foreach($books->collection->books as $book)
        {
            echo '<div class="panel panel-default">';
        
            echo '<div class="panel-heading">';
            echo '<h3 class="panel-title">' . $book->title . '</h3>';
            echo 'by ' . $book->author_name;
            echo '</div>';
        
            echo '<div class="panel-body media">';
        
            echo '<div class="media-left media-top">';
            echo '<img class="media-object" src="' . $book->book_image_url . '" />';
            echo '</div>';
            
            echo '<div class="media-body">';
            if (strlen($book->book_description) < 500) 
            {
                echo $book->book_description;
            }
            else //If description is too long, cut off at 500 characters with ...
            {
                $lastWord = strpos($book->book_description, " ", 500); //So it doesn't cut off halfway through word
                echo substr($book->book_description, 0, $lastWord) . "...";
            }
            echo '<br />';
            echo '<a href="' . $book->link . '" target="_blank">Learn more...</a>';
            echo '</div>';
        
            echo '</div>';
        
            echo '</div>';
        }
    }
?>

<!-- Writing JSON -->
<?php
    $new_book = [
        "title" => filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING),
        "link" => filter_input(INPUT_POST, "link", FILTER_SANITIZE_URL),
        "book_image_url" => filter_input(INPUT_POST, "book_image_url", FILTER_SANITIZE_URL),
        "book_description" => filter_input(INPUT_POST, "book_description", FILTER_SANITIZE_STRING),
        "num_pages" => filter_input(INPUT_POST, "num_pages", FILTER_SANITIZE_NUMBER_INT),
        "author_name" => filter_input(INPUT_POST, "author_name", FILTER_SANITIZE_STRING),
        "isbn" => filter_input(INPUT_POST, "isbn", FILTER_SANITIZE_NUMBER_INT),
        "average_rating" => filter_input(INPUT_POST, "average_rating", FILTER_SANITIZE_NUMBER_FLOAT),
        "book_published" => filter_input(INPUT_POST, "book_published", FILTER_SANITIZE_NUMBER_INT)
    ];

    $file = "../data/json/top_programming_books.json";
    $books = json_decode(file_get_contents($file));

    if (is_object($books->collection->books[0]))
    {
        $books->collection->books[] = $new_book;
    }

    $json = json_encode($books, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    // echo "<pre>" . $json . "</pre>";
    file_put_contents($file, $json);
	header("location: /books.php");
?>

<!-- Reading XML -->
<?php
    $files = [];
    $dir = "data/xml";
    if ($fh = opendir($dir))
    {
        while(($entry = readdir($fh)) !== false)
        {
            if (substr($entry, 0, 1) != ".")
            {
                $files[] = $dir . "/" . $entry;
            }
        }
        closedir($fh);
    }

    if (!empty($files))
    {
        foreach ($files as $file)
        {
            $xml = simplexml_load_file($file);
            //Loop through podcasts
        }
    }
?>

<!-- Showing Podcasts -->
<?php
    $files = [];
    $dir = "data/xml";
    if ($fh = opendir($dir))
    {
        while(($entry = readdir($fh)) !== false)
        {
            if (substr($entry, 0, 1) != ".")
            {
                $files[] = $dir . "/" . $entry;
            }
        }
        closedir($fh);
    }
    
    if (!empty($files))
    {
        foreach ($files as $file)
        {
            $xml = simplexml_load_file($file);
            //Loop through podcasts
    
            echo '<div class="panel panel-default">';
            
            echo '<div class="panel-heading">';
            echo '<h3 class="panel-title"><a href="' . $xml->channel->link . '" target="_blank">' . $xml->channel->title . '</a></h3>';
            echo '</div>';
        
            echo '<div class="panel-body">';
            echo '<p>' . $xml->channel->description . '</p>';
            $randint = rand(0, count($xml->channel->item) - 1);
            echo '<p><strong>Sample: ' . $xml->channel->item[$randint]->title . '</strong> - ';
            echo $xml->channel->item[$randint]->description . '</p>';
            echo '<audio controls>';
            echo '<source src="' . $xml->channel->item[$randint]->enclosure->attributes()->url . '" type="audio/mpeg">';
            echo 'Your browser does not support the audio element.';
            echo '</audio>';
            echo '<p><a href="' . $xml->channel->link . '" target="_blank">Lean more and subscribe</a></p>';
            echo '</div>';
            
            echo '</div>';
        }
    }
?>

<!-- Writing XML -->
<?php
    $file = "../data/xml/" . filter_input(INPUT_POST, "file", FILTER_SANITIZE_STRING);
    if ($xml = simplexml_load_file($file))
    {
        $item = $xml->channel->addChild("item");
        $item->addChild("title", filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
        $item->addChild("link", filter_input(INPUT_POST, "link", FILTER_SANITIZE_URL));
        
        $date = new DateTime(filter_input(INPUT_POST, "pubDate", FILTER_SANITIZE_STRING));
        $item->addChild("pubDate", $date->format("D, d M Y H:i:s + 0000"));
        
        $item->addChild("description", filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING));

        $itunes = "http://www.itunes.com/dtds/podcast-1.0.dtd";
        $item->addChild("subtitle", filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING), $itunes);
        $item->addChild("summary", filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING), $itunes);
        $item->addChild("explicit", filter_input(INPUT_POST, "explicit", FILTER_SANITIZE_STRING), $itunes);
        $item->addChild("duration", filter_input(INPUT_POST, "duration", FILTER_SANITIZE_STRING), $itunes);

        // echo "<pre>" . htmlspecialchars(str_replace("><", ">\n<", $xml->asXML())) . "</pre>";

        $xml->asXML($file);
        header("location: /podcasts.php");
    }
?>