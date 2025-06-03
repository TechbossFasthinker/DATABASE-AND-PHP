<?php
require_once 'BookInherited.php';

/**
 * Ebook.php
 * Child class demonstrating:
 * - Multi-level inheritance
 * - Specialized properties
 * - Method overriding
 */
class Ebook extends Book {
    private $fileFormat;
    private $fileSize;

    public function __construct($title, $price, $author, $year, $format, $size = 0) {
        parent::__construct($title, $price, $author, $year, "E-Book");
        $this->fileFormat = htmlspecialchars($format);
        $this->fileSize = intval($size);
    }

    public function displayProduct() {
        return sprintf(
            "<div class='ebook-card'>
                <span class='product-type'>E-Book</span>
                <h3>%s</h3>
                <p><strong>Author:</strong> %s</p>
                <p><strong>Year:</strong> %d</p>
                <p><strong>Format:</strong> %s</p>
                <p><strong>Size:</strong> %s MB</p>
                <p><strong>Price:</strong> %.2f CFA</p>
            </div>",
            $this->getName(),
            $this->getAuthor(),
            $this->getYear(),
            $this->fileFormat,
            $this->fileSize > 0 ? $this->fileSize : 'Unknown',
            $this->getPrice()
        );
    }

    // Ebook-specific methods
    public function getFileFormat() { return $this->fileFormat; }
    public function getFileSize() { return $this->fileSize; }
}
?>