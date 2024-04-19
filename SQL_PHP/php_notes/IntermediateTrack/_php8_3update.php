<!-- CRUD Operations with PHP -->
<!-- https://teamtreehouse.com/library/crud-operations-with-php -->

<!-- Refactor: HTML for Displaying Tasks -->
<div class="form-container">
    <ul class="items">
        <?php
                foreach (get_task_list() as $item)
                {
                    echo "<li><a href='project.php?id="
                        . $item["project_id"]
                        . "'>"
                        .  $item["title"]
                        . "</a></li>";
                }
        ?>
    </ul>
</div>

<!-- Refactor: Checking User Input to accept ID -->
<?php

    $title = "";
    $category = "";

    if (isset($_GET["id"]))
    {
        $project_id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
		list($project_id, $title, $category) = get_project($project_id);
    }

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
            if (add_project($title, $category, $project_id))
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

<!-- Change Header -->
<h1 class="actions-header">
    <?php
        if (!empty($project_id))
        {
            echo "Update";
        }
        else
        {
            echo "Add";
        }
    ?>
</h1>

<!-- Change HTML Elements -->
<form class="form-container form-add" method="post" action="project.php<?php if (isset($project_id) && !empty($project_id)) { echo "?id=" . $project_id;} ?>">

<td><input type="text" id="title" name="title" value="<?php echo $title; ?>" /></td>

<td>
    <select id="category" name="category">
        <option value="">Select One</option>
        <option value="Billable"
            <?php
                if ($category == "Billable")
                {
                    echo "selected";
                }
            ?>
        >Billable</option>
        <option value="Charity"
            <?php
            if ($category == "Charity")
            {
                echo "selected";
            }
            ?>
        >Charity</option>
        <option value="Personal"
            <?php
            if ($category == "Personal")
            {
                echo "selected";
            }
            ?>    
        >Personal</option>
    </select>
</td>

<!-- Adding the Update Button -->
<?php
    if (!empty($project_id))
    {
        echo '<input type="hidden" name="id" value"'
                . $project_id
                . '" />';
    }
?>

<!-- Refactor Add Project to Update Existing Projects -->
<?php
    function add_project($title, $category, $project_id = null)
    {
        include "connection.php";
        
        $sql = "INSERT INTO projects(title, category) VALUES(?, ?)";

        if ($project_id)
        {
            $sql = "UPDATE projects SET title = ?, category = ? WHERE project_id = $project_id";
        }

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

<!-- Refactor Add Task to Update Existing Tasks -->
<?php
    function add_task($project_id, $title, $date, $time, $task_id = null)
    {
        include "connection.php";
        
        $sql = "INSERT INTO tasks(project_id, title, date, time) VALUES(?, ?, ?, ?)";
        
        if ($task_id)
        {
            $sql = "UPDATE tasks SET project_id = ?, title = ?, date = ?, time = ? WHERE task_id = $task_id";
        }

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

<!-- Get Task Function -->
<?php
    function get_task($task_id)
    {
        include "connection.php";
        
        $sql = "SELECT task_id, title, date, time, project_id FROM tasks WHERE task_id = ?";
        
        try
        {
            $results = $db->prepare($sql);
            $results->bindValue(1, $task_id, PDO::PARAM_INT);
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

<!-- Code challenge in progress -->
<?php
    function reassign_task($old, $new) {
        include 'connection.php';

        //add code here
        $sql = "UPDATE tasks SET project_id = ? WHERE project_id = ?";
    
        $results = $db->prepare($sql);
        $results->bindValue(1, $new["project_id"]);
        $results->bindValue(2, $old["project_id"]);
        $results->execute();
    }
?>