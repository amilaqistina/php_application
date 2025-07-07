<?php
include 'db.php';
include 'header.php';

// Handle new application submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $author = $conn->real_escape_string(trim($_POST['author']));
    $title = $conn->real_escape_string(trim($_POST['title']));
    $review = $conn->real_escape_string(trim($_POST['review']));
    $status = 'active';

    $conn->query("INSERT INTO applications (category_id, author, title, review, status)
                  VALUES (1, '$author', '$title', '$review', '$status')");
    header("Location: index.php");
    exit;
}

// Fetch all applications
$apps = $conn->query("SELECT * FROM applications ORDER BY created DESC");
?>

<div class="container mt-4">
    <div class="card border-info shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">📋 Submit New Application</h4>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" name="author" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Application Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Application Description</label>
                    <textarea name="review" class="form-control" required></textarea>
                </div>

                <button class="btn btn-info text-white">Submit Application</button>
            </form>
        </div>
    </div>

    <h4 class="text-info mb-3">📂 All Applications</h4>

    <?php if ($apps->num_rows === 0): ?>
        <p class="text-muted">No applications submitted yet.</p>
    <?php else: ?>
        <?php while ($a = $apps->fetch_assoc()): ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($a['title']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($a['review'])) ?></p>
                    <small class="text-muted">By <?= htmlspecialchars($a['author']) ?> on <?= date("d M Y", strtotime($a['created'])) ?></small><br>
                    <a href="comments.php?app=<?= $a['id'] ?>" class="btn btn-sm btn-outline-primary mt-2">💬 View/Add Comments</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
