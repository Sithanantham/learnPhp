<?php
    
    session_start();

    require_once('db.php');

    if($_SESSION['login_user']['id'] == ''){
        header('Location: login.php');
    }

    $admin_id = $_SESSION['login_user']['id'];
    if(isset($_POST['submit']) && !empty($_POST['submit'])){
        $name = $_POST['name'];
        $insert = "insert into add_member (admin_id, name) values ('$admin_id', '$name')";
        $sql = mysqli_query($conn, $insert);
        if($sql){
            echo "Member added successfully";
        }else{
            echo "Failed to add the Member";
        }
    }
       
?>

