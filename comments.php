<?php include 'db.php'; include 'header.php';

if (!isset($_GET['app'])) {
    echo "<div class='alert alert-danger'>No application selected.</div>";
    exit;
}

$app_id = $_GET['app'];
$app = $conn->query("SELECT * FROM applications WHERE id = $app_id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);
    $rating = $_POST['rating'];
    $status = 'active';

    $conn->query("INSERT INTO comments (application_id, name, comment, rating, status) 
                  VALUES ('$app_id', '$name', '$comment', '$rating', '$status')");
}
?>

<div class="container">
    <h3>Comments for: <?= $app['title']; ?></h3>

    <!-- Add Comment Form -->
    <form method="post" class="mb-4">
        <input name="name" class="form-control mb-2" placeholder="Your name" required>
        <textarea name="comment" class="form-control mb-2" placeholder="Your comment" required></textarea>
        <select name="rating" class="form-select mb-2" required>
            <option value="">Rating</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?> ★</option>
            <?php endfor; ?>
        </select>
        <button class="btn btn-primary">Submit Comment</button>
    </form>

    <!-- Display Comments -->
    <?php
    $comments = $conn->query("SELECT * FROM comments WHERE application_id = $app_id ORDER BY created DESC");
    while ($c = $comments->fetch_assoc()):
    ?>
        <div class="card mb-2">
            <div class="card-body">
                <h5><?= htmlspecialchars($c['name']) ?> - <?= $c['rating'] ?> ★</h5>
                <p><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
                <small class="text-muted">Posted: <?= date("d M Y H:i", strtotime($c['created'])) ?></small>
            </div>
        </div>
    <?php endwhile; ?>
</div>
