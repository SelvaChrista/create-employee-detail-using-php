<?php
include 'dbcon.php';

if(isset($_POST['submit'])){


    $name = $_POST['name'];
    $name ->bindParam(":name", $name, PDO::PARAM_STR);

    $email = $_POST['email'];
    $email->bindParam(":email", $email, PDO::PARAM_STR);

     $password = $_POST['password'];
     $password->bindParam(":password", $password, PDO::PARAM_STR);

    $cpassword = $_POST['cpassword'];
    $cpassword->bindParam(":cpassword", $cpassword, PDO::PARAM_STR);

    $user_type = $_POST['user_type'];
    $user_type->bindParam(":user_type", $user_type, PDO::PARAM_STR);

    $school = $_POST['school'];
    $school->bindParam(":school", $school, PDO::PARAM_STR);

    $totalmarks = $_POST['totalmarks'];
    $totalmarks->bindParam(":totalmarks", $totalmarks, PDO::PARAM_STR);

    $filename= $_FILES['fuimage'] ['name'];
    $tmp_name = $_FILES['fuimage']['tmp_name'];
    $file_size = $_FILES['fuimage']['size'];
    $file_folder = 'uploaded_image/' .$fuimage;

      $query = "INSERT INTO `user` ( name, email, pasword, cpassword, user_type, school, totalmarks, :imges) values( :name, :email, :password, :cpassword, :user_type, :school, :totalmarks, :images)";
      $select = $con->prepare("SELECT * FROM `user` WHERE email=?");
      $select->exec([$email]);

    
    if($select->rowcount()>0){
        $message[] = 'user already exit';
    }
    else{
        if($password!=$cpassword){
        $message[] = 'cpassword isnot match';
    }elseif($file_size>200000){
        $message = 'image  size is too large';
    }
    else{
        $insert = $con->prepare("INSERT INTO user (name, email, password, school, totalmarks,image)
        values(?, ? , ?, ? ,? ,?)");

        $insert -> exec([$name, $email, $cpassword, $school, $totalmarks,$fuimage]);

        if($insert){
            move_uploaded_file( $tmp_name,$file_folder);
            $message[] = 'registered sucessfully!';
            header('location:login.php');
        
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php
    if(isset($message)){
        foreach($message as $message){
            echo '<div class="message>
            <span>'.$message.'</span>
            <i class="times" onclick="this.parentElement.remove()"></i>
            </div>';
        }
    }
    ?>
    <div class="regcontainer">
        
        <form action="" method="post" enctype="multipart/from_data">
        <h1>Registration Now</h1>
        <?php
        if(isset($erorr)){
            foreach($erorr as $erorr){
            echo '<span class="erorr_msg">'.$erorr.'</span>';
        }
        }
        ?>
            <input type="text" name="name" id="name"  class="box" required placeholder="enter your name"> 
            <input type="email"   name="email"  id="emai" class="box"  required placeholder="enter  email"> 
            <input type="password" name="password" id="password"  class="box" required placeholder="enter  password"> 
            <input type="password"  name="cpassword" id="cpassword"  class="box" required placeholder="enter confirmpassword"> 
            <select name="user_type" >
                <option  name="user_id" value="user">user</option>
                <option  name="admin_id" value="admin">admin</option>
            </select>
            <input type="text"  id="school"  name="school"  class="box" required placeholder="enter previous school"> 
            <input type="number"  id="total"  name="totalmarks" class="box" required placeholder="enter totalmarks"> 
            <input type= "file" name="fuimage"  id="fuimage" class="box" accept="image/jpg, image/png, image/jpeg">

            <input type="submit" name="submit" value="register now" class="btn">
            <p>Already have account <a href="login.php"> login now</a></p>
        </form>
    </div>
</body>
</html>