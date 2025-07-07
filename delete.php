<?php
include 'db.php';
include 'session.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Applications WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SESSION['role'] !== 'admin' && $row['author'] !== $_SESSION['full_name']) {
    echo "Unauthorized delete.";
    exit();
}

$conn->query("DELETE FROM Applications WHERE id=$id");
header("Location: index.php");
?>
