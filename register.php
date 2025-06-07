<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $terms = isset($_POST['terms']);

    // Allow only Gmail
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
        $error = "Only Gmail addresses are allowed.";
    } elseif (!$fullname || !$email || !$password || !$terms) {
        $error = "All fields are required.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $error = "This Gmail is already registered.";
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$fullname, $email, $hashed]);
                $success = "Registration successful. <a href='login.php'>Login now</a>";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!-- HTML Form same as before with added error/success blocks -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header text-center">
            <h3>Register</h3>
          </div>
          <div class="card-body">
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger"><?= $error ?></div>
            <?php elseif (!empty($success)): ?>
              <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            <form action="register.php" method="POST">
              <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="terms" required>
                <label class="form-check-label">
                  I agree to the <a href="#">terms and conditions</a>
                </label>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </form>
          </div>
          <div class="card-footer text-center">
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
