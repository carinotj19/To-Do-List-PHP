<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Task</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-4">
    <h1>Create Task</h1>

    <!-- Display errors -->
    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo htmlspecialchars($error); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form 
      method="POST" 
      action="index.php?controller=task&action=create" 
      class="row g-3"
    >
      <div class="col-md-6">
        <label for="title" class="form-label">Title</label>
        <input 
          type="text" 
          name="title" 
          id="title" 
          class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : ''; ?>" 
          value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" 
          required
        >
        <?php if (isset($errors['title'])): ?>
          <div class="invalid-feedback">
            <?php echo htmlspecialchars($errors['title']); ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-md-6">
        <label for="due_date" class="form-label">Due Date</label>
        <input 
          type="date" 
          name="due_date" 
          id="due_date" 
          class="form-control <?php echo isset($errors['due_date']) ? 'is-invalid' : ''; ?>" 
          value="<?php echo htmlspecialchars($_POST['due_date'] ?? ''); ?>" 
          required
        >
        <?php if (isset($errors['due_date'])): ?>
          <div class="invalid-feedback">
            <?php echo htmlspecialchars($errors['due_date']); ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="col-md-12">
        <label for="description" class="form-label">Description</label>
        <textarea 
          name="description" 
          id="description" 
          class="form-control"
        ><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
      </div>

      <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select 
          name="status" 
          id="status" 
          class="form-select"
        >
          <option value="open">Open</option>
          <option value="pending">Pending</option>
          <option value="completed">Completed</option>
        </select>
      </div>

      <div class="col-md-6">
        <label for="priority" class="form-label">Priority</label>
        <select 
          name="priority" 
          id="priority" 
          class="form-select"
        >
          <option value="low">Low</option>
          <option value="medium">Medium</option>
          <option value="high">High</option>
        </select>
      </div>

      <div class="col-md-12">
        <label for="tags" class="form-label">Tags</label>
        <input 
          type="text" 
          name="tags" 
          id="tags" 
          class="form-control"
          value="<?php echo htmlspecialchars($_POST['tags'] ?? ''); ?>"
        >
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary">Save Task</button>
        <a href="index.php?controller=task&action=index" class="btn btn-secondary">Back</a>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
