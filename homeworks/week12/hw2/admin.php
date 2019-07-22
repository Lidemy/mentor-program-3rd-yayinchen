<?php require_once('./conn.php'); ?>
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
		<div class="header">yayin的留言板 之 我的留言</div>
		<form class="inputArea" method="POST" action="./handle_add.php">
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
					echo '<div class="login_user">' . htmlspecialchars($row['username'], ENT_QUOTES, 'utf-8') . ' (' . htmlspecialchars($row['nickname'], ENT_QUOTES, 'utf-8') . ') <a href="./update.php">修改暱稱</a> <a href="./index.php">回到留言</a> <a href="./logout.php">登出</a></div>';
				}	
			}
		}	
	?>
				 
			</div>
			<textarea class="comment" type="text" name="comment" placeholder="在此輸入訊息"></textarea>

			<button class="btn btn_comment">新增</button>
		</form>
		<div class="main">
		<?php 
			$sql = "SELECT C.id, C.comment, C.username, C.created_at, U.nickname, U.username FROM yayinchen_comments as C LEFT JOIN yayinchen_users as U ON C.username = U.username WHERE U.username = '$get_username' ORDER BY C.created_at DESC";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$id = $row["id"];
					echo '<div class="commentCard">';
					echo 	'<div class="username">' . htmlspecialchars($row["username"], ENT_QUOTES, 'utf-8').' ('.htmlspecialchars($row["nickname"], ENT_QUOTES, 'utf-8').') </div>';
					echo 	'<div class="createdAt">' . $row["created_at"] . '</div>';
					echo 	'<div class="commentText">' . htmlspecialchars($row["comment"], ENT_QUOTES, 'utf-8') . '</div>';
					echo    '<a href="./edit_comment.php?id='. $id .'">編輯</a>';
					echo    ' <a href="./delete_comment.php?id='. $id .'">刪除</a>';
					echo '</div>';
				}
			}
		?>
		</div>
	</div>
	
</body>
</html>