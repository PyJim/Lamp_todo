<?php
include '../includes/db.php';

// Fetch tasks
$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Todo List</title>
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<h2>Todo List</h2>
	<form action="add_task.php" method="POST">
		<input type="text" name="task" placeholder="Finish my devops lab assignment." required>
		<button type="submit">Add Task</button>
	</form>
	<ul>
		<?php while ($row = $result->fetch_assoc()): ?>
			<li>
				<?= htmlspecialchars($row['task']) ?>
				<a href="delete_task.php?id=<?= $row['id'] ?>"><i class="material-icons">delete</i></a>
			</li>
		<?php endwhile; ?>
	</ul>
</body>
</html>
