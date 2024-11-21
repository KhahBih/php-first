<?php 
    include 'partials/header.php';
    include 'partials/notifications.php';
    include 'config/Database.php';
    include 'classes/Task.php';
    session_start();

    $database = new Database();
    $db = $database->connect();
    $todo = new Task($db);

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['add_task'])){
            $todo->task = $_POST['task'];
            $todo->create();
            $_SESSION['message'] = 'Task added successfully!';
            $_SESSION['msg_type'] = 'success';
        }elseif(isset($_POST['complete_task'])){
            $todo->complete($_POST['id']);
            $_SESSION['message'] = 'Completed!';
            $_SESSION['msg_type'] = 'success';
        }elseif(isset($_POST['undo_complete_task'])){
            $todo->undoComplete($_POST['id']);
            $_SESSION['message'] = 'Undo task successfully!';
            $_SESSION['msg_type'] = 'success';
        }elseif(isset($_POST['delete_task'])){
            $todo->deleteTask($_POST['id']);            
            $_SESSION['message'] = 'Task deleted successfully!';
            $_SESSION['msg_type'] = 'success';
        }
    }
    $tasks = $todo->read();
?>
<!-- Notification  -->
<?php if(isset($_SESSION['message'])): ?>
    <div class="notification-container">
        <div class="notification <?php echo $_SESSION['msg_type'];?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <h1>Todo App</h1>

    <!-- Add Task Form -->
    <form method="POST">
        <input type="text" name="task" placeholder="Enter a new task" required>
        <button type="submit" name="add_task">Add Task</button>
    </form>

    <!-- Display Tasks -->
    <ul>
        <?php while($task = $tasks->fetch_assoc()): ?>
            <li class="completed">
                <span class="<?php $task['is_completed'] ? 'completed' : '';?>">
                    <?php echo $task['task']?>
                </span>
                <div>
                    <?php if(!$task['is_completed']): ?>
                        <!-- Complete Task -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $task['id']?>">
                            <button class="complete" type="submit" name="complete_task">Complete</button>
                        </form>
                    <?php else: ?>
                        
                        <!-- Undo Completed Task -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $task['id']?>">
                            <button class="undo" type="submit" name="undo_complete_task">Undo</button>
                        </form>
                    <?php endif; ?>
                    
                    <!-- Delete Task -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $task['id']?>">
                        <button class="delete" type="submit" name="delete_task">Delete</button>
                    </form>
                </div>
            </li>
        <?php endwhile ?>

        <li>
            <span>Another Task</span>
            <div>
                <!-- Complete Task -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="2">
                    <button class="complete" type="submit" name="complete_task">Complete</button>
                </form>

                <!-- Delete Task -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="2">
                    <button class="delete" type="submit" name="delete_task">Delete</button>
                </form>
            </div>
        </li>
    </ul>
</div>
<?php include 'partials/footer.php'?>