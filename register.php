<?php

    require_once('db.php');

    if(isset($_POST['submit'])){
        //print_r($_POST);die;
        $name = $_POST['name'];
        $email = $_POST['email'];
        //$password = md5($_POST['password']);
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];
        if($password == $conf_password){
            $insert = "insert into register(name, email, password) values('$name', '$email', '$password')";
            $sql = mysqli_query($conn, $insert);
            if($sql){
                //echo "Inserted Successfully";
                header('Location: login.php');
            }else{
                echo "Inserted Failed!";
            }
        }else{
            echo "Password & Confirm Password Must Be Same";
        }
    }

?>

<html>
<h2>Registration</h2>
    <form name="frm" method="post" action="">
        <input type="text" name="name" placeholder="Name"><br><br>
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="password" name="conf_password" placeholder="Re Enter Password"><br><br>
        <input type="submit" name="submit" value="submit">
        <input type="reset" name="reset" value="reset">
    </form>
</html>