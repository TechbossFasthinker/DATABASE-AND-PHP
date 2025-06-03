<?php
$conn = new mysqli('localhost', 'username', 'password', 'LibrarySystemDB');

$title = $_POST['title'];
$author_id = $_POST['author_id'];
$genre = $_POST['genre'];
$price = $_POST['price'];

// Validate price
if (!is_numeric($price) || $price <= 0) {
    die("Invalid price");
}

$stmt = $conn->prepare("INSERT INTO Books (title, author_id, genre, price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sisd", $title, $author_id, $genre, $price);
$stmt->execute();
echo "Book added successfully!";
?>