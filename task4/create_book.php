<?php
require_once 'BookStandalone.php';

$book = new Book(
    "Things Fall Apart",
    "Chinua Achebe",
    1958,
    "African Literature",
    24.99
);

$book2 = new Book(
    "The River Between",
    "Ngũgĩ wa Thiong'o",
    1965,
    "African Literature",
    19.99
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Objects</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2980b9;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 2rem;
        }
        .book-card {
            background: var(--light);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary);
        }
        .btn {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book Objects Demonstration</h1>
        <?= $book->displayInfo() ?>
        <?= $book2->displayInfo() ?>
        <a href="index.php" class="btn">Back to Menu</a>
    </div>
</body>
</html>
