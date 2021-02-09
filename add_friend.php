<?php
    
    session_start();

    require_once('db.php');

    if($_SESSION['login_user']['id'] == ''){
        header('Location: login.php');
    }

        $request_from_id = $_SESSION['login_user']['id'];
        $link = $_SERVER['PHP_SELF'];
        $link_array = explode('/', $link);
        //print_r($link_array);die;
        $request_to_id = end($link_array);
        $insert = "insert into add_friend(request_from_id, request_to_id) values('$request_from_id', '$request_to_id')";
        $sql = mysqli_query($conn, $insert);
        if($sql){
            //echo "Friend Request Sent Successfully";
            header("location:javascript://history.go(-1)");
        }else{
            echo "Request Failed";
        }

?>