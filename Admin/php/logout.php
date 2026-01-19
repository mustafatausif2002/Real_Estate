
<?php
session_start();
session_destroy();

setcookie("admin_email", "", time() - 3600, "/");
setcookie("admin_name", "", time() - 3600, "/");

header("Location: ../html/login.html");
exit();

?>