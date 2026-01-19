<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "db.php";


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php?page=buyerlogin");
    exit;
}


$msg_success = "";
$msg_error = "";

if (isset($_POST['send_message'])) {
    if (empty($_POST['message'])) {
        $msg_error = "Message cannot be empty.";
    } else {
        $message = $conn->real_escape_string($_POST['message']);

        $sql = "INSERT INTO buyermessages (message) VALUES ('$message')";

        if ($conn->query($sql)) {
            $msg_success = "Message sent successfully!";
        } else {
            $msg_error = "Failed to send message.";
        }
    }
}


$result = $conn->query("SELECT * FROM properties ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buyer Dashboard</title>
    <link rel="stylesheet" href="buyerdashboard.css">
</head>
<body>

<div class="auth-box">

    <h1>Available Properties</h1>

    <form method="post">
        <button type="submit" name="logout" class="btn-delete">Logout</button>
    </form>

    
    <h3>Send Message to Admin</h3>

    <?php if ($msg_success) { ?>
        <div class="auth-success"><?php echo $msg_success; ?></div>
    <?php } ?>

    <?php if ($msg_error) { ?>
        <div class="auth-error"><?php echo $msg_error; ?></div>
    <?php } ?>

    <form method="post">
        <textarea name="message" rows="4" placeholder="Write your message here..."></textarea><br><br>
        <button type="submit" name="send_message" class="btn-submit">Send Message</button>
    </form>

    
    <?php if ($result && $result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Seller Email</th>
                <th>Title</th>
                <th>Location</th>
                <th>Price</th>
                <th>Description</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['seller_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p class="no-data">No properties available.</p>
    <?php } ?>

</div>

</body>
</html>
