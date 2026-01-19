<?php
include "db.php"; 


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        
        $sql = "SELECT * FROM seller WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

           
            if (password_verify($password, $row['password'])) {
                
                $_SESSION['seller_email'] = $email;
                header("Location: index.php?page=sellerdashboard");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Seller not found.";
        }
    }
}
?>

<link rel="stylesheet" href="auth.css">

<div class="auth-box">
    <h2>Seller Login</h2>

    <form method="POST">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <?php if ($error) echo '<div class="auth-error">'.$error.'</div>'; ?>

        <button type="submit" name="login">Login</button>
    </form>

    <p class="link-text">
        New seller? <a href="index.php?page=sellerregister">Register</a>
    </p>
</div>
