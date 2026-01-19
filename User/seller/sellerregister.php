<?php
include "db.php";

$fullname = $email = "";
$success = "";
$error = "";

$fullnameErr = $emailErr = $passwordErr = $confirmErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fullname"])) {
        $fullnameErr = "Full name is required";
    } else {
        $fullname = trim($_POST["fullname"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
            $fullnameErr = "Only letters and white space allowed";
        }
    }

   
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = trim($_POST["email"]);
        if (!preg_match("/^[a-z0-9\.]+@[a-z0-9]+\.[a-z]{2,}$/", $email)) {
            $emailErr = "Invalid email format (example: emran@gmail.com)";
        }
    }

  
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    }

    
    if (empty($_POST["confirm_password"])) {
        $confirmErr = "Confirm password is required";
    } elseif ($_POST["password"] !== $_POST["confirm_password"]) {
        $confirmErr = "Password and Confirm Password do not match";
    }

    
    if (empty($fullnameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmErr)) {
        $hashPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO seller (fullname, email, password)
                VALUES ('$fullname', '$email', '$hashPassword')";

        if ($conn->query($sql)) {
            $success = "Registration complete!";
            $fullname = $email = "";
        } else {
            $error = "Email already exists or database error";
        }
    } else {
        
        $error = $fullnameErr . " " . $emailErr . " " . $passwordErr . " " . $confirmErr;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    >
    <title>Seller Registration</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>

<div class="auth-box">
    <h2>Seller Registration</h2>

    

    <form method="POST" action="">

        <input type="text" name="fullname" placeholder="Full Name" value="<?php echo htmlspecialchars($fullname); ?>">

        <input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">

        <input type="password" name="password" placeholder="Password">

        <input type="password" name="confirm_password" placeholder="Confirm Password">
        
         <?php if ($success) { ?>
        <div class="auth-success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if ($error) { ?>
        <div class="auth-error"><?php echo $error; ?></div>
    <?php } ?>

        <button type="submit" class="btn-submit">Register</button>
    </form>

    <p class="link-text">
        <a href="index.php?page=sellerlogin">Login</a>
    </p>
</div>

</body>
</html>
