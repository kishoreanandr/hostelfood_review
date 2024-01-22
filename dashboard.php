<?php
include("auth.php");
require('db.php');
// Upload image
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
    }

    if (empty($errors)) {
        $upload_dir = 'images/';
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die('Failed to create directory.');
            }
        }

        $new_file_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $new_file_path)) {
            echo "Success";
        } else {
            echo "Error uploading file.";
        }
    } else {
        print_r($errors);
    }
}

if (isset($_POST['hostel_name'])) {
    $hostel_name = $_POST['hostel_name'];
    $query = "SELECT * FROM foor WHERE hostel_name='$hostel_name'";
    $result = mysqli_query($con, $query) or die(mysqli_error());
} else {
    $query = "SELECT * FROM foor";
    $result = mysqli_query($con, $query) or die(mysqli_error());
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - Secured Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .form {
        width: 50%;
        margin: auto;
        text-align: center;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form a {
        text-decoration: none;
        color: #3498db;
        margin: 10px;
        padding: 8px 20px;
        border: 1px solid #3498db;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .form a:hover {
        background-color: #3498db;
        color: #fff;
    }

    .review-item {
        border: 1px solid #ddd;
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .review-item h3 {
        color: #333;
    }

    .review-item p {
        color: #666;
    }

    .heading {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .review-item img {
        max-width: 100%;
        height: auto;
        margin-top: 10px;
        cursor: pointer;
    }
    .anchor a
    {
        border:none;
    }
    .anchor a:hover
    {
        background-color:white;
        border:none;
    }

</style>
</head>
<body>
<div class="form">
    <a href="index.php">Home</a>
    <a href="logout.php">Logout</a>
</div>
<div class="form">
    <div class="heading">Dashboard - Review Details</div>
    <div class="anchor" style="--hover-background-color: green">

    <!-- Your form content here -->

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='review-item'>";
            echo "<h3>Name: " . $row['name'] . "</h3>";
            echo "<p>Department: " . $row['department'] . "</p>";
            echo "<p>Hostel Name: " . $row['hostel_name'] . "</p>";
            echo "<p>Review: " . $row['review'] . "</p>";
            if (isset($row['file_name'])) {
                echo "<p>Date: " . $row['trn_date'] . "</p>";
                echo "<p>Your uploaded image is:</p>";
                echo "<a href='uploads/" . $row['file_name'] . "' target='_blank'><img src='uploads/" . $row['file_name'] . "' alt='Uploaded Image' style='width:200px; height:200px;'></a>";
            }
            echo "</div>";
        }
    } else {
        echo "<p style='color: #333;'>No reviews found</p>";
    }
    ?>
    </div>
</div>
</body>
</html>