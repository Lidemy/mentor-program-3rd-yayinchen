<?php
	require_once('./conn.php');
	$username = $_POST["username"];
	$password1 = $_POST["password1"];
	$nickname = $_POST["nickname"];
	$password = password_hash($password1, PASSWORD_DEFAULT);
	$pass = randomPassId();

	function randomPassId() { //產生passId
		$passId = '';
		$word = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$len = strlen($word);
		for($i=0; $i<20; $i++) { //密碼長度20
			$passId .= $word[rand() % $len];
		}
		return $passId;
	}

	$sql = $conn->prepare("INSERT INTO yayinchen_users(username, password, nickname) VALUES (?, ?, ?)");
	$sql->bind_param('sss', $username, $password, $nickname);
	if($sql->execute()) { //寫入註冊資訊
		$sql_1 = $conn->prepare("INSERT INTO yayinchen_users_certificate(id, username) VALUES (?, ?)");
		$sql_1->bind_param('ss', $pass, $username); 
		if($sql_1->execute()) { //發通行證
			setcookie("member_id", $pass, time() + 3600 * 24);
			header('Location: ./index.php');
		} else {
			echo '<script>alert("Error: '.$conn->error.'");
			  	  location = "./register.php"</script>';
		}		
	} else {
		echo '<script>alert("Error: '.$conn->error.'");
			  location = "./register.php"</script>';
	}
?>
