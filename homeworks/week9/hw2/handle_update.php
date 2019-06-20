<?php
	require_once('./conn.php');

	if(!isset($_COOKIE["member_id"])) {
	    die('not login');
	} else {
		$user_id = $_COOKIE["member_id"];
		$newNickname = $_POST["nickname"];
		$sql = "UPDATE yayinchen_users SET nickname = '$newNickname' WHERE id = $user_id";
		$result = $conn->query($sql);
		if($result) {
			header('Location: ./index.php');
		} else {
			echo "failed," . $conn->error;
		}			
	}	
?>