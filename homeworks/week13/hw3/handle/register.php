<?php
	require_once '../conn.php';
	require_once '../utils.php';

	if( //確認資料齊全
		!isset($_POST['username']) || 
		!isset($_POST['password1']) ||
		!isset($_POST['password2']) ||
		!isset($_POST['nickname']) ||
        empty($_POST['username']) || 
        empty($_POST['password1']) ||
        empty($_POST['password2']) ||
        empty($_POST['nickname'])
    ) {
		alertMsg('資料不齊全！', '../index.php');
		exit();
	}

	if($_POST['password1'] !== $_POST['password2']) {
		alertMsg('密碼不相同！', '../index.php');
		exit();
	}

	$username = $_POST["username"];
	$nickname = $_POST["nickname"];
	$password = password_hash($_POST['password1'], PASSWORD_DEFAULT);

	$sql = $conn->prepare("INSERT INTO yayinchen_users(username, password, nickname) VALUES (?, ?, ?)");
	$sql->bind_param('sss', $username, $password, $nickname);
	if($sql->execute()) { //寫入註冊資訊
		session_start(); //session儲存登入資料
		$_SESSION['username'] = $username;
		$_SESSION['nickname'] = $nickname;

		alertMsg('註冊成功！', '../index.php');		
	} else {
		alertMsg($conn->error, '../index.php');
		exit();
	}	
?>
