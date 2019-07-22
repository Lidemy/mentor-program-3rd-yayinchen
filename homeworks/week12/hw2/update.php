<?php
	require_once('./conn.php');
	$pass = $_COOKIE["member_id"];

	$sql_1 = $conn->prepare("SELECT * FROM yayinchen_users_certificate WHERE id = ?");
	$sql_1->bind_param("s", $pass);
	$sql_1->execute();
	$result_1 = $sql_1->get_result(); //確認通行證
		if($result_1->num_rows > 0) {
			$row_1 = $result_1->fetch_assoc();
			$get_username = $row_1["username"];

			$sql = $conn->prepare("SELECT * FROM yayinchen_users WHERE username = ?");
			$sql->bind_param('s', $get_username);
			$sql->execute();
			$result = $sql->get_result(); //取得用戶資料
			$row = $result->fetch_assoc();
		} else {
			echo '<script>alert("尚未登入！");
			  	  location = "./login.php"</script>';
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
				<button class="btn btn_update">更新</button>
				<a href="./index.php">取消</a>
			</form>
		</div>		
	</div>
</body>
</html>