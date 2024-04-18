<!-- CRUD Operations with PHP -->
<!-- https://teamtreehouse.com/library/crud-operations-with-php -->

<!--       SQL CRUD Operations      -->
<!-- Operations    ||      KeyWords -->
<!-- 
    Create         ||      INSERT
    Read           ||      SELECT
    Update         ||      UPDATE
    Delete         ||      DELETE 
-->

<!-- Recap: Connect to Database and Query it -->
<?php
    //  Use try...catch to catch errors
    try
    {
        $db = new PDO("sqlite:" . __DIR__ . "/database.db");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e)
    {
        echo "Unable to connect to database: \n";
        echo $e->getMessage(); //Calls the getMessage function on the exception object
        exit;
    }
?>

<!-- Get Projects from Database Function -->
<?php
    function get_project_list()
    {
        include "connection.php";
        
        try
        {
            return $db->query("SELECT project_id, title, category FROM projects");
        }
        catch (Exception $e)
        {
            echo "Error!: " . $e->getMessage() . "</br>";
            return [];
        }
    }
?>

<!-- HTML for Displaying Projects -->
<div class="form-container">
    <ul class="items">
        <?php
            foreach (get_project_list() as $item)
            {
                echo "<li>" . $item["title"] . "</li>";
            }
        ?>
    </ul>
</div>

<!-- Checking User Input -->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Filter and trim inputs
        $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
        $category = trim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING));
        
        if (empty($title) || empty($category))
        {
            $error_message = "Please fill in the required fields: Title, Category";
        }
        else
        {
            echo "title = $title<br />";
            echo "category = $category<br />";
        }
    }
?>

<!-- Add Projects to Database Function -->
<?php
    function add_project($title, $category)
    {
        include "connection.php";
        
        $sql = "INSERT INTO projects(title, category) VALUES(?, ?)";
        
        try
        {
            $results = $db->prepare($sql);
            $results->bindValue(1, $title, PDO::PARAM_STR);
            $results->bindValue(2, $category, PDO::PARAM_STR);
            $results->execute();
        }
        catch (Exception $e)
        {
            echo "Error!: " . $e->getMessage() . "<br />";
            return false;
        }
        
        return true;
    }
?>

<!-- Refactor: Checking User Input to add project -->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Filter and trim inputs
        $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
        $category = trim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING));
        
        if (empty($title) || empty($category))
        {
            $error_message = "Please fill in the required fields: Title, Category";
        }
        else
        {
            if (add_project($title, $category))
            {
                header("Location: project_list.php");
                exit;
            }
            else
            {
                $error_message = "Could not add project";
            }
        }
    }
?>

<!-- Function to Get Task List -->
<?php
    function get_task_list()
    {
        include "connection.php";
        
        $sql = "SELECT tasks.*, projects.title as project FROM tasks
                        JOIN projects ON tasks.project_id = projects.project_id";
        
        try
        {
            return $db->query($sql);
        }
        catch (Exception $e)
        {
            echo "Error!: " . $e->getMessage() . "</br>";
            return [];
        }
    }
?>

<!-- HTML for Displaying Tasks -->
<div class="form-container">
    <ul class="items">
        <?php
                foreach (get_task_list() as $item)
                {
                    echo "<li>" . $item["title"] . "</li>";
                }
        ?>
    </ul>
</div>

<!-- Add Task to Database Function -->
<?php
    function add_task($project_id, $title, $date, $time)
    {
        include "connection.php";
        
        $sql = "INSERT INTO tasks(project_id, title, date, time) VALUES(?, ?, ?, ?)";
        
        try
        {
            $results = $db->prepare($sql);
            $results->bindValue(1, $project_id, PDO::PARAM_INT);
            $results->bindValue(2, $title, PDO::PARAM_STR);
            $results->bindValue(3, $date, PDO::PARAM_STR);
            $results->bindValue(4, $time, PDO::PARAM_INT);
            $results->execute();
        }
        catch (Exception $e)
        {
            echo "Error!: " . $e->getMessage() . "<br />";
            return false;
        }
        
        return true;
    }
?>

<!-- Populate Project Dropdown -->
<select name="project_id" id="project_id">
    <option value="">Select One</option>
        <?php
            foreach (get_project_list() as $item)
            {
                echo"<option value='"
                    . $item["project_id"]
                    . "'>"
                    . $item["title"]
                    . "</option>";
            }
        ?>
</select>

<!-- Checking User Input to Add Task and Remembering Form Data -->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Setup empty data in case it does not get set by post
        $project_id = $title = $date = $time = "";

        //Filter and trim inputs
        $project_id = trim(filter_input(INPUT_POST, "project_id", FILTER_SANITIZE_NUMBER_INT));
        $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
        $date = trim(filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING));
        $time = trim(filter_input(INPUT_POST, "time", FILTER_SANITIZE_NUMBER_INT));
        
        if (empty($project_id) || empty($title) || empty($date) || empty($time))
        {
            $error_message = "Please fill in the required fields: Project ID, Title, Date, Time";
        }
        else
        {
            if (add_task($project_id, $title, $date, $time))
            {
                header("Location: task_list.php");
                exit;
            }
            else
            {
                $error_message = "Could not add task";
            }
        }
    }
?>

<!-- Fefactor: Populate Project Dropdown to Remember Form Data -->
<select name="project_id" id="project_id">
    <option value="">Select One</option>
        <?php
            foreach (get_project_list() as $item)
            {
                echo "<option value='"
                    . $item["project_id"]
                    . "'";
                //Remember User Input
                if ($project_id == $item["project_id"])
                {
                    echo "selected";
                }
                echo ">"
                    . $item["title"]
                    . "</option>";
            }
        ?>
</select>

<!-- Remembering Form Data -->
<tr>
    <th><label for="title">Title<span class="required">*</span></label></th>
    <td><input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" /></td>
</tr>
<tr>
    <th><label for="date">Date<span class="required">*</span></label></th>
    <td><input type="text" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" placeholder="mm/dd/yyyy" /></td>
</tr>
<tr>
    <th><label for="time">Time<span class="required">*</span></label></th>
    <td><input type="text" id="time" name="time" value="<?php echo htmlspecialchars($time); ?>" /> minutes</td>
</tr>