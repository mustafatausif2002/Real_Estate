<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_email'])) {
    header("Location: ../html/login.html");
    exit;
}

//approve
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $conn->query("UPDATE Properties SET status='Approved' WHERE property_id='$id'");
}

//delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $conn->query("DELETE FROM Inquiries WHERE property_id='$id'");
    $conn->query("DELETE FROM VisitRequests WHERE property_id='$id'");
    $conn->query("DELETE FROM Properties WHERE property_id='$id'");
}


$sql = "
    SELECT p.*, u.name AS seller_name
    FROM Properties p
    JOIN Users u ON p.seller_id = u.user_id
    ORDER BY p.property_id DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Properties</title>
    <link rel="stylesheet" href="../css/manage_properties.css">
</head>
<body>

<div class="container">
    <h2>Manage Properties</h2>
    
    <a class="back" href="dashboard.php">Back to Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Seller</th>
            <th>Location</th>
            <th>Price</th>
            <th>Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['property_id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['seller_name'] ?></td>
            <td><?= $row['location'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <?php if ($row['status'] == 'Pending') { ?>
                    <a class="btn approve" href="?approve=<?= $row['property_id'] ?>">Approve</a>
                <?php } ?>

                <a class="btn delete" href="?delete=<?= $row['property_id'] ?>" onclick="return confirm('Are you sure you want to delete this property?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
