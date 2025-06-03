<?php
require_once 'db_connect.php';
$db = new Database();

// Fetch books with author names (JOIN for 2NF)
$books = $db->conn->query("
    SELECT Books.*, Authors.author_name 
    FROM Books 
    JOIN Authors ON Books.author_id = Authors.author_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Books</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #2ecc71;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--primary-color);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--accent-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            margin-top: 20px;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #c0392b;
        }

        .btn-secondary {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            margin-left: 10px;
            transition: background 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book List</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Genre</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($book = $books->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author_name']) ?></td>
                    <td><?= htmlspecialchars($book['publication_year']) ?></td>
                    <td><?= htmlspecialchars($book['genre']) ?></td>
                    <td><?= number_format($book['price'], 2) ?> CFA</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="add_book.php" class="btn">Add New Book</a>
        <a href="index.php" class="btn-secondary">Home</a>
    </div>
</body>
</html>