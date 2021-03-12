<?php

    session_start();

    include('db.php');

    if($_SESSION['login_user']['id'] == ''){
        header('Location: login.php');
    }
?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
<table class="table table-bordered table-hover table-striped table-responsive">
        <thead>
            <tr>
            <th style="width:5%">#</th>
            <th style="width:60%">Members</th>
            <th style="width:35%">Created at</th>
            </tr>
        </thead>
        <tbody>
<?php
    $i=1;
    $id = $_SESSION['login_user']['id'];

    $sel = "select * from add_member where admin_id = $id";
    $sql = mysqli_query($conn, $sel);
    while($row = mysqli_fetch_assoc($sql)){
       // echo $row['name'];
?>
   
            <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo ucwords($row['name']);?> </td>
            <td><?php echo date('d-m-Y - D', strtotime($row['created_at']));?> </td>
            </tr>

<?php       
    }
?>


        </tbody>
    </table>
</html>