<?php
include "../db/db.php";

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = trim($_POST["name"]);
    $email    = trim($_POST["email"]);
    $phone    = trim($_POST["phone"]);
    $password = trim($_POST["password"]);

    if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        $error = "All fields are required";
    }

    elseif (strlen($name) < 3) {
        $error = "Name must be at least 3 characters long";
    }

    elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $error = "Name can contain only letters and spaces";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    }

    elseif (!ctype_digit($phone)) {
        $error = "Phone number must contain only digits";
    }

    elseif (strlen($phone) != 11) {
        $error = "Phone number must be exactly 11 digits";
    }

    elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    }

    else {

        $check = "SELECT * FROM Admins WHERE email='$email'";
        $result = $conn->query($check);

        if ($result->num_rows > 0) {
            $error = "Email already exists";
        } 
        else {
            $sql = "INSERT INTO Admins (name, email, phone, password)
                    VALUES ('$name', '$email', '$phone', '$password')";

            if ($conn->query($sql)) {
                $success = "Registration successful. <a href='../html/login.html'>Login here</a>";
            } 
            else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}

if ($success) echo "<p style='color:green;'>$success</p>";
if ($error) echo "<p style='color:red;'>$error</p>";
?>
