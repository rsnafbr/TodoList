<!DOCTYPE html>
<html>
<head>
    <title>Edit Todo</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <h1>Edit Task</h1>

    <form method="POST" action="?action=update&id=<?php echo htmlspecialchars($todo_data['id']); ?>">
        <input 
            type="text" 
            name="task" 
            placeholder="Edit Task" 
            value="<?php echo htmlspecialchars($todo_data['task']); ?>"
            required
        >
        <button type="submit">Save Changes</button>
    </form>
    <p><a href="index.php">Back to Todo List</a></p>
</body>
</html>