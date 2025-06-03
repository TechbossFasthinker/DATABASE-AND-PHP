<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'LibraryDB');
$result = $conn->query("SELECT * FROM Books ORDER BY title");

// Display success messages
$message = '';
if (isset($_GET['update']) && $_GET['update'] == 'success') {
    $message = "Book updated successfully!";
}
if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
    $message = "Book deleted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .message { 
            padding: 10px; 
            margin-bottom: 20px; 
            background: #dff0d8; 
            color: #3c763d;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
        }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .action-btns a { 
            padding: 4px 8px; 
            text-decoration: none; 
            margin-right: 5px;
            border-radius: 3px;
        }
        .edit-btn { background: #5bc0de; color: white; }
        .edit-btn:hover { background: #46b8da; }
        .delete-btn { background: #d9534f; color: white; }
        .delete-btn:hover { background: #c9302c; }
        .add-btn { 
            display: inline-block; 
            padding: 8px 16px; 
            background: #5cb85c; 
            color: white; 
            text-decoration: none;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .add-btn:hover { background: #4cae4c; }
    </style>
</head>
<body>
    <h1>Book List</h1>
    
    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    
    <a href="create_book.php" class="add-btn">Add New Book</a>
    <a href="index.php" class="add-btn">Home</a>
    
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
            <td><?php echo htmlspecialchars($row['publication_year']); ?></td>
            <td><?php echo htmlspecialchars($row['genre']); ?></td>
            <td><?php echo number_format($row['price'], 2); ?> CFA</td>
            <td class="action-btns">
                <a href="update_book.php?id=<?php echo $row['book_id']; ?>" class="edit-btn">Edit</a>
                <a href="delete_book.php?id=<?php echo $row['book_id']; ?>" class="delete-btn">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>