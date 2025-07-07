<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Check for duplicate email or username
    $check = $conn->query("SELECT * FROM users WHERE email='$email' OR username='$username'");
    if ($check->num_rows > 0) {
        $message = "<div class='alert alert-danger'>❌ Email or username already registered.</div>";
    } else {
        $sql = "INSERT INTO users (full_name, email, username, password, role)
                VALUES ('$full_name', '$email', '$username', '$password', 'user')";
        if ($conn->query($sql)) {
            header("Location: login.php");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>❌ Registration failed: " . $conn->error . "</div>";
        }
    }
}
?>

<h2>Register</h2>
<?= $message ?>

<form method="post">
    <input name="full_name" class="form-control mb-2" placeholder="Full Name" required>
    <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
    <input name="username" class="form-control mb-2" placeholder="Username" required>
    <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
    <button type="submit" class="btn btn-primary">Register</button>
    <a href="login.php" class="btn btn-link">Already have an account?</a>
</form>

</body>
</html>
