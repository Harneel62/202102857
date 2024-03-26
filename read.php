<?php
include('config.php');

$title = $category = $description = $status = $id = '';

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    $complaint_id = trim($_GET["id"]);
    $sql = "SELECT * FROM complaints WHERE id = '$complaint_id'";  
    $result = mysqli_query($conn, $sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $title = $row["title"];
        $category = $row["category"];
        $status = $row["status"];
        $description = $row["description"];
    } else{
        $error_array[] = "Record can not be found by given ID = '$$complaint_id'";
        session_start();
        $_SESSION['errors'] = $error_array;
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Complaint</title>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include('nav.php') ?>
  <div class="container">
    <h2>Complaint Details</h2>
    <button class="complaint-btn"><a style="text-decoration: none; color: #fff;" href="update.php?id=<?php echo $id; ?>">Update</a></button>
    <button class="complaint-btn"><a style="text-decoration: none; color: #fff;" href="delete.php?id=<?php echo $id; ?>">Delete</a></button>
    <div>
      <p><strong>Title:</strong> <?php echo $title; ?></p>
      <p><strong>Category:</strong> <?php echo $category; ?></p>
      <p><strong>Status:</strong> <?php echo $status; ?></p>
      <p><strong>Description:</strong> <?php echo $description; ?></p>
    </div>
    <a href="index.php">Return to Homepage</a>
  </div>
</body>
</html>
