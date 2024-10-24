<?php 
  session_start();
  include_once "../core/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../login");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>

   <?php 
     $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
     if(mysqli_num_rows($sql) > 0){
       $row = mysqli_fetch_assoc($sql);
     }
    ?>
    <img src="../public/images/<?php echo $row['img']; ?>" style="height: 100%; width: 100%; border-radius: 50%; object-fit: cover;"alt="">
    <?php echo $row['status']; ?>
    <?php echo $row['fname']. " " . $row['lname'] ?>
    <?php echo $row['email']; ?>
</body>
</html>