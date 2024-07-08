<?php
include 'dbcon.php';
session_start();

if(isset($_POST['submit'])){


    
    $email = $_POST['email'];
    $email= filter_var($email, FILTER_SANITIZE_STRING);
     $password = $_POST['password'];
     $password= filter_var($password, FILTER_SANITIZE_STRING);
    
      $query = "insert into user ( name, email, pasword, cpassword, user_type, school, totalmarks, :imges) values( :name, :email, :password, :cpassword, :user_type, :school, :totalmarks, :images)";
      $select =$con -> prepare("SELECT * FROM `user` WHERE email=? AND  password=?");
      $select->execute([$email, $password]);
      $row = $select->fetch(PDO::FETCH_ASSOC);
    
    if($select->rowcount()>0){
        
        if($row = ['user_type'] == admin){
            $_SESSION ['admin_id']=$row['id'];
            header('location:admin.php');
        }
        elseif($row = ['user_type'] == user){
            $_SESSION ['user_id']=$row['id'];
            header('location:userpage.php');
        }
        else{
            $message = 'no user found';
        }
        

        
    }else{
        $message = 'incorrect email or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="regcontainer">
        
        <form action="" method="post">
        <h1>Login Now</h1>
            <input type="email"  id="email" name="email" required placeholder="enter your email"> 
            <input type="password"   name="password" id="password" required placeholder="enter  password"> 
            
            <input type="submit" name="submit" value="login now" class="btn">
            <p> Don't have account <a href="registration.php"> register now</a></p>
        </form>
    </div>
</body>
</html>