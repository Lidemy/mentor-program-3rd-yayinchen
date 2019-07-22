<?php
	require_once('./conn.php');
	$pass = $_COOKIE["member_id"];

	$sql = $conn->prepare("DELETE FROM yayinchen_users_certificate WHERE id = ?");
	$sql->bind_param('s', $pass);
	if($sql->execute()) {
		setcookie("member_id", '');
	} else {
		echo '<script>alert("Error: '.$conn->error.'")</script>'; 					
	}
	header('Location: ./login.php');
?>