<?php
session_start();

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HomeFinder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="navbar">
        <div class="logo">
            <a href="index.php" style="color:white; text-decoration:none;">HomeFinder</a>
        </div>
        <div class="login-links">
            <a href="index.php?page=sellerlogin">Seller Login</a>
            <a href="index.php?page=buyerlogin">Buyer Login</a>
        </div>
    </div>
</header>

<main>
<section class="content">
<?php
if ($page == 'buyerlogin') {
    include "buyer/buyerlogin.php";
}
elseif ($page == 'buyerregister') {
    include "buyer/buyerregister.php";
}
elseif ($page == 'buyerdashboard') {  
    include "buyerdashboard.php";
}
elseif ($page == 'sellerlogin') {
    include "seller/sellerlogin.php";
}
elseif ($page == 'sellerregister') {
    include "seller/sellerregister.php";
}
elseif ($page == 'sellerdashboard') {  
    include "sellerdashboard.php";
}
else {
?>
    <div class="about">
        <h1>Find Your Perfect Home</h1>
        <p>
            HomeFinder helps you discover the best houses.
        </p>
        <a href="index.php?page=buyerlogin" class="explore-btn">Explore Homes</a>
    </div>
<?php
}
?>
</section>
</main>

<footer class="footer">
    <p>Your trusted partner in finding the perfect home.</p>
</footer>

</body>
</html>
