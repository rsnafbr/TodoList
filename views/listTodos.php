<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
</head>
<body>
    <h1>Todo List</h1>
    
    <div class="form-container">
        <form method="GET" action="index.php">
            <input type="text" name="search" placeholder="Search tasks..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
            <button type="submit">Search</button>
            <?php if (isset($_GET['search']) && $_GET['search'] !== ''): ?>
                <a href="index.php" style="padding: 12px 15px; border: none; background-color: #6c757d; color: white; border-radius: 8px; text-decoration: none; font-size: 16px; font-weight: 600;">Clear</a>
            <?php endif; ?>
        </form>

        <form method="POST" action="?action=add">
            <input type="text" name="task" placeholder="New Task">
            <button type="submit">Add</button>
        </form>
    </div>
    
    <ul>
    <?php foreach ($todos as $todo): ?>
        <li>
            <div class="task-name">
                <?php echo htmlspecialchars($todo['task']); ?>
            </div>
            
            <div class="action-links">
                <?php
                if (!$todo['is_completed']) {
                    echo '<a href="?action=complete&id=' . $todo['id'] . '">Mark as completed</a>';
                } else {
                    echo '<span class="done-tag">DONE</span>';
                }
                
                echo '<a href="?action=edit&id=' . $todo['id'] . '">Edit</a>'; 
                echo '<a href="#" onclick="return showDeleteConfirmation(\'' . htmlspecialchars($todo['id'], ENT_QUOTES) . '\', \'' . htmlspecialchars($todo['task'], ENT_QUOTES) . '\')">Delete</a>';
                ?>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>