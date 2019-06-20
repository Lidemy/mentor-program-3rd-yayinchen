<?php
	require_once('./conn.php');
	$username = $_POST["username"];
	$password1 = $_POST["password1"];
	$password2 = $_POST["password2"];
	$nickname = $_POST["nickname"];

	$sql = "INSERT INTO yayinchen_users(username, password, nickname) VALUE ('$username', '$password1', '$nickname') ";
	$result = $conn->query($sql);
	if($result) {
		$sql_1 = "SELECT * FROM yayinchen_users WHERE username = '$username'";
		$result_1 = $conn->query($sql_1);
		$row = $result_1->fetch_assoc();
		setcookie("member_id", $row["id"], time() + 3600 * 24);
		header('Location: ./index.php');
	} else {
		echo '註冊失敗，原因：' . $conn->error . '<br>';
		echo '<a href="./register.php">繼續註冊</a>';
	}
?>
