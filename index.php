<?php include('config.php'); ?>
<?php
// Add Task
if (isset($_POST['add_task'])) {
	$task = mysqli_real_escape_string($conn, $_POST['task']);
	$sql = "INSERT INTO tasks (task) VALUES ('$task')";
	mysqli_query($conn, $sql);
	header("Location: index.php"); // Prevent form resubmission
}

// Complete Task
if (isset($_GET['action']) && $_GET['action'] == 'complete') {
	$id = $_GET['id'];
	$sql = "UPDATE tasks SET status='completed' WHERE id=$id";
	mysqli_query($conn, $sql);
	header("Location: index.php");
}

// Delete Task
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
	$id = $_GET['id'];
	$sql = "DELETE FROM tasks WHERE id=$id";
	mysqli_query($conn, $sql);
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP To-Do List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container mt-5">
	<h1 class="mb-4">PHP To-Do List</h1>
	
	<!-- Add Task Form -->
	<form method="POST" action="index.php">
	  <div class="input-group mb-3">
		<input type="text" class="form-control" name="task" placeholder="Add a new task" required>
		<button type="submit" class="btn btn-primary" name="add_task">Add Task</button>
	  </div>
	</form>

	<!-- Display Tasks -->
	<ul class="list-group">
	  <?php
	  // Fetch all tasks
	  $sql = "SELECT * FROM tasks ORDER BY created_at DESC";
	  $result = mysqli_query($conn, $sql);

	  while ($row = mysqli_fetch_assoc($result)) {
		  $status = $row['status'] == 'completed' ? 'text-decoration-line-through' : '';
		  echo "
          <li class='list-group-item d-flex justify-content-between align-items-center $status'>
            {$row['task']}
            <div>
              <a href='index.php?action=complete&id={$row['id']}' class='btn btn-success btn-sm'>✓</a>
              <a href='index.php?action=delete&id={$row['id']}' class='btn btn-danger btn-sm'>✗</a>
            </div>
          </li>
        ";
	  }
	  ?>
	</ul>
  </div>
</body>
</html>