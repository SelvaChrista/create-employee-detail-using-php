<?php
include 'dbcon.php';

session_start();
$admin_id = $_SESSION ['admin_id'];

if(isset($admin)){

    header('location:login.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER PAGE</title>
    <link href="style1.css" rel="stylesheet">
</head>
<body>
<div class="profilecontainer">
            <h1> Admin Page </h1>
            <?php
          $select_profile =$con->prepare("SELECT * FROM `user` WHERE id=?");
          $select_profile->execute(['admin_id']);
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="profile">
                <img src="uploaded_img/<?php echo $fuimage; ?>" alt="" ><br><br>
                
                 
                <a href="userprofile.php">update profile</a><br><br>
                <a href="logout.php" class="btn"> LOGOUT</a><br><br>
            
             <a href="login.php" class="option_btn">LOGIN</a><br><br>
            <a href="registration.php" class="option_btn">REGISTER</a></div>
                    
           
            
</div>
        
    
</body>
</html>