<?php
	include_once 'db_conn.php';
	session_start();
	session_destroy();
	$dbh = null;
	echo "<script>location.href='login.php'</script>";
?>