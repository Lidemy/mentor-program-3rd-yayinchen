<?php
	require_once '../conn.php';
	require_once '../utils.php';

	if( //確認有輸入資料
		!isset($_POST['username']) || 
		!isset($_POST['password']) ||
        empty($_POST['username']) || 
        empty($_POST['password'])
    ) {
		alertMsg('請輸入帳號密碼！', '../index.php');
		exit();
	}

	$username = $_POST["username"];
	$password = $_POST["password"];

	$sql = $conn->prepare("SELECT * FROM yayinchen_users WHERE username = ?");
	$sql->bind_param("s", $username);
	$sql->execute(); //搜尋帳號
	$result = $sql->get_result();

	if(!$result) { 
		alertMsg($conn->error, '../index.php');
		exit();
	}
	if(!$result->num_rows > 0) { //無該帳號
		alertMsg('帳號密碼錯誤！', '../index.php');
		exit();
	}
	
	$row = $result->fetch_assoc();
	if(!password_verify($password, $row["password"])) { //密碼不符
		alertMsg('帳號密碼錯誤！', '../index.php');
		exit();
	}

	session_start(); //session儲存登入資料
	$_SESSION['username'] = $row['username'];
	$_SESSION['nickname'] = $row['nickname'];

	alertMsg('登入成功！', '../index.php');

?>