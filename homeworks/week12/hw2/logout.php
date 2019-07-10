<?php
	require_once('./conn.php');
	$pass = $_COOKIE["member_id"];
	$sql = "DELETE FROM yayinchen_users_certificate WHERE id = '$pass'";
	$result = $conn->query($sql);
	if($result) {
		setcookie("member_id", '');
		header('Location: ./login.php');
	} else {
		die('!');
	}
	
?>