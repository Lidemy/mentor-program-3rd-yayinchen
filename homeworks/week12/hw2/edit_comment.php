<?php 
	require_once('./conn.php'); 
	$comment_id = $_GET['id'];
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
		<div class="header">yayin留言板 之 編輯留言</div>
		<form class="inputArea" method="POST" action="./handle_edit.php">
			<div class="userArea">
	<?php
		if(!isset($_COOKIE["member_id"])) {
	    echo '<div class="notLogin">not login<a href="./login.php"> 登入 </a></div>';
		} else {
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
				while($row = $result->fetch_assoc()) {
					echo '<div class="login_user">' . htmlspecialchars($row['username'], ENT_QUOTES, 'utf-8') . ' (' . htmlspecialchars($row['nickname'], ENT_QUOTES, 'utf-8') . ') <a href="./update.php">修改暱稱</a> <a href="./admin.php">管理留言</a> <a href="./logout.php">登出</a></div>';
				}

				$sql_author = $conn->prepare("SELECT * FROM yayinchen_comments WHERE username = ? AND id = ?");
				$sql_author->bind_param('si', $get_username, $comment_id);
				$sql_author->execute();
				$result_author = $sql_author->get_result(); //確認為作者可以編輯
				if($result_author->num_rows > 0) {
					$row_comment = $result_author->fetch_assoc();
				}
			}
		}					
	?>				 
			</div>
			<textarea class="comment" type="text" name="comment"><?php echo $row_comment["comment"];?></textarea>
			<input type="hidden" name="id" value="<?php echo $row_comment["id"];?>">
			<button class="btn btn_comment">修改</button>
		</form>
		<div class="main">
		</div>
	</div>	
</body>
</html>