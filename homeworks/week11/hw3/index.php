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
		<div class="header">yayin的留言板</div>
		<form class="inputArea" method="POST" action="./handle_add.php">
			<div class="userArea">
	<?php
		if(!isset($_COOKIE["member_id"])) {
	    echo '<div class="notLogin">not login<a href="./login.php"> 登入 </a></div>';
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
				echo '<div class="login_user">' . $row['username'] . ' (' . $row['nickname'] . ') <a href="./update.php">修改暱稱</a> <a href="./admin.php">管理留言</a> <a href="./logout.php">登出</a></div>';
					
			}
		}	
	?>
				 
			</div>
			<textarea type="text" name="comment" placeholder="在此輸入訊息"></textarea>

			<button class="btn btn_comment">留言</button>
		</form>
		<div class="main">
		<?php
			$result_count = $conn->query('SELECT COUNT(id) FROM yayinchen_comments');
			$sum1 = $result_count->fetch_assoc(); //留言總數
			$sum = $sum1['COUNT(id)'];
			$per = 20; //每頁留言數
			$pages = ceil($sum/$per);

			for($i=1; $i<=$pages; $i++) { //分頁連結
				echo ' <a class="page'.$i.'" href="./index.php?page='.$i.'">第' . $i . '頁</a>';
			}
			if(!isset($_GET['page'])) {
				$page = 1;
			} else {
				$page = intval($_GET['page']);
			}
 			$start = ($page - 1) * $per;
			$sql = 'SELECT comments.comment, comments.username, comments.created_at, users.nickname, users.username FROM yayinchen_comments as comments LEFT JOIN yayinchen_users as users ON comments.username = users.username ORDER BY comments.created_at DESC LIMIT '.$start.', '.$per;
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
		<?php
			if($page == 1) {
				echo ' <a href="./index.php?page='.($page+1).'">後一頁</a>';
			} else if($page == $pages) {
				echo ' <a href="./index.php?page='.($page-1).'">前一頁</a>';
			} else {
				echo ' <a href="./index.php?page='.($page-1).'">前一頁</a>';
				echo ' <a href="./index.php?page='.($page+1).'">後一頁</a>';
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
		//標示當前分頁
		document.querySelector('.page<?php echo $page; ?>').style.background = 'white'

	</script>
</body>
</html>