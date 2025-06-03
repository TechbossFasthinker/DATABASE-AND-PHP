<?php
require_once 'db_connect.php';
$db = new Database();

// Fetch authors for dropdown
$authors = $db->conn->query("SELECT * FROM Authors");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate inputs
    $title = htmlspecialchars($_POST['title']);
    $author_id = intval($_POST['author_id']);
    $year = intval($_POST['year']);
    $genre = htmlspecialchars($_POST['genre']);
    $price = floatval($_POST['price']);

    // Validate year (4 digits)
    if ($year < 1000 || $year > 9999) {
        die("Year must be 4 digits");
    }

    // Insert into database
    $stmt = $db->conn->prepare("INSERT INTO Books (title, author_id, publication_year, genre, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisid", $title, $author_id, $year, $genre, $price);
    $stmt->execute();
    header("Location: view_books.php"); // Redirect after success
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
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

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }

        .btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .btn:hover {
            background-color: #c0392b;
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
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Book</h1>
        <form method="POST">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            <div class="form-group">
                <label>Author</label>
                <select name="author_id" required>
                    <?php while ($author = $authors->fetch_assoc()): ?>
                        <option value="<?= $author['author_id'] ?>"><?= htmlspecialchars($author['author_name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Year</label>
                <input type="number" name="year" min="1000" max="9999" required>
            </div>
            <div class="form-group">
                <label>Genre</label>
                <input type="text" name="genre">
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" step="0.01" min="0" required>
            </div>
            <button type="submit" class="btn">Add Book</button>
            <a href="view_books.php" class="btn-secondary">View Books</a>
        </form>
    </div>
</body>
</html>