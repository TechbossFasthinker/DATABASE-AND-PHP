<?php
require_once 'auth_check.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 2rem;
            text-align: center;
        }
        h1 {
            color: #3498db;
        }
        a {
            color: #e74c3c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>You are now logged in to the Library System.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>