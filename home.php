<?php

    session_start();

    include('db.php');

    if($_SESSION['login_user']['id'] == ''){
        header('Location: login.php');
    }
?>
<html>

<head>
<title>PHP - AJAX</title>
    <script type="text/javascript" src="jquery-3.6.0.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />

    <style>
     .clear{
 clear:both;
 margin-top: 20px;
}

#searchResult{
 list-style: none;
 padding: 0px;
 width: 250px;
 position: absolute;
 margin: 0;
}

#searchResult li{
 background: lavender;
 padding: 4px;
 margin-bottom: 1px;
}

#searchResult li:nth-child(even){
 background: cadetblue;
 color: white;
}

#searchResult li:hover{
 cursor: pointer;
}

input[type=text]{
 padding: 5px;
 width: 250px;
 letter-spacing: 1px;
}
    </style>
 </head>

 <body><br>
 <div class="container">
    <div class="row">
        <div class="col-sm-11">
            <h4 style="color:green;"><b> <?php echo "Hello ". ucwords($_SESSION['login_user']['name']). " welcome to our site"?></b></h4>
        </div>

        <div class="col-sm-1">                
            <a href="logout.php"><button class="btn btn-warning">Logout</button></a>
        </div>
        <br><br><hr>
        
        <p id="msgid"></p>
        <div class="row">
            <div class="col-sm-12">
                <form name="frm" id="frmid" class="form-inline" action="add_member.php" method="post">        
                    <div class="form-group">
                        <label for="email">Add Member</label>
                        <input type="text" name="name" id="nameid" class="form-control" placeholder="Enter Member Name">
                        <input type="submit" name="submit" value="submit" id="submitid" class="btn btn-primary">
                        <input type="reset" name="reset" value="reset" class="btn btn-danger"> 
                    </div>
                </form>
            </div>        
        </div><br>

        <div class="row">
            <div class="col-sm-6">
                <b id="showmembers"><a href="show.php/<?php echo $_SESSION['login_user']['id']?>">Click here to see who are under you (<?php echo ucfirst($_SESSION['login_user']['name'])?>)</a></b>
                <p id="show"></p>
            </div>

            <div class="col-sm-6">
                <form>
                    <div class="form-group">
                        <div class="col-sm-3">
                            <label for="email">Ajax Live Search</label>
                        </div>

                        <div class="col-sm-9">
                            <input type="text" name="txt_search" id="txt_search" placeholder="Search Member Name" autocomplete="off">

                            <ul id="searchResult"></ul>

                            <div class="clear"></div>
                            <div id="userDetail"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



<script>
    $(document).ready(function(){
        $("#submitid").click(function(e){
            e.preventDefault();
            var values = $("#frmid").serialize();

            $.ajax({
                url: "/testphp/add_member.php",
                type: "POST",
                data: {name: $("#nameid").val(), submit : 'submit' },
                dataType:"html",
                success: function(response){
                   $("#msgid").html(response);
                }
            })
        })
    });

    $(document).ready(function(){
        $("#showmembers").click(function(e){
            e.preventDefault();

            $.ajax({
                url: "/testphp/show.php/<?php echo $_SESSION['login_user']['id']; ?>",
                type: "GET",
                dataType: "html",
                success: function(data){
                    $("#show").html(data);
                }
            })
        })
    });
/* 
    $(function() {
     $( "#search" ).autocomplete({
       source: '/testphp/search_member.php',
     });
  });
 */

$(document).ready(function(){

    $("#txt_search").keyup(function(){
        var search = $(this).val();

        if(search != ""){

            $.ajax({
                url: '/testphp/search_member.php',
                type: 'post',
                data: {search:search, type:1},
                dataType: 'json',
                success:function(response){
                
                    var len = response.length;
                    $("#searchResult").empty();
                    for( var i = 0; i<len; i++){
                        var id = response[i]['id'];
                        var name = response[i]['name'];

                        $("#searchResult").append("<li value='"+id+"'>"+name+"</li>");

                    }

                    $("#searchResult li").bind("click",function(){
                        setText(this);
                    });

                }
            });
        }

    });

});

function setText(element){

var value = $(element).text();
var userid = $(element).val();

$("#txt_search").val(value);
$("#searchResult").empty();

$.ajax({
    url: '/testphp/search_member.php',
    type: 'post',
    data: {userid:userid, type:2},
    dataType: 'json',
    success: function(response){

        var len = response.length;
        $("#userDetail").empty();
        if(len > 0){
            var name = response[0]['name'];
            var created_at = response[0]['created_at'];
            var msg = "You have selected<br>";

            $("#userDetail").append(msg);
            $("#userDetail").append("Name : " + name + "<br/>");
            $("#userDetail").append("Created At : " + created_at);
        }
    }

});
}
</script>
</body>
</div>    
 </div>
</html>