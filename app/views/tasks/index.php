<?php include '../app/views/partials/navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Task List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <h1 class="mb-3">Tasks</h1>

    <!-- Search & Filter Form -->
    <form
      class="row row-cols-lg-auto g-3 align-items-center mb-3"
      method="GET"
      action="index.php"
    >
      <input type="hidden" name="controller" value="task">
      <input type="hidden" name="action" value="index">

      <!-- Search field -->
      <div class="col-12">
        <label for="search" class="visually-hidden">Search</label>
        <input
          type="text"
          name="search"
          id="search"
          class="form-control"
          placeholder="Search..."
          value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>"
        >
      </div>

      <!-- Priority filter -->
      <div class="col-12">
        <label for="priority" class="visually-hidden">Priority</label>
        <select
          name="priority"
          id="priority"
          class="form-select"
        >
          <option value="">All</option>
          <option value="low" <?php if (($priority ?? '') === 'low') echo 'selected'; ?>>Low</option>
          <option value="medium" <?php if (($priority ?? '') === 'medium') echo 'selected'; ?>>Medium</option>
          <option value="high" <?php if (($priority ?? '') === 'high') echo 'selected'; ?>>High</option>
        </select>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-secondary">
          Search/Filter
        </button>
      </div>
    </form>

    <!-- Create Task Button -->
    <div class="mb-3">
      <a
        href="index.php?controller=task&action=create"
        class="btn btn-primary"
      >
        Create Task
      </a>
    </div>

    <!-- Display tasks in a table -->
    <?php if (!empty($tasks)): ?>
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Tags</th>
            <th>Created By</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task): ?>
          <tr>
            <td><?php echo htmlspecialchars($task['title']); ?></td>
            <td><?php echo htmlspecialchars($task['description']); ?></td>
            <td><?php echo $task['due_date'] ?: 'No due date'; ?></td>
            <td><?php echo $task['status']; ?></td>
            <td><?php echo $task['priority']; ?></td>
            <td><?php echo $task['tags']; ?></td>
            <td><?php echo htmlspecialchars($task['created_by_username']); ?></td>
            <td><?php echo $task['created_at']; ?></td>
            <td>
              <a
                href="index.php?controller=task&action=edit&id=<?php echo $task['id']; ?>"
                class="btn btn-sm btn-warning"
              >
                Edit
              </a>
              <a
                href="index.php?controller=task&action=delete&id=<?php echo $task['id']; ?>"
                class="btn btn-sm btn-danger"
              >
                Delete
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-info">No tasks found.</div>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
