<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_email'])) {
    header("Location: ../html/login.html");
    exit;
}

$sql = "
SELECT i.inquiry_id, i.message, i.response, i.property_id, i.buyer_id, u.name AS buyer_name, u.email AS buyer_email, 
p.title AS property_title, p.location, p.price
FROM Inquiries i
JOIN Users u ON i.buyer_id = u.user_id
JOIN Properties p ON i.property_id = p.property_id
ORDER BY i.inquiry_id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Inquiries</title>
    <link rel="stylesheet" href="../css/view_inquiries.css">
</head>
<body>

<div class="container">
    <h2>Buyer & Seller Inquiries</h2>
    
    <a class="back" href="dashboard.php">Back to Dashboard</a>

    <table>
        <tr>
            <th>Inquiry ID</th>
            <th>Buyer Name</th>
            <th>Buyer Email</th>
            <th>Property</th>
            <th>Message</th>
            <th>Response</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['inquiry_id']; ?></td>
            <td><?php echo $row['buyer_name']; ?></td>
            <td><?php echo $row['buyer_email']; ?></td>
            <td>
                <?php echo $row['property_title']; ?> <br>
                <?php echo $row['location']; ?> <br>
                $<?php echo $row['price']; ?>
            </td>
            <td><?php echo $row['message']; ?></td>
            <td><?php echo $row['response'] ? $row['response'] : "No response yet" ?></td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
