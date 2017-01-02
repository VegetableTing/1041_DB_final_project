<?php
        session_start();
        if(!isset($_SESSION['loginMember']))
                echo "<script>location.href='login.php'</script>";
        else{
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="semantic.min.css" />
    <script src="jquery-1.11.3.min.js"></script>
    <script src="semantic.min.js"></script>
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
            texts: {
              identifier  : 'texts',
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
    <title>demo</title>
  </head>
  <body>
    <div class="content">
      <form class="ui form" method="post" action="new_message.php">
        <div class="field">
        <label>Subject</label> 
        <input type="text" name="subject" placeholder="Subject" /></div>
        <div class="field">
        <label>What to say</label> 
        <textarea rows="3" name="texts"></textarea></div>
        <button class="ui button" type="submit">Submit</button>
      </form>
    </div>
  </body>
</html>
<?php
        }
 ?>
 
 <?php
	date_default_timezone_set('Asia/Taipei');
	require_once("connMysql.php");
	
	if(isset($_POST['subject']) && isset($_POST['texts'])){
		$getDate= date("Y-m-d");
		echo $getDate;
		
		$sql_query = "INSERT INTO `message_data` (`subject` ,`message` ,`author`,`dated`) VALUES (";
		$sql_query .= "'".$_POST['subject']."',";
		$sql_query .= "'".$_POST['texts']."',";
		$sql_query .= "'".$_SESSION['loginMember']."',";
		$sql_query .= "'".$getDate."')";
		
		$result = mysql_query($sql_query);
			
			if($result) echo "success";
			else echo "fail";
		echo "<script>location.href='message.php'</script>";
	}
 ?>