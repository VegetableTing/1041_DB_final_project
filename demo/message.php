<?php session_start();?>
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
				#topcontent{
					margin-top : 30px;
				}
				#items{
					max-width : 100%;
					width : 1127px;
					margin-left : auto;
					margin-right : auto;
					margin-top : 30px;
				}
				#logo{
                        height : 90px;
						width : 120px;
                }
				#log{
					float : left;
					margin-right : 150px ;
				}
				#item{
					margin-top : 30px;
				}
                
	</style>
	
	<script>
	  var index = 0;
		function modal(){
			$('.ui.modal')
				.modal('show')
				;
				test_ajax(index);
		}	

		
		</script>
    <title>demo</title>
  </head>
  <body>
	<h1 class="ui center aligned header" id="topcontent">Messages</h1>
    <div class="ui items" id="items">

	<div class="ui teal tag label" id="log"><h3>目前登入的使用者為 :	<?php echo $_SESSION['loginMember'];?></h3></div>
	<div ><a href="logout.php" align="right" class="ui button" ><h3>Log Out</h3></a></div >
		<i class="book icon"  onclick="modal()"></i>
	
      <?php
		require_once("connMysql.php");
		
		$sql_query = "SELECT * FROM message_data ORDER BY dated DESC";
		$result = mysql_query($sql_query);
		$total_records = mysql_num_rows($result);
		
		while($row_result=mysql_fetch_assoc($result)){
			//echo $row_result["id"];
	  ?>
	  <div class="item" id="item">
        <div class="image">
          <img id="logo" src="logo.png" />
        </div>
        <div class="content">
          <a class="header" href="reply_data.php?code=<?php echo $row_result["id"];?>">
		  <?php echo $row_result["subject"];?></a>
          <div class="meta">
            <span>date:	<?php echo $row_result["dated"];?></span>
          </div>
          <div class="description"></div>
          <div class="extra">by:	<?php echo $row_result["author"];?></div>

        </div>
      </div>
	  
	<?php
		if($_SESSION['loginMember'] == $row_result["author"]){
	?>
		<a class="ui button" href="delete_message.php?code=<?php echo $row_result["id"];?>">Delete</a><hr>
	<?php
		}
	?>
	  <?php
		}
	  ?>
	  <br/><br/><br/>

		<div class="ui teal tag label" ><h3>The number of messages:	<?php echo $total_records; ?></h3></div>
    </div>
 <div class="small ui modal">
	  <i class="close icon"></i>
	  <div class="header">
		 <span><?php echo $row_result["subject"];?></span>
	  </div>
	  
		
		<div class="content">
      <form class="ui form" method="post" action="new_message.php">
        <div class="field">
        <label>Subject</label> 
        <input type="text" name="subject" placeholder="Subject" /></div>
        <div class="field">
        <label>What to say</label> 
        <textarea rows="10" name="texts"></textarea></div>
          <div class="actions">
		  <button class="ui button" type="submit">Submit</button>
	  </div>
      </form>
    </div>
	 
	
	  </div>
  </body>
</html>
