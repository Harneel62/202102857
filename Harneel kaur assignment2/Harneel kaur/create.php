<?php
include('config.php');

$title = $category = $description = '';
$error_array = [];
$status = 'pending';

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

    if (empty(trim($_POST["description"]))) {
      $error_array[] = "Please enter a description.";
    } else {
        $description = trim($_POST["description"]);
    }

    if (empty($error_array)) {
        $sql = "INSERT INTO complaints (title, category, status, description) VALUES ('$title', '$category', '$status', '$description')";

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
  <title>Create Complaint</title>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/form_style.css">
</head>
<body>
  <?php include('nav.php') ?>
  <div class="container">
    <h2>Create Complaint</h2>
    <form class="create-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div>
        <label>Title</label>
        <input type="text" name="title" value="<?php echo $title; ?>">

      </div>
      <div>
        <label>Category</label>
        <select name="category">
          <option value="Electronics">Electronics</option>
          <option value="Furniture">Furniture</option>
          <option value="IT">IT</option>
          <option value="Appliances">Appliances</option>
          <option value="Others">Others</option>
          
        </select>
      </div>
      <div>
      <label>Status</label>
        <input type="text" name="status" value="<?php echo ucfirst($status) ?>" disabled>
      </div>
      <div>
        <label>Description</label>
        <textarea name="description"><?php echo $description; ?></textarea>
      </div>
      <div class="create-complaint">
        <a type="button" class="btn-secondary" href="index.php">Cancel</a>
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
</body>
</html>
