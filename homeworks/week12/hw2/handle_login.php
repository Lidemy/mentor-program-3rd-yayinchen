<?php
	require_once('./conn.php');
	$username = $_POST["username"];
	$password = $_POST["password"];
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

	$sql = $conn->prepare("SELECT * FROM yayinchen_users WHERE username = ?");
	$sql->bind_param("s", $username);
	$sql->execute();
	$result = $sql->get_result();
	if($result->num_rows > 0) { //確認證號存在
		$row = $result->fetch_assoc();
		if(password_verify($password, $row["password"])) { //驗證密碼	    	
			$sql_1 = $conn->prepare("INSERT INTO yayinchen_users_certificate(id, username) VALUES (?, ?)");
			$sql_1->bind_param('ss', $pass, $username);
			if($sql_1->execute()) { //發通行證
				setcookie("member_id", $pass, time() + 3600 * 24);
				header('Location: ./index.php');
			
				$sql_2 = $conn->prepare("UPDATE yayinchen_users_certificate SET id = ? WHERE username = ?");
				$sql_2->bind_param('ss', $pass, $username);
				if($sql_2->execute()) { //server存通行證
					setcookie("member_id", $pass, time() + 3600 * 24);
					header('Location: ./index.php');
				} else {
					echo '<script>alert("Error: '.$conn->error.'");
				  		  location = "./login.php"</script>';				
				}
			} else {
				echo '<script>alert("Error: '.$conn->error.'");
				      location = "./login.php"</script>';
			} 
		} else {
			echo '<script>alert("Error: '.$conn->error.'");
				  location = "./login.php"</script>';
		}
	} else {
		echo '<script>alert("Error: '.$conn->error.'");
			  location = "./login.php"</script>'; 
	}
?>