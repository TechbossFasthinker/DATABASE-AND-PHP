<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'LibraryDB');

// Check if we're getting a book ID to edit
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    
    // Fetch the book details
    $stmt = $conn->prepare("SELECT * FROM Books WHERE book_id = ?");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
    
    if (!$book) {
        die("Book not found");
    }
}

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    
    // Validate inputs
    if (!preg_match('/^\d{4}$/', $year)) {
        die("Publication year must be a 4-digit number");
    }
    
    $stmt = $conn->prepare("UPDATE Books SET title=?, author=?, publication_year=?, genre=?, price=? WHERE book_id=?");
    $stmt->bind_param("ssisdi", $title, $author, $year, $genre, $price, $book_id);
    
    if ($stmt->execute()) {
        header("Location: read_books.php?update=success");
        exit();
    } else {
        $error = "Error updating book: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <style>
        .container { max-width: 600px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="number"] { 
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box; 
        }
        .btn { 
            padding: 8px 16px; 
            background: #4CAF50; 
            color: white; 
            border: none; 
            cursor: pointer; 
        }
        .btn:hover { background: #45a049; }
        .back-btn { 
            display: inline-block; 
            margin-top: 20px; 
            background: #337ab7; 
        }
        .back-btn:hover { background: #286090; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>
        
        <?php if (isset($error)): ?>
            <div style="color: red; margin-bottom: 15px;"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="update_book.php">
            <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['book_id']); ?>">
            
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="year">Publication Year:</label>
                <input type="number" id="year" name="year" min="1000" max="9999" 
                       value="<?php echo htmlspecialchars($book['publication_year']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>">
            </div>
            
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" min="0" 
                       value="<?php echo htmlspecialchars($book['price']); ?>" required>
            </div>
            
            <button type="submit" name="update" class="btn">Update Book</button>
        </form>
        
        <a href="read_books.php" class="btn back-btn">Back to Book List</a>
    </div>
</body>
</html>