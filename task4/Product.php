<?php
/**
 * Product.php
 * Base class for all products in the system
 * Demonstrates:
 * - Basic class structure
 * - Protected properties for inheritance
 * - Common product functionality
 */
class Product {
    protected $product_name;
    protected $product_price;

    public function __construct($name, $price) {
        $this->product_name = htmlspecialchars($name);
        $this->product_price = floatval($price);
    }

    public function displayProduct() {
        return sprintf(
            "<div class='product-card'>
                <h3>%s</h3>
                <p><strong>Price:</strong> %.2f CFA</p>
            </div>",
            $this->product_name,
            $this->product_price
        );
    }

    // Getters
    public function getName() { return $this->product_name; }
    public function getPrice() { return $this->product_price; }
}
?>