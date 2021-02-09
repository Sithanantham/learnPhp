<?php
    
    session_start();

    require_once('db.php');

    if($_SESSION['login_user']['id'] == ''){
        header('Location: login.php');
    }

/*     $user_id = $_SESSION['login_user']['id'];
    $sel = "select * from add_friend where request_from_id = $user_id";
    $sql1 = mysqli_query($conn, $sel);    
    while($fetch1 = mysqli_fetch_array($sql1)){
        $already_friend = $fetch1['request_to_id'];
    }
 */
    $select = "select * from register";
    $sql = mysqli_query($conn, $select);
   // $fetch = mysqli_fetch_array($sql);
   if(mysqli_num_rows($sql) > 0){
    echo "<table>";
        echo "<tr>";
            echo "<th colspan='3'>Add Friend</th>";
        echo "</tr>";
        echo "<tr>";
            echo "<th>S.No</th>";
            echo "<th>Name</th>";
            echo "<th>Add Friend Request</th>";
        echo "</tr>";
   }
    $i=1;
    while($row = mysqli_fetch_array($sql)){
?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td> Already Friends </td>
            <td>
            
                <a href='add_friend.php/<?php echo $_SESSION['login_user']['id'].'/'.$row['id'];?>'>Add Friend</a>
            </td>
        </tr>
<?php
    }    
?>

<html>
    </table>
    <br><a href="logout.php"><button>Logout</button></a>
</html>