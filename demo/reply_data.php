<?php
        session_start();
        if(!isset($_SESSION['loginMember']))
                echo "<script>location.href='login.php'</script>";
        else{
			require_once("connMysql.php");
			$code = $_GET['code'];
			$sql = "SELECT * FROM message_data WHERE id='$code'";
			$result = mysql_query($sql);
			
			//if($result) echo "success";
			//else echo "fail";
			
			header("mysql_data_seek($result,$code-1)");
			$row_result=mysql_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="semantic.min.css" />
    <script src="jquery-1.11.3.min.js"></script>
    <script src="semantic.min.js"></script>
    <title>demo</title>
	<style type="text/css">
                body{
					margin : 0px;
					padding : 0px;
					min-width : 320px;
					font-family: 'Lato', 'Helvetica Neue', Arial, Helvetica, sans-serif;
					font-size: 14px;
					line-height: 1.4285em;
				}
				.content{
					max-width : 100%;
					width : 1127px;
					margin-left : auto;
					margin-right : auto;
					margin-top : 30px;
				}
                
	</style>
	<script>
	function modal(){
		$('.ui.modal')
			.modal('show')
			;
	}
		
	</script>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            subject: {
              identifier  : 'subject',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your subject'
                }
              ]
            },
            mes: {
              identifier  : 'mes',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your texts'
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
	<div class="content">
	<a href="message.php"class="ui primary button"><h3>Home</h3></a>
	<div class="ui raised very padded text container segment">
		<h2 class="ui header"><?php echo $row_result["subject"]; ?></h2>
		<p><?php echo $row_result["message"];?></p>
	</div>
	<?php
		if($_SESSION['loginMember'] == $row_result["author"]){
	?>
	<button class="ui button" onclick="modal()">Edit</button>
	<?php
		}
	?>
    
	</div>
	
 

  </body>
</html>
<?php
            }
?>

<?php
	if(isset($_POST['texts'])){
	date_default_timezone_set('Asia/Taipei');
	$sql = "INSERT INTO reply_data(message_code,message,reply_by,reply_date) VALUES(?,?,?,?)";
	$sth = $dbh->prepare($sql);
	$result = mysql_query($sql_query);
	
	$date = new DateTime('now');
	$author = $_SESSION['memberLevel'];
	$message = htmlentities($_POST['texts']);
	$code = $_GET['code'];
	try{
		$sth->execute(array($code,$message,$author,$date->format('Y-m-d H:i:s')));
	}catch(Exception $e){
		echo $e->getMessage();
	}
		unset($_POST['texts']);
		echo "<script>location.href='reply_data.php?code=$code'</script>";
	}
?>

<?php
	if(isset($_POST['subject']) && isset($_POST['mes'])){
		date_default_timezone_set('Asia/Taipei');
		$code = $_GET['code'];
		$subject = htmlentities($_POST['subject']);
		$message = htmlentities($_POST['mes']);
		$date = new DateTime('now');
		$sql = "UPDATE message_data SET subject='$subject',message='$message' WHERE id='$code'";
		$result = mysql_query($sql);
		if($result) echo "success";
		else echo "fail";
		
		unset($_POST['subject']);
		unset($_POST['mes']);
		echo "<script>location.href='reply_data.php?code=$code'</script>";
	}
?>	
 <div class="ui modal">
  <i class="close icon"></i>
  <div class="header">
    Edit the message
  </div> 
    <div class="description">
      <form class="ui form segment" method="post" action="reply_data.php?code=<?php echo $code;?>">
	  <div class="field">
		<lable>Subject</lable>
	   <input type="text" name="subject" placeholder="Subject" />
	  </div>
		
		<div class="field">
			<lable>Message</lable>
			 <textarea rows="3" name="mes"></textarea>
		</div>
		
		<button class="ui blue submit button" type="submit">Submit</button>
		</form>
	</div>
		 
    </div>
 