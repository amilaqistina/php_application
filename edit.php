<?php include 'db.php'; include 'header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM Applications WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SESSION['role'] !== 'admin' && $row['author'] !== $_SESSION['full_name']) {
    echo "<div class='alert alert-danger'>Unauthorized access.</div>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $review = $_POST['review'];
    $status = $_POST['status'];
    $modified = date("Y-m-d H:i:s");

    $sql = "UPDATE Applications SET 
            title='$title', review='$review',
            status='$status', modified='$modified'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Error: {$conn->error}</div>";
    }
}
?>

<h2>Edit Review</h2>
<form method="post">
    <input name="title" class="form-control mb-2" value="<?= $row['title'] ?>" required>
    <textarea name="review" class="form-control mb-2"><?= $row['review'] ?></textarea>
    <select name="status" class="form-control mb-3">
        <option value="active" <?= $row['status'] == 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= $row['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
    </select>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
