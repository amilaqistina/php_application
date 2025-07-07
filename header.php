<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mobile App Review</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #e6f2ff;">

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #b3d9ff;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">📱 App Reviews</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">🏠 Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="comments.php?app=1">💬 Comments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">📁 Categories</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <?php if (isset($_SESSION['username'])): ?>
          <li class="nav-item">
            <span class="nav-link text-dark">👋 Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-danger btn-sm ms-2" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="btn btn-outline-primary btn-sm me-2" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary btn-sm" href="register.php">Register</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
