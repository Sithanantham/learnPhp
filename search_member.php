<?php

    session_start();

    include('db.php');

    if($_SESSION['login_user']['id'] == ''){
        header('Location: login.php');
    }

    $type = 0;
if(isset($_POST['type'])){
   $type = $_POST['type'];
}
$id = $_SESSION['login_user']['id'];
if($type == 1){
    $searchText = mysqli_real_escape_string($conn,$_POST['search']);

    $sql = "SELECT id,name FROM add_member where name like '%".$searchText."%' order by name asc limit 5";

    $result = mysqli_query($conn,$sql);

    $search_arr = array();

    while($fetch = mysqli_fetch_assoc($result)){
        $id = $fetch['id'];
        $name = $fetch['name'];

        $search_arr[] = array("id" => $id, "name" => $name);
    }

    echo json_encode($search_arr);
}

if($type == 2){
    $userid = mysqli_real_escape_string($conn,$_POST['userid']);

    $sql = "SELECT name FROM add_member where id=".$userid;

    $result = mysqli_query($conn,$sql);

    $return_arr = array();
    while($fetch = mysqli_fetch_assoc($result)){
        $name = $fetch['name'];
        $created_at = date('d-m-Y - D',strtotime($fetch['created_at']));

        $return_arr[] = array("name"=>$name, "created_at"=> $created_at);
    }

    echo json_encode($return_arr);
}

?>