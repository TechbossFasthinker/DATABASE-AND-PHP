<?php
require_once 'Product.php';
require_once 'BookInherited.php';

$product = new Product("Generic Item", 9.99);
$book = new Book("Weep Not, Child", 14.99, "Ngũgĩ wa Thiong'o", 1964, "African Literature");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inheritance Test</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #2ecc71;
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
            line-height: 1.6;
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
            margin-bottom: 2rem;
            font-weight: 600;
        }

        h2 {
            color: var(--dark-color);
            margin-bottom: 1rem;
            font-weight: 500;
            font-size: 1.3rem;
        }

        .section {
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .product-card, .book-card {
            background: var(--light-color);
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .product-card {
            border-left: 4px solid var(--accent-color);
        }

        .book-card {
            border-left: 4px solid var(--primary-color);
        }

        .product-card h3, .book-card h3 {
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .product-card p, .book-card p {
            margin: 0.3rem 0;
            color: #555;
        }

        .property-display {
            background: white;
            padding: 0.8rem;
            border-radius: 6px;
            margin-top: 1rem;
            border: 1px solid #eee;
            font-family: monospace;
        }

        .property-display p {
            margin: 0.3rem 0;
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
            margin-top: 1rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
        }

        .btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .type-label {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: var(--dark-color);
            color: white;
            border-radius: 50px;
            font-size: 0.8rem;
            margin-bottom: 0.8rem;
            font-weight: 500;
        }

        .product-card .type-label {
            background: var(--accent-color);
        }

        .book-card .type-label {
            background: var(--primary-color);
        }

        .hierarchy {
            margin-top: 1rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Inheritance Demonstration</h1>
        
        <div class="section">
            <h2>Parent Product Class</h2>
            <div class="type-label">Product</div>
            <?= $product->displayProduct() ?>
            <div class="property-display">
                <p><strong>Class:</strong> <?= get_class($product) ?></p>
                <p><strong>Parent:</strong> None</p>
                <p><strong>Methods:</strong> getName(), getPrice(), displayProduct()</p>
                <div class="hierarchy">Class Hierarchy: Product</div>
            </div>
        </div>

        <div class="section">
            <h2>Child Book Class</h2>
            <div class="type-label">Book (extends Product)</div>
            <?= $book->displayProduct() ?>
            <div class="property-display">
                <p><strong>Class:</strong> <?= get_class($book) ?></p>
                <p><strong>Parent:</strong> <?= get_parent_class($book) ?></p>
                <p><strong>Author Access:</strong> <?= $book->getAuthor() ?></p>
                <p><strong>Inherited Methods:</strong> getName(), getPrice()</p>
                <p><strong>Own Methods:</strong> getAuthor(), getYear(), getGenre()</p>
                <div class="hierarchy">Class Hierarchy: Product → Book</div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="btn">Back to Menu</a>
        </div>
    </div>
</body>
</html>