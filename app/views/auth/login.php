<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="mb-3">Login</h2>
            <?php if (isset($_GET['error'])): ?>
              <div class="alert alert-danger">
                Incorrect username or password.
              </div>
            <?php endif; ?>

            <form method="POST" action="index.php?controller=auth&action=login">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                  type="text"
                  name="username"
                  id="username"
                  class="form-control"
                  required
                >
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                  type="password"
                  name="password"
                  id="password"
                  class="form-control"
                  required
                >
              </div>
              <button type="submit" class="btn btn-primary w-100">
                Login
              </button>
            </form>

            <p class="mt-3">
              Don't have an account?
              <a href="index.php?controller=auth&action=showRegister">Register here</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
