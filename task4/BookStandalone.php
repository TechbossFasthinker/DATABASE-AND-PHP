<?php
/**
 * BookStandalone.php
 * Complete standalone book class implementation
 */
class Book {
    private $title;
    private $author;
    private $year;
    private $genre;
    private $price;

    public function __construct($title, $author, $year, $genre, $price) {
        $this->title = htmlspecialchars($title);
        $this->author = htmlspecialchars($author);
        $this->year = intval($year);
        $this->genre = htmlspecialchars($genre);
        $this->price = floatval($price);
    }

    public function displayInfo() {
        return sprintf(
            "<div class='book-card'>
                <h3>%s</h3>
                <p><strong>Author:</strong> %s</p>
                <p><strong>Year:</strong> %d</p>
                <p><strong>Genre:</strong> %s</p>
                <p><strong>Price:</strong> %.2f CFA</p>
            </div>",
            $this->title,
            $this->author,
            $this->year,
            $this->genre,
            $this->price
        );
    }

    // Getters
    public function getTitle() { return $this->title; }
    public function getAuthor() { return $this->author; }
    public function getYear() { return $this->year; }
    public function getGenre() { return $this->genre; }
    public function getPrice() { return $this->price; }
}
?>