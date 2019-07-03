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
	    header('Location: ./login.php');
		} else {
		$pass = $_COOKIE["member_id"];
		$sql_1 = "SELECT * FROM yayinchen_users_certificate WHERE id = '$pass'";
		$result_1 = $conn->query($sql_1); //確認通行證
			if($result_1->num_rows > 0) {
				$row_1 = $result_1->fetch_assoc();
				$get_username = $row_1["username"];
				$sql = "SELECT * FROM yayinchen_users WHERE username = '$get_username'";
				$result = $conn->query($sql); //取得用戶資料
				$row = $result->fetch_assoc();
				echo '<div class="login_user">' . $row['username'] . ' (' . $row['nickname'] . ')<a href="./update.php"> 修改暱稱 </a><a href="./index.php"> 回留言版 </a><a href="./logout.php"> 登出 </a></div>';
				
			}
		}	
	?>
				 
			</div>
			<textarea type="text" name="comment" placeholder="在此輸入訊息"></textarea>

			<button class="btn btn_comment">新增</button>
		</form>
		<div class="main">
		<?php 
			$sql = "SELECT comments.id, comments.comment, comments.username, comments.created_at, users.nickname, users.username FROM yayinchen_comments as comments LEFT JOIN yayinchen_users as users ON comments.username = users.username WHERE users.username = '$get_username' ORDER BY comments.created_at DESC";
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$id = $row["id"];
					echo '<div class="commentCard">';
					echo 	'<div class="username">' . $row["username"].' ('.$row["nickname"].') </div>';
					echo 	'<div class="createdAt">' . $row["created_at"] . '</div>';
					echo 	'<div class="commentText">' . $row["comment"] . '</div>';
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