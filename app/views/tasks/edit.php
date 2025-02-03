<?php include '../app/views/partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Task</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <h1 class="mb-4">Edit Task</h1>

    <?php if ($task): ?>
      <form 
        method="POST" 
        action="index.php?controller=task&action=edit&id=<?php echo $task['id']; ?>"
        class="row g-3"
      >
        <div class="col-md-6">
          <label for="title" class="form-label">Title</label>
          <input 
            type="text" 
            name="title" 
            id="title" 
            class="form-control" 
            value="<?php echo htmlspecialchars($task['title']); ?>" 
            required
          >
        </div>

        <div class="col-md-12">
          <label for="description" class="form-label">Description</label>
          <textarea 
            name="description" 
            id="description" 
            class="form-control"
          ><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>

        <div class="col-md-6">
          <label for="due_date" class="form-label">Due Date</label>
          <input 
            type="date" 
            name="due_date" 
            id="due_date" 
            class="form-control" 
            value="<?php echo $task['due_date']; ?>"
          >
        </div>

        <div class="col-md-6">
          <label for="status" class="form-label">Status</label>
          <select 
            name="status" 
            id="status" 
            class="form-select"
          >
            <option 
              value="open" 
              <?php if ($task['status'] === 'open') echo 'selected'; ?>
            >
              Open
            </option>
            <option 
              value="pending" 
              <?php if ($task['status'] === 'pending') echo 'selected'; ?>
            >
              Pending
            </option>
            <option 
              value="completed" 
              <?php if ($task['status'] === 'completed') echo 'selected'; ?>
            >
              Completed
            </option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="priority" class="form-label">Priority</label>
          <select 
            name="priority" 
            id="priority" 
            class="form-select"
          >
            <option 
              value="low" 
              <?php if ($task['priority'] === 'low') echo 'selected'; ?>
            >
              Low
            </option>
            <option 
              value="medium" 
              <?php if ($task['priority'] === 'medium') echo 'selected'; ?>
            >
              Medium
            </option>
            <option 
              value="high" 
              <?php if ($task['priority'] === 'high') echo 'selected'; ?>
            >
              High
            </option>
          </select>
        </div>

        <div class="col-md-6">
          <label for="tags" class="form-label">Tags</label>
          <input 
            type="text" 
            name="tags" 
            id="tags" 
            class="form-control"
            value="<?php echo htmlspecialchars($task['tags']); ?>"
          >
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Update Task</button>
          <a 
            href="index.php?controller=task&action=index" 
            class="btn btn-secondary"
          >
            Back
          </a>
        </div>
      </form>
    <?php else: ?>
      <div class="alert alert-danger">Task not found.</div>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
