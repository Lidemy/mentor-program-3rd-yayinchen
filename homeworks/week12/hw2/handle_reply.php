<?php
	require_once('./conn.php');

	if(!isset($_COOKIE["member_id"])) {
	    echo '<script>alert("尚未登入！")</script>'; 
		header('Location: ./login.php');
	} else {
		$pass = $_COOKIE["member_id"];
		$reply = $_POST["reply"];
		$comment_id = $_POST["comment_id"];
		$page = $_GET["page"];
		$url = './index.php?page='.$page;

		$sql_1 = "SELECT * FROM yayinchen_users_certificate WHERE id = '$pass'";
		$result_1 = $conn->query($sql_1); //確認通行證
			if($result_1->num_rows > 0) {
				$row_1 = $result_1->fetch_assoc();
				$get_username = $row_1["username"];
			} else {
				echo '<script>alert("尚未登入！")</script>'; 
				header('Location: ./login.php');
			}

		if($reply == '') {
			echo '<script>alert("尚未輸入回覆內容！")</script>';
			header("Location:$url"); 
		} else {
			$sql = "INSERT INTO yayinchen_replies(username, reply, parent_id) VALUES ('$get_username', '$reply', '$comment_id')";
			$result = $conn->query($sql);
			if($result) {
				header("Location:$url");
			} else {
				echo "failed," . $conn->error;
			}
		}
					
	}	
?>

