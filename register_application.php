<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category_id'];
    $date = $_POST['posted_date'];
    $author = $_POST['author'];
    $title = $_POST['title'];
    $review = $_POST['review'];
    $image = $_POST['image'];
    $image_dir = $_POST['image_dir'];
    $status = $_POST['status'];
    $created = $_POST['created'];
    $modified = $_POST['modified'];
    
    

    $sql = "INSERT INTO applications (category_id, posted_date, author, title, review, image, image_dir, status, created, modified)
            VALUES ('$category', '$date', '$author', '$title', '$review','$image', '$image_dir', '$status', '$created', '$modified')";
    if (mysqli_query($conn, $sql)) {
        echo "Registered! <a href='index.php'>View Applications</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
  <input type="text" name="category_id" placeholder="Category ID" required><br>
  <input type="date" name="posted_date" placeholder="Date" required><br>
  <input type="text" name="author" placeholder="Author" required><br>
  <input type="title" name="title" placeholder="Title" required><br>
  <input type="text" name="review" placeholder="Review" required><br>
  <input type="image" name="image" placeholder="Author Image" required><br>
  <input type="image" name="image_dir" placeholder="Application Image" required><br>
  <input type="text" name="status" placeholder="Status" required><br><button type="submit">Register</button>
</form>
