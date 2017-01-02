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
				  id: {
				  identifier  : 'id',
				  rules: [
					{
					  type   : 'empty',
					  prompt : 'Please enter your id'
					}
				  ]
				},
				name: {
				  identifier  : 'name',
				  rules: [
					{
					  type   : 'empty',
					  prompt : 'Please enter your name'
					}
				  ]
				},
				password: {
				  identifier  : 'password',
				  rules: [
					{
					  type   : 'empty',
					  prompt : 'Please enter your password'
					},
					{
					  type   : 'length[6]',
					  prompt : 'Your password must be at least 6 characters'
					}
				  ]
				},
				password2: {
				  identifier  : 'password2',
				  rules: [
					{
					  type   : 'empty',
					  prompt : 'Please enter your password'
					},
					{
						type : 'match[password]',
						prompt : 'Password incorrect'
					},
					{
					  type   : 'length[6]',
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
    <title>sign up</title>
  </head>
  <body>
    <div class="content">
      <form class="ui large form" method="post" action="sign.php">
        <div class="ui stacked segment">
          <div class="field">
            <div class="ui left icon input">
              <input type="text" name="name" placeholder="Name" />
            </div>
          </div>
		  <div class="field">
            <div class="ui left icon input">
              <input type="text" name="id" placeholder="Id" />
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <input type="password" name="password" placeholder="Password" />
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <input type="password" name="password2" placeholder="re-enter your Password" />
            </div>
          </div>
          <div class="ui fluid large teal submit button">Sign up</div>
        </div>
        <div id="error" class="ui error message" hidden>The name was used by other people</div>
		<a id="login" class="ui positive message" href="login.php" hidden>Log in with your account</a>
      </form>
    </div>
  </body>
</html>

<?php
	include_once 'db_conn.php' ;
	$sql = "INSERT INTO user VALUES(?,?,?)";
	$sth = $dbh->prepare($sql);
	if(isset($_POST['name']) && isset($_POST['password'])){
		$name = $_POST['name'];
		$id = $_POST['id'];
		$password = md5($_POST['password']);
		try{
			$sth->execute(array($name,$password,$id));
		}catch(Exception $e){
			echo "<script>$('#error').show()</script>";
		}
		echo "<script>$('#login').show()</script>";
	}
?>