<?php
	require_once('./conn.php');

	if(!isset($_COOKIE["member_id"])) {
	    echo '<script>alert("尚未登入！");
			  location = "./login.php"</script>';
	} else {
		$pass = $_COOKIE["member_id"];
		$reply = $_POST["reply"];
		$comment_id = $_POST["comment_id"];
		$page = $_GET["page"];
		$url = './index.php?page='.$page;

		$sql_1 = $conn->prepare("SELECT * FROM yayinchen_users_certificate WHERE id = ?");
		$sql_1->bind_param("s", $pass);
		$sql_1->execute();
		$result_1 = $sql_1->get_result(); //確認通行證
			if($result_1->num_rows > 0) {
				$row_1 = $result_1->fetch_assoc();
				$get_username = $row_1["username"];
			} else {
				echo '<script>alert("尚未登入！");
			  		  location = "./login.php"</script>';
			}
		if($reply == '') {
			echo '<script>alert("尚未輸入回覆內容！");
			  	  location = "'.$url.'"</script>';
		} else {
				$sql = $conn->prepare("INSERT INTO yayinchen_replies(username, reply, parent_id) VALUES (?, ?, ?)");
				$sql->bind_param('ssi', $get_username, $reply, $comment_id);
				$sql->execute();
				$result = $sql->get_result();
				header("Location:$url");
		}					
	}	
?>

