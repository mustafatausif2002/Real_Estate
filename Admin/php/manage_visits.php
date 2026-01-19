<?php
session_start();
include "../db/db.php";

if (!isset($_SESSION['admin_id']) && !isset($_COOKIE['admin_email'])) {
    header("Location: ../html/login.html");
    exit;
}


if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == "approve") {
        $sql = "UPDATE VisitRequests SET status='Approved' WHERE request_id='$id'";
        $conn->query($sql);
    } else if ($action == "reject") {
        $sql = "UPDATE VisitRequests SET status='Rejected' WHERE request_id='$id'";
        $conn->query($sql);
    }

    header("Location: manage_visits.php");
    exit;
}


$sql = "
SELECT vr.request_id, vr.status, u.name AS buyer_name, p.title AS property_title, p.location AS property_location
FROM VisitRequests vr
JOIN Users u ON vr.buyer_id = u.user_id
JOIN Properties p ON vr.property_id = p.property_id
ORDER BY vr.request_id DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Visit Requests</title>
    <link rel="stylesheet" href="../css/manage_visits.css">
</head>
<body>

<div class="container">
    <h2>Manage Visit Requests</h2>

        <a class="back" href="dashboard.php">Back to Dashboard</a>

    <table>
        <tr>
            <th>Request ID</th>
            <th>Buyer Name</th>
            <th>Property</th>
            <th>Location</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['request_id']; ?></td>
            <td><?php echo $row['buyer_name']; ?></td>
            <td><?php echo $row['property_title']; ?></td>
            <td><?php echo $row['property_location']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a class="approve" href="manage_visits.php?action=approve&id=<?= $row['request_id'] ?>">Approve</a>
                <a class="reject" href="manage_visits.php?action=reject&id=<?= $row['request_id'] ?>">Reject</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>
