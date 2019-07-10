<?php
	require_once('./conn.php');
	$username = $_POST["username"];
	$password1 = $_POST["password1"];
	$nickname = $_POST["nickname"];
	$password = password_hash($password1, PASSWORD_DEFAULT);

	function randPassId() { //產生passId
		$passId = '';
		$word = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$len = strlen($word);
		for($i=0; $i<20; $i++) { //密碼長度20
			$passId .= $word[rand() % $len];
		}
		return $passId;
	}
	 

	$sql = "INSERT INTO yayinchen_users(username, password, nickname) VALUES ('$username', '$password', '$nickname') ";
	$result = $conn->query($sql); //寫入註冊資訊
	if($result) {
		$pass = randPassId();
		$sql_1 = "INSERT INTO yayinchen_users_certificate(id, username) VALUES ('$pass', '$username')";
		$result_1 = $conn->query($sql_1); //發通行證
		if($result_1) {
			setcookie("member_id", $pass, time() + 3600 * 24);
			header('Location: ./index.php');
		} else {
			echo '<script>alert("發生錯誤！")</script>';
			header('Location: ./register.php');
		}		
	} else {
		echo '<script>alert("發生錯誤！")</script>';
		header('Location: ./register.php');
	}
?>
