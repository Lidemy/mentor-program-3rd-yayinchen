<?php
	require_once('./conn.php');
	$pass = $_COOKIE["member_id"];
	$sql_1 = "SELECT * FROM yayinchen_users_certificate WHERE id = '$pass'";
	$result_1 = $conn->query($sql_1); //確認通行證
		if($result_1->num_rows > 0) {
			$row_1 = $result_1->fetch_assoc();
			$get_username = $row_1["username"];
			$sql = "SELECT * FROM yayinchen_users WHERE username = '$get_username'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
		} else {
			echo '<script>alert("尚未登入！")</script>'; 
			header('Location: ./login.php');
		}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>yayin留言板</title>
	<link rel="stylesheet" href="./index.css">
</head>
<body>
	<div class="container">
		<div class="warning"><span>！！！</span>本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼<span>！！！</span></div>
		<div class="header">yayin的留言板</div>
		<div class="main">
			<form class="loginArea" name="update" method="POST" action="./handle_update.php">
				<div>設定暱稱: <input type="text" name="nickname" value="<?php echo $row['nickname'];?>" /><span class="description">英數中文皆可</span></div>		
				<button class="btn_update">更新</button>
				<a href="./index.php">取消</a>
			</form>
		</div>		
	</div>
</body>
</html>