<?php
include('config.php');

$title = $category = $description = '';
$title_err = $category_err = $status_err = $id = $description_err = '';
$error_array = [];

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
    if (empty(trim($_POST["title"]))) {
        $error_array[] = "Please enter a title.";
    } else {
        $title = trim($_POST["title"]);
    }

    if (empty(trim($_POST["category"]))) {
        $error_array[] = "Please enter a category.";
    } else {
        $category = trim($_POST["category"]);
    }

    if (empty(trim($_POST["status"]))) {
      $error_array[] = "Please enter a status.";
    } else {
        $status = trim($_POST["status"]);
    }

    if (empty(trim($_POST["description"]))) {
      $error_array[] = "Please enter a description.";
    } else {
        $description = trim($_POST["description"]);
    }

    if (empty($error_array)) {
        $id = trim($_POST["id"]);
        $sql = "UPDATE complaints SET title='$title', category='$category', status = '$status', description='$description' WHERE id='$id'";

        if(mysqli_query($conn, $sql)){
          header('Location: index.php');
        } else {
          $error_array[] = 'query error: '. mysqli_error($conn);
          session_start();
          $_SESSION['errors'] = $error_array;
          header('Location: error.php');
        }
    } else {
      session_start();
      $_SESSION['errors'] = $error_array;
      header('Location: error.php');
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Complaint</title>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/form_style.css">
</head>
<body>
  <?php include('nav.php') ?>
  <div class="container">
    <h2>Update Complaint</h2>
    <form class="create-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div>
        <label>Title</label>
        <input type="number" name="id" value="<?php echo $id; ?>" hidden>
        <input type="text" name="title" value="<?php echo $title; ?>">
        <span><?php echo $title_err; ?></span>
      </div>
      <div>
        <label>Category</label>
        <select name="category">
          <option value="General" <?php if($category == 'General') echo 'selected'; ?>>General</option>
          <option value="IT" <?php if($category == 'IT') echo 'selected'; ?>>IT</option>
          <option value="Furniture" <?php if($category == 'Furniture') echo 'selected'; ?>>Furniture</option>
          <option value="Electronics" <?php if($category == 'Electronics') echo 'selected'; ?>>Electronics</option>
          <option value="Appliances" <?php if($category == 'Appliances') echo 'selected'; ?>>Appliances</option>
        </select>
        <span><?php echo $category_err; ?></span>
      </div>
      <div>
        <label>Status</label>
        <select name="status">
          <option value="Pending" <?php if(ucfirst($status) == 'Pending') echo 'selected'; ?>>Pending</option>
          <option value="In Progress" <?php if($status == 'In Progress') echo 'selected'; ?>>In Progress</option>
          <option value="Resolved" <?php if(ucfirst($status) == 'Resolved') echo 'selected'; ?>>Resolved</option>
          <option value="Rejected" <?php if(ucfirst($status) == 'Rejected') echo 'selected'; ?>>Rejected</option>
        </select>
      </div>
      <div>
        <label>Description</label>
        <textarea name="description"><?php echo $description; ?></textarea>
        <span><?php echo $description_err; ?></span>
      </div>
      <div class="create-complaint">
        <a type="button" class="btn-secondary" href="index.php">Cancel</a>
        <input type="submit" value="Update">
      </div>
    </form>
  </div>
</body>
</html>
