<?php
require_once 'config/database.php';
require_once 'models/Task.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $task = new Task();
    
    if ($_POST['action'] === 'add') {
        $task->title = $_POST['title'];
        $task->description = $_POST['description'];
        $task->createTask();
        
        // Redirect to prevent form resubmission
        header('Location: index.php');
        exit;
    } elseif ($_POST['action'] === 'delete') {
        $task->id = $_POST['task_id'];
        $task->deleteTask();
        
        header('Location: index.php');
        exit;
    }
}

// Get all tasks for display
$task = new Task();
$tasks = $task->getAllTasks();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TASKNEST</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <!-- Left side - Task Form -->
        <div class="form-section">
            <h1>TaskNest</h1>
            <h2>Add New Task</h2>
            <form method="POST" action="index.php">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label for="taskTitle">Title:</label>
                    <input type="text" id="taskTitle" name="title" required>
                </div>
                <div class="form-group">
                    <label for="taskDescription">Description:</label>
                    <textarea id="taskDescription" name="description" rows="4" required></textarea>
                </div>
                <button type="submit" class="add-btn">Add Task</button>
            </form>
        </div>

        <!-- Middle divider line -->
        <div class="divider"></div>

        <!-- Right side - Task List -->
        <div class="task-section">
            <h2>My Tasks</h2>
            <div id="taskList" class="task-list">
                <?php if (empty($tasks)): ?>
                    <div class="empty-state">No tasks yet. Add your first task!</div>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <div class="task-item">
                            <form method="POST" action="index.php" style="display: inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                <button type="submit" class="done-btn" title="Mark as done" onclick="return confirm('Mark this task as completed?')">Done</button>
                            </form>
                            <div class="task-title"><?= htmlspecialchars($task['title']) ?></div>
                            <div class="task-description"><?= htmlspecialchars($task['description']) ?></div>
                            <div class="task-date">Created: <?= date('M j, Y g:i A', strtotime($task['created_at'])) ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>