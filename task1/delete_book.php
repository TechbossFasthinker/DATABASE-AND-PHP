<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'LibraryDB');

// Check if book ID is provided
if (!isset($_GET['id'])) {
    header("Location: read_books.php");
    exit();
}

$book_id = $_GET['id'];

// Handle deletion confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm_delete'])) {
        $stmt = $conn->prepare("DELETE FROM Books WHERE book_id = ?");
        $stmt->bind_param("i", $book_id);
        
        if ($stmt->execute()) {
            header("Location: read_books.php?delete=success");
            exit();
        } else {
            $error = "Error deleting book: " . $conn->error;
        }
    } else {
        // User clicked cancel
        header("Location: read_books.php");
        exit();
    }
}

// Fetch book details for confirmation message
$stmt = $conn->prepare("SELECT title, author FROM Books WHERE book_id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if (!$book) {
    die("Book not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Book</title>
    <style>
        .container { max-width: 600px; margin: 0 auto; text-align: center; }
        .confirmation { margin: 30px 0; font-size: 18px; }
        .btn { 
            padding: 8px 16px; 
            margin: 0 10px; 
            color: white; 
            border: none; 
            cursor: pointer; 
            text-decoration: none;
            display: inline-block;
        }
        .delete-btn { background: #d9534f; }
        .delete-btn:hover { background: #c9302c; }
        .cancel-btn { background: #337ab7; }
        .cancel-btn:hover { background: #286090; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delete Book</h1>
        
        <?php if (isset($error)): ?>
            <div style="color: red; margin-bottom: 15px;"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <div class="confirmation">
            Are you sure you want to delete:<br>
            <strong><?php echo htmlspecialchars($book['title']); ?></strong> by 
            <strong><?php echo htmlspecialchars($book['author']); ?></strong>?
        </div>
        
        <form method="POST" action="delete_book.php?id=<?php echo htmlspecialchars($book_id); ?>">
            <button type="submit" name="confirm_delete" class="btn delete-btn">Yes, Delete</button>
            <a href="read_books.php" class="btn cancel-btn">Cancel</a>
        </form>
    </div>
</body>
</html>