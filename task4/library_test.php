<?php
require_once 'Product.php';
require_once 'BookInherited.php';
require_once 'Ebook.php';

/**
 * Library System Class
 */
class Library {
    private $collection = [];

    public function addItem(Product $item) {
        $this->collection[] = $item;
    }

    public function displayCollection() {
        $output = "";
        foreach ($this->collection as $item) {
            $output .= $item->displayProduct();
        }
        return $output;
    }

    public function getTotalValue() {
        $total = 0;
        foreach ($this->collection as $item) {
            $total += $item->getPrice();
        }
        return number_format($total, 2);
    }
}

// Create library instance
$library = new Library();

// Add sample items
$library->addItem(new Book("Things Fall Apart", 24.99, "Chinua Achebe", 1958, "Novel"));
$library->addItem(new Book("Petals of Blood", 22.50, "Ngũgĩ wa Thiong'o", 1977, "Novel"));
$library->addItem(new Ebook("Weep Not, Child", 15.99, "Ngũgĩ wa Thiong'o", 1964, "EPUB"));
$library->addItem(new Product("Library Membership Card", 5.00));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2980b9;
            --accent: #e74c3c;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --ebook: #9b59b6;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            padding: 2rem;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: var(--primary);
            text-align: center;
            margin-bottom: 2rem;
        }
        .library-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .total-value {
            background: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 500;
        }
        .collection {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        .product-card, .book-card, .ebook-card {
            background: var(--light);
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }
        .book-card {
            border-left-color: var(--secondary);
        }
        .ebook-card {
            border-left-color: var(--ebook);
        }
        .product-type {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            background: var(--dark);
            color: white;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }
        .btn {
            display: inline-block;
            background: var(--accent);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="library-header">
            <h1>Library Collection</h1>
            <div class="total-value">Total Value: <?= $library->getTotalValue() ?> CFA</div>
        </div>

        <div class="collection">
            <?= $library->displayCollection() ?>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="btn">Back to Menu</a>
        </div>
    </div>
</body>
</html>

