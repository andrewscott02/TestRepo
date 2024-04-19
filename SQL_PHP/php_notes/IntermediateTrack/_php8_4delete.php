<!-- CRUD Operations with PHP -->
<!-- https://teamtreehouse.com/library/crud-operations-with-php -->

<!-- Delete Project and Task Functions -->
<?php
    function delete_task($task_id)
    {
        include "connection.php";
        
        $sql = "DELETE FROM tasks WHERE task_id = ?";
        
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
        
        return true;
    }

    function delete_project($project_id)
    {
        include "connection.php";
        
        //Only deletes if projects do not have tasks assigned to them
        $sql = "DELETE FROM projects WHERE project_id = ?"
                . " AND project_id NOT IN (SELECT project_id FROM task)";
        
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
        
        if ($results->rowCount() > 0)
        {
            return true;
        }
        return false;
    }
?>

<!-- Refactor Form Container to Add Delete Button -->
<div class="form-container">
    <ul class="items">
        <?php
            foreach (get_task_list() as $item)
            {
                echo "<li><a href='task.php?id="
                    . $item["task_id"]
                    . "'>"
                    .  $item["title"]
                    . "</a>";
                
                echo "<form method='post' action='task_list.php' onsubmit='return confirm('Are you sure you want to delete this task?');'>\n";
                echo "<input type='hidden' value='" . $item["task_id"] . "' name='delete'/>\n";
                echo "<input type='submit' class='button--delete' value='Delete'/>\n";
                echo "</form>";
                echo "</li>";
            }
        ?>
    </ul>
</div>

<!-- Show Message on Delete -->
<?php
    if (isset($_POST["delete"]))
    {
        if (delete_task(filter_input(INPUT_POST, "delete", FILTER_SANITIZE_NUMBER_INT)))
        {
            header("location: task_list.php?msg=Task+Deleted");
            exit;
        }
        else
        {
            header("location: task_list.php?msg=Unable+to+Delete+Task");
            exit;
        }
    }

    if (isset($_GET["msg"]))
    {
        $error_message = trim(filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING));
    }
?>