<?php
require_once 'auth_db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'All fields are required!';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format!';
    } else {
        // Check if user exists
        $stmt = $authDB->conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = 'Username or email already exists!';
        } else {
            // Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert = $authDB->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $username, $email, $hashed_password);

            if ($insert->execute()) {
                header("Location: login.php?registration=success");
                exit();
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register | Library System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --error: #e74c3c;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fa;
            padding: 2rem;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h1 {
            color: var(--primary);
            text-align: center;
        }
        .error {
            color: var(--error);
            margin-bottom: 1rem;
            text-align: center;
        }
        input {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }
        a {
            color: var(--primary);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Register</h1>
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>
        <p style="text-align: center; margin-top: 1rem;">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </div>
</body>
</html>