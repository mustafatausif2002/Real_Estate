<?php
session_start();

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_email'])) {
    header("Location: ../html/login.html");
    exit;
}

header("Location: ../html/dashboard.html");
exit;
?>


