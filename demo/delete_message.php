<?php
        session_start();
        if(!isset($_SESSION['loginMember']))
                echo "<script>location.href='login.php'</script>";
        else{
?>

<?php
		require_once("connMysql.php");
		$code = $_GET['code'];
		//echo $code;
		$sql = "DELETE FROM `message_data` WHERE `id`=".$code;
		$result = mysql_query($sql);
		
		if($result) echo "success";
			else echo "fail";
			
		echo "<script>location.href='message.php'</script>";	
        }
 ?>
 