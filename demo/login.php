<?php 
header("Content-Type: text/html; charset=utf-8");
require_once("connMysql.php");
session_start();

if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
	
	if($_SESSION["memberLevel"]=="member"){
		header("Location: member_center.php");
	}else{
		header("Location: index.php");	
	}
}

//登入
if(isset($_POST["account"]) && isset($_POST["passwd"])){		
	
	
	
	$query_RecLogin = "SELECT * FROM `user_data` WHERE `user_account`='".$_POST["account"]."'";
	$RecLogin = mysql_query($query_RecLogin);		
	
	$row_RecLogin=mysql_fetch_assoc($RecLogin);
	$account = $row_RecLogin["user_account"];
	$passwd = $row_RecLogin["user_passwd"];
	$level = $row_RecLogin["user_level"];
	//比對密碼
	echo $account."<br>";
	echo $passwd."<br>";
	echo md5($_POST["passwd"])."<br>";
	if(md5($_POST["passwd"])==$passwd){
		//計算登入次數、更新登入時間
		$query_RecLoginUpdate = "UPDATE `user_data` SET `user_login`=`user_login`+1, `user_logintime`=NOW() WHERE `user_account`='".$_POST["account"]."'";	
		mysql_query($query_RecLoginUpdate);
		//設定名稱、等級
		$_SESSION["loginMember"]=$account;
		$_SESSION["memberLevel"]=$level;

		//echo $_SESSION["loginMember"]."<br>";
		//echo $_SESSION["memberLevel"]."<br>";
		
		if($_SESSION["memberLevel"]=="member"){
			header("Location: member_center.php");//還沒有設定QQQQQ
		}else{
			echo"admin";
			header("Location: index.php");//還沒有設定QQQQQ
		}
	}else{
		header("Location: login.php?errMsg=1");
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Looser Pokemon</title>
  <link rel="stylesheet" href="semantic.min.css"/>
	<script src="jquery-1.11.3.min.js"></script>
	<script src="semantic.min.js"></script>
  <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            email: {
              identifier  : 'name',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your name'
                }
              ]
            },
            passwd: {
              identifier  : 'passwd',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[5]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
</head>

<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui teal image header">
     
      <div class="content">
        Log-in
      </div>
    </h2>
	
    <form class="ui large form" method="post" action="">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="account" placeholder="Account">
          </div>
        </div>
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="passwd" placeholder="Password">
          </div>
        </div>
        <div class="ui fluid large teal submit button">Login</div>
		 <div id="error" class="ui error message" hidden>Password incorrect</div>
      </div>
	  
	 
		
    </form>

    <div class="ui message">
		<form class="ui large form" method="post" action="signup.php">
        <div class="ui fluid large teal submit button">Sign Up</a></div>
		 </form>
    </div>
	 <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
          <div class="ui red message" > Password incorrect !
		  <form class="ui large form" method="post" action="admin_passmail.php">
			<button class="ui inverted red basic button">forget password?</button>
		 </form>
		 
		 </div>
         <?php }?>
	
  </div>
</div>

</body>
</html>
