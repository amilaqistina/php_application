<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<?php
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query to fetch user
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Wrong password.";
        }
    } else {
        $error = "❌ Username not found.";
    }
}
?>

<h2>Login</h2>
<?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post">
    <input name="username" class="form-control mb-2" placeholder="Username" required>
    <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-link">Register</a>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
