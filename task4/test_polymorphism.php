<?php
require_once 'Product.php';
require_once 'BookInherited.php';

class Ebook extends Book {
    private $fileFormat;
    private $fileSize;

    public function __construct($title, $price, $author, $year, $format, $size = 0) {
        parent::__construct($title, $price, $author, $year, "Ebook");
        $this->fileFormat = htmlspecialchars($format);
        $this->fileSize = intval($size);
    }

    public function displayProduct() {
        return sprintf(
            "<div class='product-content'>
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
}

$products = [
    new Product("Library Membership", 10.00),
    new Book("Petals of Blood", 22.50, "Ngũgĩ wa Thiong'o", 1977, "Novel"),
    new Ebook("Devil on the Cross", 15.99, "Ngũgĩ wa Thiong'o", 1980, "PDF", 2.4)
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Polymorphism</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --ebook-color: #9b59b6;
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

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 2rem;
            color: #666;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .product-card {
            background: var(--light-color);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 4px solid var(--accent-color);
        }

        .book-card {
            border-left-color: var(--primary-color);
        }

        .ebook-card {
            border-left-color: var(--ebook-color);
        }

        .product-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-type {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: var(--dark-color);
            color: white;
            border-radius: 50px;
            font-size: 0.8rem;
            margin-bottom: 0.8rem;
            font-weight: 500;
            align-self: flex-start;
        }

        .product-card .product-type {
            background: var(--accent-color);
        }

        .book-card .product-type {
            background: var(--primary-color);
        }

        .ebook-card .product-type {
            background: var(--ebook-color);
        }

        .product-content h3 {
            color: var(--dark-color);
            margin-bottom: 0.8rem;
            font-size: 1.2rem;
        }

        .product-content p {
            margin: 0.3rem 0;
            color: #555;
        }

        .class-info {
            margin-top: auto;
            padding: 0.8rem;
            background: white;
            border-radius: 6px;
            border: 1px solid #eee;
            font-family: monospace;
            font-size: 0.9rem;
        }

        .class-info p {
            margin: 0.3rem 0;
            color: #333;
        }

        .btn {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn-container {
            text-align: center;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Polymorphism Demonstration</h1>
        <p class="subtitle">Different product types treated uniformly through inheritance</p>
        
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="<?php 
                    echo get_class($product) === 'Product' ? 'product-card' : 
                         (get_class($product) === 'Book' ? 'book-card' : 'ebook-card');
                ?>">
                    <?= $product->displayProduct() ?>
                    <div class="class-info">
                        <p><strong>Class:</strong> <?= get_class($product) ?></p>
                        <p><strong>Parent:</strong> <?= get_parent_class($product) ?: 'None' ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="btn-container">
            <a href="index.php" class="btn">Back to Menu</a>
        </div>
    </div>
</body>
</html>