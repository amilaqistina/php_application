<?php include 'db.php'; include 'header.php'; ?>

<div class="container">
    <h2>Manage Categories</h2>

    <!-- Add Category Form -->
    <form method="post" class="mb-3">
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="title" class="form-control" placeholder="New Category Title" required>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success">Add Category</button>
            </div>
        </div>
    </form>

    <?php
    // Add new category
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
        $title = trim($_POST['title']);
        $status = $_POST['status'];
        $conn->query("INSERT INTO categories (title, status, created, modified)
                      VALUES ('$title', '$status', NOW(), NOW())");
    }

    // Delete category
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $conn->query("DELETE FROM categories WHERE id = $id");
        header("Location: categories.php");
    }

    // List all categories
    $result = $conn->query("SELECT * FROM categories ORDER BY created DESC");
    ?>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($cat = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($cat['title']) ?></td>
                <td><?= $cat['status'] ?></td>
                <td><?= $cat['created'] ?></td>
                <td><?= $cat['modified'] ?></td>
                <td>
                    <a href="categories.php?delete=<?= $cat['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Delete this category?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
