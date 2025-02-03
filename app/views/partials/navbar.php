<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php?controller=task&action=index">Task Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- Display when the user is logged in -->
          <li class="nav-item">
            <span class="navbar-text me-3">
              Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
            </span>
          </li>
          <li class="nav-item">
            <a href="index.php?controller=auth&action=logout" class="nav-link text-danger">Logout</a>
          </li>
        <?php else: ?>
          <!-- Display when the user is not logged in -->
          <li class="nav-item">
            <a href="index.php?controller=auth&action=showLogin" class="nav-link">Login</a>
          </li>
          <li class="nav-item">
            <a href="index.php?controller=auth&action=showRegister" class="nav-link">Register</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
