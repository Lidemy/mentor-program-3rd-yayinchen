<?php
	require_once('./conn.php');
	$username = $_POST["username"];
	$password = $_POST["password"];

	function randPassId() { //產生passId
		$passId = '';
		$word = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$len = strlen($word);
		for($i=0; $i<20; $i++) { //密碼長度20
			$passId .= $word[rand() % $len];
		}
		return $passId;
	}

	$sql = "SELECT * FROM yayinchen_users WHERE username = '$username'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) { //確認證號存在
		$row = $result->fetch_assoc();
		if(password_verify($password, $row["password"])) { //驗證密碼
	    	$pass = randPassId();
			$sql_1 = "INSERT INTO yayinchen_users_certificate(id, username) VALUES ('$pass', '$username')";
			$result_1 = $conn->query($sql_1); //發通行證
			if($result_1) {
				setcookie("member_id", $pass, time() + 3600 * 24);
				header('Location: ./index.php');
			} else {
				$sql_2 = "UPDATE yayinchen_users_certificate SET id = '$pass' WHERE username = '$username'";
				$result_2 = $conn->query($sql_2); 
				setcookie("member_id", $pass, time() + 3600 * 24);
				header('Location: ./index.php');
			}
		} else {
			echo '<script>alert("發生錯誤！")</script>'; 
			header('Location: ./login.php');
		} 
	} else {
		echo '<script>alert("發生錯誤！")</script>'; 
		header('Location: ./login.php');
	}

?>