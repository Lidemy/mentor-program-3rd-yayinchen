<?php require_once('./conn.php'); ?>
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
		<form class="inputArea" method="POST" action="./handle_add.php">
			<div class="userArea">
	<?php
		if(!isset($_COOKIE["member_id"])) {
	    echo '<div class="notLogin">not login<a href="./login.php"> 登入 </a></div>';
		} else {
		$user_id = $_COOKIE["member_id"];
		$sql = "SELECT * FROM yayinchen_users WHERE id = '$user_id'";
		$result = $conn->query($sql);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo '<div class="login_user">' . $row['username'] . ' (' . $row['nickname'] . ')<a href="./update.php"> 修改暱稱 </a><a href="./logout.php"> 登出 </a></div>';
				}	
			}
		}	
	?>
				 
			</div>
			<textarea type="text" name="comment" placeholder="在此輸入訊息"></textarea>

			<button class="btn btn_comment">送出</button>
		</form>
		<div class="main">
		<?php 
			$sql = 'SELECT comments.comment, comments.user_id, comments.created_at, users.nickname, users.username FROM yayinchen_comments as comments LEFT JOIN yayinchen_users as users ON comments.user_id = users.id ORDER BY comments.created_at DESC LIMIT 50';
			$result = $conn->query($sql);
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo '<div class="commentCard">';
					echo 	'<div class="username">' . $row["username"].' ('.$row["nickname"].') </div>';
					echo 	'<div class="createdAt">' . $row["created_at"] . '</div>';
					echo 	'<div class="commentText">' . $row["comment"] . '</div>';
					echo '</div>';
				}
			}
		?>
		</div>
	</div>
	<script>
		//檢查留言送出時有無內容及登入
		const comment = document.querySelector('textarea')
		const notLogin = document.querySelector('.notLogin')
		document.querySelector('.btn').addEventListener('click', function(e) {
			if(comment.value === '') {
				e.preventDefault()
				alert('尚未輸入內容')
			}
			if(notLogin) {
				e.preventDefault()
				alert('請先登入')
			}
		})

	</script>
</body>
</html>