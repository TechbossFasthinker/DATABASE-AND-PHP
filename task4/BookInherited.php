<?php
require_once 'Product.php';

/**
 * BookInherited.php
 * Extended version with inheritance
 */
class Book extends Product {
    private $author;
    private $year;
    private $genre;

    public function __construct($title, $price, $author, $year, $genre = 'General') {
        parent::__construct($title, $price);
        $this->author = htmlspecialchars($author);
        $this->year = intval($year);
        $this->genre = htmlspecialchars($genre);
    }

    public function displayProduct() {
        return sprintf(
            "<div class='book-card'>
                <h3>%s</h3>
                <p><strong>Type:</strong> Book</p>
                <p><strong>Author:</strong> %s</p>
                <p><strong>Year:</strong> %d</p>
                <p><strong>Genre:</strong> %s</p>
                <p><strong>Price:</strong> %.2f CFA</p>
            </div>",
            $this->product_name,
            $this->author,
            $this->year,
            $this->genre,
            $this->product_price
        );
    }

    public function getAuthor() { return $this->author; }
    public function getName() { return $this->product_name; }
    public function getYear() { return $this->year; }
    public function getGenre() { return $this->genre; }
}
?>