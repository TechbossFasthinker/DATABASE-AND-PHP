<?php
session_start();
require_once 'auth_db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Fetch user from database
    $stmt = $authDB->conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = 'Invalid username or password!';
        }
    } else {
        $error = 'Invalid username or password!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login | Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --error: #e74c3c;
            --success: #2ecc71;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            padding: 2rem;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: var(--primary);
            text-align: center;
            margin-top: 0;
            margin-bottom: 1.5rem;
        }
        .error {
            color: var(--error);
            margin-bottom: 1rem;
            text-align: center;
            padding: 0.5rem;
            background-color: #fdedee;
            border-radius: 4px;
        }
        .success {
            color: var(--success);
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background-color: #edf7ee;
            border-radius: 4px;
        }
        input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        input:focus {
            outline: none;
            border-color: var(--primary);
        }
        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #2980b9;
        }
        .form-footer {
            text-align: center;
            margin-top: 1rem;
            color: #666;
        }
        a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Login</h1>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['registration'])): ?>
            <div class="success">
                Registration successful! Please login.
            </div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="form-footer">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
</body>
</html>