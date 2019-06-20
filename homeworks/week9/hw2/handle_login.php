<?php
	require_once('./conn.php');
	$username = $_POST["username"];
	$password = $_POST["password"];

	$sql = "SELECT * FROM yayinchen_users WHERE username = '$username' and password = '$password'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		setcookie("member_id", $row["id"], time() + 3600 * 24);
		header('Location: ./index.php');
	} else {
		header('Location: ./login.php');
	}
?>