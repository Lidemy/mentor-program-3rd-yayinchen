<?php
	require_once('./conn.php');

	if(!isset($_COOKIE["member_id"])) {
	    echo '<script>alert("尚未登入！")</script>'; 
		header('Location: ./login.php');
	} else {
		$pass = $_COOKIE["member_id"];
		$comment = $_POST["comment"];

		$sql_1 = "SELECT * FROM yayinchen_users_certificate WHERE id = '$pass'";
		$result_1 = $conn->query($sql_1); //確認通行證
			if($result_1->num_rows > 0) {
				$row_1 = $result_1->fetch_assoc();
				$get_username = $row_1["username"];
			} else {
				echo '<script>alert("尚未登入！")</script>'; 
				header('Location: ./login.php');
			}

		$sql = "INSERT INTO yayinchen_comments(username, comment) VALUES ('$get_username', '$comment')";
		$result = $conn->query($sql);
		if($result) {
			header('Location: ./index.php');
		} else {
			echo "failed," . $conn->error;
		}			
	}	
?>

