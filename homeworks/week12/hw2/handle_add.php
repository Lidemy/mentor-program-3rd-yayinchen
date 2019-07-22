<?php
	require_once('./conn.php');
	$pass = $_COOKIE["member_id"];
	$comment = $_POST["comment"];

	if(!isset($_COOKIE["member_id"])) {
		echo '<script>alert("尚未登入！");
			  location = "./login.php"</script>';
	} else {
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

		$sql = $conn->prepare("INSERT INTO yayinchen_comments(username, comment) VALUES (?, ?)");
		$sql->bind_param("ss", $get_username, $comment);
		if($sql->execute()) {
			header('Location: ./index.php');
		} else {
			echo '<script>alert("Error: '.$conn->error.'");
			  	  location = "./admin.php"</script>';
		}		
	}	
?>

