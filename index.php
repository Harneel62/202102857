<!--
  #name: Harneel kaur
  #id: 202102857
-->

<?php
include('config.php');

$sql = "SELECT * FROM complaints";
$result = $conn->query($sql);
$complaints = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Management System (CMS)</title>
  <link rel="stylesheet" href="css/navigation.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php include('nav.php') ?>
  <div class="container">
    <h1>Complaints List</h1>
    <div class="create-complaint">
      <a type="button" class="complaint-btn" href="create.php">New Complaint</a>
    </div>

    <?php if(count($complaints) > 0) { ?>
      <ul class="complaints-list">
        <?php foreach($complaints as $complaint) { ?>
          <li class="complaint-item">
            <h3><?php echo $complaint['title']; ?></h3>
            <p>Category: <?php echo $complaint['category']; ?></p>
            <p>Status: <?php echo $complaint['status']; ?></p>
            <p>Description: <?php echo $complaint['description']; ?></p>
            <button class="complaint-btn"><a style="text-decoration: none; color: #fff;" href="delete.php?id=<?php echo $complaint['id']; ?>">Delete</a></button>
            <button class="complaint-btn"><a style="text-decoration: none; color: #fff;" href="read.php?id=<?php echo $complaint['id']; ?>">Open</a></button>
            <button class="complaint-btn"><a style="text-decoration: none; color: #fff;" href="update.php?id=<?php echo $complaint['id']; ?>">Update</a></button>
          </li>
        <?php } ?>
      </ul>
    <?php } else { ?>
      <p>No complaints found</p>
    <?php } ?>
  </div>
</body>
</html>
