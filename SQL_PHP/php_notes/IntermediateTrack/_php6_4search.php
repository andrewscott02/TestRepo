<!-- Integrating PHP with Databases -->
<!-- https://teamtreehouse.com/library/integrating-php-with-databases -->

<!-- HTML for search -->
<div class="search">
    <form method="get" action="index.php">
        <label for="s">Search:</label>
        <input type="text" name="s" id="s" />
        <input type="submit" value="go" />
    </form>
</div>

<!-- Setting search results -->
<?php
    if (isset($_GET["s"]))
    {
        $search = filter_input(INPUT_GET, "s", FILTER_SANITIZE_STRING);
    }
?>

<?php
    //Gets new page count for search results
    function get_catalog_count($category = null)
    {
        $category = strtolower($category, $search);
        include("connection.php");

        try
        {
            $sql = "SELECT COUNT(media_id) FROM media";

            //If category is not empty, add a where clause to the query
            if (!empty($search))
            {
                $sql .= "WHERE title LIKE ?";
                $result = $db->prepare($sql);
                $result->bindValue(1, "%". $search . "%", PDO::PARAM_STR);
            }
            else if (!empty($category))
            {
                $sql .= "WHERE LOWER(category) = ?";
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
        return $count;
    }

    //Gets array for search items
    function search_catalog_array($search, $limit = null, $offset = 0)
    {
        include("connection.php");
				global $replaceQuery;

        #region Query Database

        $search = strtolower($search);
        try
        {
            $sql = "SELECT media_id, title, category, img
                    FROM Media
                    WHERE title LIKE ?
                    ORDER BY
                    $replaceQuery";

            if (is_integer($limit))
            {
                $sql .= " LIMIT ? OFFSET ?";
                $results = $database->prepare($sql);
                $result->bindValue(1, "%". $search . "%", PDO::PARAM_STR);
                $results->bindParam(2, $limit, PDO::PARAM_INT);
                $results->bindParam(3, $offset, PDO::PARAM_INT);
            }
            else
            {
                $results = $database->prepare($sql);
                $result->bindValue(1, "%". $search . "%", PDO::PARAM_STR);
            }

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

<!-- HTML Elements -->

<h1>
    <?php 
        if ($search != null) {
            echo "Search Results for \"" . htmlspecialchars($search) . "\"";
        }
        else
        {
            if ($section != null) {
                echo "<a href='catalog.php'>Full Catalog</a> &gt; ";
            }
            echo $pageTitle; 
        }
    ?>
</h1>

<ul class="items">
    <?php
        foreach ($catalog as $item) {
            echo get_item_html($item);
        }
    ?>
</ul>

<!-- Refactor Pagination -->
<?php
    echo "<div class=\"pagination\">";
    echo "PAGES:";
    for($i = 1; $i <= $total_pages; $i++)
    {
        if ($i == $current_page)
        {
            echo " <span>$i</span>";
        }
        else
        {
            echo " <a href='catalog.php?";
            if (!empty($search))
            {
                echo "s=" . urlencode($htmlspecialchars(search)) . "&";
            }
            else if (!empty($section))
            {
                echo "cat=" . $section . "&";
            }
            echo "pg=$i'>$i</a>";
        }
    }
    echo "<div>"
?>

<!-- Refactor Pagination (Header) -->
<?php
    //Include functions before, though they are written below

    //Function to get number of items, can filter by category
    function get_catalog_count($category = null)
    {
        $category = strtolower($category);
        include("connection.php");

        try
        {
            $sql = "SELECT COUNT(media_id) FROM media "; //remember the whitespace so adding to the string works

            //If category is not empty, add a where clause to the query
            if (!empty($category))
            {
                $sql .= "WHERE LOWER(category) = ?";
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
        return $count;
    }

    //Include functions

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
    if (!empty($search))
    {
        echo "s=" . urlencode($htmlspecialchars(search)) . "&";
    }
    else if (!empty($section))
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

    $catalog = full_catalog_array($items_per_page, $current_page);

    if (empty($item))
    {
        header("location:catalog.php");
        exit;
    }

    $pageTitle = $item["title"];
    $section = null;
?>