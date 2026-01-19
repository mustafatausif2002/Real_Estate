<?php
include "db.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php?page=sellerlogin");
    exit;
}


$seller_email = "";
$title = "";
$location = "";
$price = "";
$description = "";

$error = "";
$success = "";


if (isset($_POST["submit"])) {

    
    if (empty($_POST["seller_email"])) {
        $error .= "Business email is required.<br>";
    } else {
        $seller_email = $_POST["seller_email"];
    }

    if (empty($_POST["title"])) {
        $error .= "Property title is required.<br>";
    } else {
        $title = $_POST["title"];
    }

    if (empty($_POST["location"])) {
        $error .= "Location is required.<br>";
    } else {
        $location = $_POST["location"];
    }

    if ($_POST["price"] === "") {
        $error .= "Price is required.<br>";
    } elseif (!is_numeric($_POST["price"])) {
        $error .= "Price must be numeric.<br>";
    } else {
        $price = $_POST["price"];
    }

    if (empty($_POST["description"])) {
        $error .= "Description is required.<br>";
    } else {
        $description = $_POST["description"];
    }

    if ($error === "") {
        $sql = "
            INSERT INTO properties (seller_email, title, location, price, description)
            VALUES ('$seller_email', '$title', '$location', '$price', '$description')
        ";

        if ($conn->query($sql)) {
            $success = "Property added successfully!";
            $seller_email = $title = $location = $price = $description = "";
        } else {
            $error = "Database error: " . $conn->error;
        }
    }
}


if (isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];

    $sql = "DELETE FROM properties WHERE id='$delete_id' LIMIT 1";

    if ($conn->query($sql)) {
        $success = "Property deleted successfully!";
    } else {
        $error = "Failed to delete property: " . $conn->error;
    }
}


$result = $conn->query("SELECT * FROM properties ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="sellerdashboard.css">
</head>
<body>

<div class="auth-box">

    <h1>Seller Dashboard</h1>

    <form method="post" style="text-align:right; margin-bottom:20px;">
        <button type="submit" name="logout" class="btn-logout">Logout</button>
    </form>

    <?php if ($success) { ?>
        <div class="auth-success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if ($error) { ?>
        <div class="auth-error"><?php echo $error; ?></div>
    <?php } ?>

   
    <form method="post">
        <label>Business Email:</label><br>
        <input type="text" name="seller_email" value="<?php echo htmlspecialchars($seller_email); ?>"><br><br>

        <label>Property Title:</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>"><br><br>

        <label>Location:</label><br>
        <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>"><br><br>

        <label>Price:</label><br>
        <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>"><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4"><?php echo htmlspecialchars($description); ?></textarea><br><br>

        <input type="submit" name="submit" value="Submit Property" class="btn-submit">
    </form>

   
    <h3>Added Properties</h3>

    <?php if ($result && $result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Business Email</th>
                <th>Title</th>
                <th>Location</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["seller_email"]); ?></td>
                    <td><?php echo htmlspecialchars($row["title"]); ?></td>
                    <td><?php echo htmlspecialchars($row["location"]); ?></td>
                    <td><?php echo htmlspecialchars($row["price"]); ?></td>
                    <td><?php echo htmlspecialchars($row["description"]); ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Are you sure?')">
                            <input type="hidden" name="delete_id" value="<?php echo $row["id"]; ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p class="no-data">No properties added yet.</p>
    <?php } ?>

</div>

</body>
</html>
