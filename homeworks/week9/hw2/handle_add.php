<?php
	require_once('./conn.php');

	if(!isset($_COOKIE["member_id"])) {
	    die('not login');
	} else {
		$user_id = $_COOKIE["member_id"];
		$comment = $_POST["comment"];
		$sql = "INSERT INTO yayinchen_comments(user_id, comment) VALUES ('$user_id', '$comment')";
		$result = $conn->query($sql);
		if($result) {
			header('Location: ./index.php');
		} else {
			echo "failed," . $conn->error;
		}			
	}	
?>