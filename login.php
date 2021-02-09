<?php

    session_start();

    if($_SESSION['login_user']){
        header("location:javascript://history.go(-1)");
    }
    require_once('db.php');

    if(isset($_POST['submit'])){
        //print_r($_POST);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $select = "select * from register where email='$email' and password='$password'";
        $sql = mysqli_query($conn, $select);
        $fetch = mysqli_fetch_array($sql);
        //print_r($fetch);die;
        if($fetch){
            $_SESSION['login_user'] = $fetch;
            //$_SESSION['id'] = $password;
            header('Location: home.php');
        }else{
            echo "Login Failed";
        }
        
    }

?>

<html>
<h2>Login</h2>
    <form name="frm" method="post" action="">
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="submit" name="submit" value="submit"><br><br>
    </form>
</html>