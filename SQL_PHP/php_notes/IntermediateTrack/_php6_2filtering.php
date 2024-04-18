<!-- Integrating PHP with Databases -->
<!-- https://teamtreehouse.com/library/integrating-php-with-databases -->

<!-- Filter inputs -->
<?php
    //Include functions
    function single_item_array($id)
    {
        include("connection.php");

        #region Query Database

        try
        {
            //Input string is SQL query
            //$results = $database->query(
            $results = $database->prepare(
                "SELECT media_id, title, category, img, format, year, genre, publisher, isbn
                FROM Media
                JOIN Genres ON Media.genre_id = Genres.genre_id
                LEFT OUTER JOIN Books ON Media.media_id = Books.media_id
                -- WHERE Media.media_id = $id"
                WHERE Media.media_id = ?"
            );
            //Protects from SQL injection, remember to change query to prepareabove ^
            $results->bindParam(1, $id, PDO::PARAM_INT); //prepares and binds a parameter to the first ?
            $results->execute(); //then execute

            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        #endregion

        $catalog = $results->fetch();
        return $catalog;
    }

    if (isset($_GET["id"]))
    {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $item = single_item_array($id);
    }

    if (empty($item))
    {
        header("location:catalog.php");
        exit;
    }

    $pageTitle = $item["title"];
    $section = null;
?>

<!-- Replace The, An and A at start of string -->
<?php
    $replaceQuery = "
                    REPLACE(
                        REPLACE(
                            REPLACE(title, 'The ', ''),
                            'An ', ''
                        ),
                        'A ', ''
                    )
                "
?>

<!-- General Queries -->
<?php
    function full_catalog_array()
    {
        include("connection.php");

        #region Query Database

        try
        {
            //Input string is SQL query
            $results = $database->query(
                "SELECT media_id, title, category, img
                FROM Media
                $replaceQuery"
            );
            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        #endregion

        $catalog = $results->fetchAll();
        return $catalog;
    }

    function single_item_array($id)
    {
        include("connection.php");

        #region Query Database

        try
        {
            //Input string is SQL query
            $results = $database->prepare(
                "SELECT media_id, title, category, img, format, year, genre, publisher, isbn
                FROM Media
                JOIN Genres ON Media.genre_id = Genres.genre_id
                LEFT OUTER JOIN Books ON Media.media_id = Books.media_id
                WHERE Media.media_id = ?"
            );

                $results->bindParam(1, $id, PDO::PARAM_INT);
                $results->execute();

            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        #endregion

        $item = $results->fetch();
        if (empty($item)) return $item;

        #region Query Database to get people

        try
        {
            //Input string is SQL query
            $results = $database->prepare(
                "SELECT fullname, role
                FROM Media_People
                JOIN People ON Media_People.people_id = People_people_id
                WHERE Media_People.media_id = ?"
            );

            $results->bindParam(1, $id, PDO::PARAM_INT);
            $results->execute();

            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        //Fetches results one by one, as long as there are results to fetch
        while($row = $results->fetch(PDO::FETCH_ASSOC))
        {
            $item[$row["role"]][] = $row["fullname"];
        }
        return $item;
        #endregion
    }
?>

<!-- Specific Queries -->
<?php
    function random_catalog_array()
    {
        include("connection.php");

        #region Query Database

        try
        {
            //Input string is SQL query
            $results = $database->query(
                "SELECT media_id, title, category, img
                FROM Media
                ORDER by RANDOM() --Random function may be different in other databases
                LIMIT 4"
            );
            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        #endregion

        $catalog = $results->fetchAll();
        return $catalog;
    }

    function category_catalog_array($category)
    {
        include("connection.php");

        #region Query Database

        $category = strtolower($category);
        try
        {
            //Input string is SQL query
            $results = $database->prepare(
                "SELECT media_id, title, category, img
                FROM Media
                WHERE LOWER(category) = ?
                ORDER BY
                $replaceQuery"
            );

            $results->bindParam(1, $category, PDO::PARAM_STR);
            $results->execute();

            echo "Retrieved Results";
        }
        catch(Exception $e)
        {
            echo "Unable to retrieve results";
            exit;
        }

        #endregion

        $catalog = $results->fetchAll();
        return $catalog;
    }
?>

<!-- Pagination -->
<?php

    //Function to get number of items, can filter by category
    function get_catalog_count($category = null)
    {
        $category = strtolower($category);
        include("connection.php");

        try
        {
            $sql = "SELECT COUNT(media_id) FROM media";

            //If category is not empty, add a where clause to the query
            if (!empty($category))
            {
                $sql = $sql . "WHERE LOWER(category) = ?";
                $result = $db->prepare($sql);
                $result->bindParam(1, $category, PDO::PARAM_STR);
            }
            else
            {
                $result = $db->prepare($sql);
            }

            $result->execute();
        }
        catch (Exception $e) 
        {
            echo "bad query";
        }

        $count = $result->fetchColumn(0);
        return count;
    }

    //Include functions
    $catalog = full_catalog_array();

    //Add items per page
    $items_per_page = 8;

    if (isset($_GET["id"]))
    {
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $item = single_item_array($id);
    }

    //Get Page input
    if (isset($_GET["pg"]))
    {
        $current_page = filter_input(INPUT_GET, "pg", FILTER_SANITIZE_NUMBER_INT);
        if (empty($current_page)) $current_page = 1;
    }

    $total_items = get_catalog_count(); //$section as input
    $total_pages = ceil($total_items / $items_per_page);

    //Limit results to include category
    $limit_results = "";
    if (!empty($section))
    {
        $limit_results = "cat=" . $section . "&";
    }

    //Clamp Pages and redirect to min/max page numbers
    if ($current_page > $total_pages)
    {
        header("location:catalog.php?" . $limit_results . "pg=" . $total_pages);
    }
    if ($current_page < 1)
    {
        header("location:catalog.php?" . $limit_results . "pg=1");
    }

    //Get offset
    $offset = ($current_page - 1) * $items_per_page;

    if (empty($item))
    {
        header("location:catalog.php");
        exit;
    }

    $pageTitle = $item["title"];
    $section = null;
?>

<!-- Setting Limits for Queries for Pagination -->