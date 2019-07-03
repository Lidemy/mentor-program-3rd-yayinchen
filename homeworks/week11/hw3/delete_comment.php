<?php 
	require_once('./conn.php');
	$comment_id = $_GET['id'];

	if(!isset($_COOKIE["member_id"])) {
		echo '<script>alert("尚未登入！")</script>';
	    header('Location: ./login.php');
	} else {
		$pass = $_COOKIE["member_id"];
		$sql_1 = "SELECT * FROM yayinchen_users_certificate WHERE id = '$pass'";
		$result_1 = $conn->query($sql_1); //確認通行證
			if($result_1->num_rows > 0) {
				$row_1 = $result_1->fetch_assoc();
				$get_username = $row_1["username"];
				//確認為作者可以刪除
				$sql_author = "SELECT * FROM yayinchen_comments WHERE username = '$get_username' AND id = '$comment_id'";
				$result_author = $conn->query($sql_author);
				if($result_author->num_rows > 0) {
					$sql_del = "DELETE FROM yayinchen_comments WHERE id = '$comment_id' ";
					$result_del = $conn->query($sql_del);
					if($result_del) {
						echo '<script>alert("刪除成功！")</script>';
						header('Location: ./admin.php');
					} else {
						echo '<script>alert("發生錯誤！")</script>';
						header('Location: ./admin.php');
					}		
				} else {
					echo '<script>alert("沒有權限！")</script>';
					header('Location: ./index.php');
				}
			} 
		}
 ?>