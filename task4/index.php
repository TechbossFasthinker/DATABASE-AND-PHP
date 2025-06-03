<!DOCTYPE html>
<html>
<head>
    <title>OOP Lab</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2980b9;
            --accent: #e74c3c;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            padding: 2rem;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: var(--primary);
            margin-bottom: 2rem;
        }
        .menu {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .btn {
            display: block;
            padding: 1rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .ex1 { background: var(--primary); color: white; }
        .ex2 { background: #2ecc71; color: white; }
        .ex3 { background: #9b59b6; color: white; }
        .ex4 { background: var(--accent); color: white; }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Object-Oriented PHP Lab</h1>
        
        <div class="menu">
            <a href="create_book.php" class="btn ex1">Exercise 1: Classes & Objects</a>
            <a href="test_inheritance.php" class="btn ex2">Exercise 2: Inheritance</a>
            <a href="test_polymorphism.php" class="btn ex3">Exercise 3: Polymorphism</a>
            <a href="library_test.php" class="btn ex4">Exercise 4: Library System</a>
        </div>
    </div>
</body>
</html>