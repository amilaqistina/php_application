<?php
session_start();
include 'db.php';
if ($_SESSION['role'] != 'admin') {
    echo "Access denied!";
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE role='student'");
echo "<a href='index.php'>Back</a><h3>Student List</h3><table border='1'>";
echo "<tr><th>Name</th><th>Email</th><th>Username</th><th>Actions</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['full_name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['username']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Edit</a> |
            <a href='delete.php?id={$row['id']}'>Delete</a>
        </td>
    </tr>";
}
echo "</table>";
?>