<?php
include('config.php');

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"]) && !empty(trim($_POST["id"]))){
        $id = trim($_POST["id"]);
        $sql = "DELETE FROM complaints WHERE id = '$id'";
    
        if(mysqli_query($conn, $sql)){
          header('Location: index.php');
        } else {
          $error_array[] = 'query error: '. mysqli_error($conn);
          session_start();
          $_SESSION['errors'] = $error_array;
          header('Location: error.php');
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Complaint</title>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/form_style.css">
</head>
<body>
  <?php include('nav.php') ?>
  <div class="container">
    <h2>Delete Complaint</h2>
    <div>
      <p><strong>Title:</strong> <?php echo $title; ?></p>
      <p><strong>Category:</strong> <?php echo $category; ?></p>
      <p><strong>Status:</strong> <?php echo $status; ?></p>
      <p><strong>Description:</strong> <?php echo $description; ?></p>
    </div>
    <p>Are you sure you want to delete this complaint?</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="create-complaint">
      <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>">
      <a href="index.php" class="btn-secondary">No, Cancel</a>
      <input type="submit" value="Yes">
    </form>
  </div>
</body>
</html>
