<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h2>Welcome to Admin Panel</h2>
    <p><a href="manage_products.php">Manage Products</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
