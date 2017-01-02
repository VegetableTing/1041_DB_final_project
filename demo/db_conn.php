<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=test;charset=utf8','root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>