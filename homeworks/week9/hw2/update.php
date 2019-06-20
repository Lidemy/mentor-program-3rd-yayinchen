<?php
	require_once('./conn.php');
	$user_id = $_COOKIE["member_id"];
	$sql = "SELECT * FROM yayinchen_users WHERE id = '$user_id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>week9留言板</title>
	<link rel="stylesheet" href="./index.css">
</head>
<body>
	<div class="container">
		<div class="warning"><span>！！！</span>本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼<span>！！！</span></div>
		<div class="header">yayin~week9的留言板</div>
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