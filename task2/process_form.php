<?php
$conn = new mysqli('localhost', 'root', '', 'WebAppDB');

$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("
        <!DOCTYPE html>
        <html>
        <head>
            <title>Error</title>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f5f7fa; padding: 20px; }
                .error-container { 
                    max-width: 600px; 
                    margin: 50px auto; 
                    padding: 20px; 
                    background-color: #fff; 
                    border-radius: 5px; 
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                .error-message {
                    color: #e74c3c;
                    margin-bottom: 20px;
                }
                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #3498db;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                }
            </style>
        </head>
        <body>
            <div class='error-container'>
                <div class='error-message'>Invalid email format</div>
                <a href='index.php' class='btn'>Go Back</a>
            </div>
        </body>
        </html>
    ");
}

$stmt = $conn->prepare("INSERT INTO Users (name, email, age) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $name, $email, $age);
$stmt->execute();

echo "
<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f7fa; padding: 20px; }
        .success-container { 
            max-width: 600px; 
            margin: 50px auto; 
            padding: 20px; 
            background-color: #fff; 
            border-radius: 5px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-message {
            color: #2ecc71;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class='success-container'>
        <div class='success-message'>User added successfully!</div>
        <a href='view_users.php' class='btn'>View Users</a>
        <a href='index.php' class='btn'>Add Another User</a>
    </div>
</body>
</html>
";
?>