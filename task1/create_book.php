<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'LibraryDB');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];

    // Validate year is 4 digits
    if (!preg_match('/^\d{4}$/', $year)) {
        die("Publication year must be a 4-digit number");
    }

    $stmt = $conn->prepare("INSERT INTO Books (title, author, publication_year, genre, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisd", $title, $author, $year, $genre, $price);

    if ($stmt->execute()) {
        $success = "Book added successfully!";
    } else {
        $error = "Error adding book: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
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

        .form-container {
            max-width: 600px;
            margin: 2rem auto;
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        form input[type="text"],
        form input[type="number"],
        form select {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="submit"] {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color:rgb(43, 113, 192);
        }

        .btn-secondary {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-size: 1rem;
            margin-top: 1rem;
            transition: background 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--secondary-color);
        }

        .message {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-weight: 500;
        }

        .success {
            background-color: var(--success-color);
            color: white;
        }

        .error {
            background-color: var(--accent-color);
            color: white;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Book</h1>

        <?php if (isset($success)): ?>
            <div class="message success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="create_book.php">
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="author" placeholder="Author" required>
            <input type="number" name="year" placeholder="Year (e.g., 2020)" min="1000" max="9999" required>
            <select name="genre" required>
                <option value="">Select Genre</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <input type="number" name="price" placeholder="Price (e.g., 19.99)" step="0.01" min="0" required>
            <input type="submit" value="Add Book">
        </form>

        <a class="btn-secondary" href="read_books.php">View Books</a>
        <a class="btn-secondary" href="index.php">Home</a>
    </div>
</body>
</html>
