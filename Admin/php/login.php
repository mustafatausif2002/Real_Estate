<?php
session_start();
include "../db/db.php";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    $emailErr = "";
    if (empty($email)) {
        echo "Email is required";
        exit;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
            exit;
        }
    }

   
    if (empty($password)) {
        echo "Password is required";
        exit;
    }

 
    $sql = "SELECT * FROM Admins WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();

        if ($admin['password'] === $password) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['name'];

            setcookie("admin_email", $email, time() + 86400, "/");
            setcookie("admin_name", $admin['name'], time() + 86400, "/");

            header("Location: ../html/dashboard.html");
            exit;
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "Admin not found";
    }
}
?>
