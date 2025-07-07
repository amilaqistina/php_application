<?php include 'db.php'; include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_SESSION['full_name'];
    $review = $_POST['review'];
    $status = $_POST['status'];
    $created = date("Y-m-d H:i:s");

    $sql = "INSERT INTO Applications (title, author, review, status, created)
            VALUES ('$title', '$author', '$review', '$status', '$created')";

    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "<div class='alert alert-danger'>Error: {$conn->error}</div>";
    }
}
?>

<h2>Add New Review</h2>
<form method="post">
    <input name="title" class="form-control mb-2" placeholder="App Title" required>
    <textarea name="review" class="form-control mb-2" placeholder="Your review..." required></textarea>
    <select name="status" class="form-control mb-3">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
    <button type="submit" class="btn btn-success">Submit</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
