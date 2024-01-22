<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="review.css">
    <script type="text/javascript">
    	function checkForm(){
			if(document.form.name.value=="")
			{		alert("Enter your Roll No")
					document.form.name.focus()
					return false;
			}
            else if(document.form.department.value=="")
            {
                alert("Enter your Deparment Name")
                document.form.department.focus()
                return false;
            }
			else if(document.form.hostel_name.value=="")
			{
				alert("Enter your Hostel Name")
				document.form.hostel_name.focus()
				return false;
			}
			else if(document.form.review.value==="")
			{
				alert("Enter your Review About food")
				document.form.review.focus()
				return false;
			}
			return true;
		}
    </script>
</head>
<body>

<?php
include("auth.php");
require('db.php');

// Upload image
if (isset($_FILES['image'])) {
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

    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            die('Failed to create directory.');
        }
    }

    $new_file_path = $upload_dir . $file_name;
    if (empty($errors)) {
        if (move_uploaded_file($file_tmp, $new_file_path)) {
            echo "Success";
        } else {
            echo "Error uploading file.";
        }
    } else {
        print_r($errors);
    }
}

// Rest of your code remains the same...


if (isset($_REQUEST['name'])) {
    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($con, $name);
    $department = stripslashes($_REQUEST['department']);
    $department = mysqli_real_escape_string($con, $department);
    $hostel_name = stripslashes($_REQUEST['hostel_name']);
    $hostel_name = mysqli_real_escape_string($con, $hostel_name);
    $review = stripslashes($_REQUEST['review']);
    $review = mysqli_real_escape_string($con, $review);

    $trn_date = date("Y-m-d H:i:s");

    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

    $query = "INSERT into `foor` (name, department, hostel_name, review, trn_date, file_name) VALUES ('$name', '$department', '$hostel_name', '$review', '$trn_date', '$fileName')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<div class='form'>
            <h3>Your review has been submitted successfully. Go to the Dashboard to see your review.</h3>
        </div>";
    } 
} else {
?>
<h1>Kongu Engineering College</h1>
    <div class="container">
        <h2>Hostel Food Review</h2>
         <form action="#" method="post"  name="form" enctype="multipart/form-data" onsubmit="return checkForm()">
            <div class="form-group">
                <label for="name">Roll No:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
            	<label for="department">Department:</label>
                <input type="text" id="department" name="department">
            </div>
            <div class="form-group">
                <label for="hostel_name">Hostel Name:</label>
                <input type="text" id="hostel_name" name="hostel_name">
            </div>
            <div class="form-group">
                <label for="review">Your Review:</label>
                <textarea id="review" name="review" rows="4"></textarea>
            </div>
            <div class="form-group">
            <label for="file">Upload Image(Not Compulsory):</label>
            <input type="file" name="file" id="file">
             </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
<?php } ?>
</body>
</html>
