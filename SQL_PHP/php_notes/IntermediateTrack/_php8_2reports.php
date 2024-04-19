<!-- CRUD Operations with PHP -->
<!-- https://teamtreehouse.com/library/crud-operations-with-php -->

<!-- Calculating Task Data -->
<div class="wrapper">
    <table>
        <?php
            $total = 0;
            $project_id = 0;
            $project_total = 0;

            $tasks = get_task_list($filter);

            foreach($tasks as $item)
            {
                //Creating Table Headers
                if ($project_id != $item["project_id"])
                {
                    $project_id = $item["project_id"];
                    echo "<thead>\n";
                    echo "<tr>\n";
                    echo "<th>" . $item["project"] . "</th>\n";
                    echo "<th>Date</th>\n";
                    echo "<th>Time</th>\n";
                    echo "</tr>\n";
                    echo "</thead>\n";
                }

                //Creating Table Items
                $project_total += $item["time"];
                $total += $item["time"];
                echo "<tr>\n";
                echo "<td>" . $item["title"] . "</td>\n";
                echo "<td>" . $item["date"] . "</td>\n";
                echo "<td>" . $item["time"] . "</td>\n";
                echo "</tr>\n";

                //Create total project time for project
                if (next($tasks)["project_id"] != $item["project_id"])
                {
                    echo "<tr>\n";
                    echo "<th class='project-total-label' colspan='2'>Project Total</th>\n";
                    echo "<th class='project-total-number'>" . $project_total . "</th>\n";
                    echo "</tr>\n";

                    $project_total = 0;
                }
            }
        ?>
        <tr>
            <th class='grand-total-label' colspan='2'>Grand Total</th>
            <th class='grand-total-number'><?php echo $total; ?></th>
        </tr>
    </table>
</div>

<!-- Refactor: Get Task List Function to add filter -->
<?php
    function get_task_list($filter = null)
    {
        include "connection.php";
        
        $sql = "SELECT tasks.*, projects.title as project FROM tasks
                        JOIN projects ON tasks.project_id = projects.project_id";
        
        //Remember to add spaces at start of string
        $where = "";

        if (is_array($filter))
        {
            //Switch through filter types
            switch ($filter[0])
            {
                case "project":
                    $where = " WHERE projects.project_id = ?";
                    break;
                case "category":
                    $where = " WHERE category = ?";
                    break;
                case "date":
                    $where = " WHERE date BETWEEN ? AND ?";
                    break;
                default:
                    break;
            }
        }

        $orderBy = " ORDER BY date DESC";

        if ($filter)
        {
            $orderBy = " ORDER BY projects.title ASC, date DESC";
        }

        try
        {
            $results = $db->prepare($sql . $where . $orderBy);
            if (is_array($filter))
            {
                $results->bindValue(1, $filter[1]);
                if ($filter[0] == "date")
                {
                    $results->bindValue(2, $filter[2], PDO::PARAM_STR);
                }
            }
            $results->execute();
        }
        catch (Exception $e)
        {
            echo "Error!: " . $e->getMessage() . "</br>";
            return [];
        }

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<!-- Adding a Filter for the Report -->
<div class="col-container">
    <h1 class='actions-header'>Report on 
        <?php
            if (!is_array($filter))
            {
                echo "All Tasks by Project";
            }
            else
            {
                echo ucwords($filter[0]) . " : ";
                switch ($filter[0])
                {
                    case "project":
                        $project = get_project($filter[1]);
                        echo $project["title"];
                        break;
                    case "category":
                        echo $filter[1];
                        break;
                    case "date":
                        echo $filter[1] . " - " . $filter[2];
                        break;
                    default:
                        break;
                }
            }
        ?>
    </h1>
    <form class="form-container form-report" action="reports.php" method="get">
        <label for="filter">Filter:</label>
        <select id="filter" name="filter">
            <option value="">View All</option>
            <optgroup label="Projects">
                <?php
                    foreach(get_project_list() as $item)
                    {
                        echo "<option value='project:"
                            . $item["project_id"]
                            . "'>"
                            . $item["title"]
                            . "</option>\n";
                    }
                ?> 
            </optgroup>
            <optgroup label="Category">
                <option value="category:Billable">Billable</option>
                <option value="category:Charity">Charity</option>
                <option value="category:Personal">Personal</option>
            </optgroup>
            <optgroup label="Date">
                <option value="date:
                    <?php 
                    echo date("m/d/Y", strtotime("-2 Sunday"));
                    echo ":";
                    echo date("m/d/Y", strtotime("-1 Saturday"));
                    ?>
                    ">Last Week
                </option>
                <option value="date:
                    <?php 
                    echo date("m/d/Y", strtotime("-1 Sunday"));
                    echo ":";
                    echo date("m/d/Y");
                    ?>
                    ">This Week
                </option>
                <option value="date:
                    <?php 
                    echo date("m/d/Y", strtotime("first day of last month"));
                    echo ":";
                    echo date("m/d/Y", strtotime("last day of last month"));
                    ?>
                    ">Last Month
                </option>
                <option value="date:
                    <?php 
                    echo date("m/d/Y", strtotime("first day of this month"));
                    echo ":";
                    echo date("m/d/Y");
                    ?>
                    ">This Month
                </option>
            </optgroup>
        </select>
        <input class="button" type="submit" value="Run"/>
    </form>
</div>

<!-- Above header.php include -->
<?php
    $filter = "all";
    
    if (!empty($_GET["filter"]))
    {
        $filter = explode(":", filter_input(INPUT_GET, "filter", FILTER_SANITIZE_STRING));
    }
?>

<!-- Function to Get Project -->
<?php
    function get_project($project_id)
    {
        include "connection.php";
        
        $sql = "SELECT * FROM projects WHERE project_id = ?";
        
        try
        {
            $results = $db->prepare($sql);
            $results->bindValue(1, $project_id, PDO::PARAM_INT);
            $results->execute();
        }
        catch (Exception $e)
        {
            echo "Error!: " . $e->getMessage() . "<br />";
            return false;
        }
        
        return $results->fetch();
    }
?>