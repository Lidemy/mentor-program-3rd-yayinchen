<?php 
	require_once('./conn.php');
	$comment_id = $_POST['id'];
	date_default_timezone_set('Asia/Taipei');
	$newComment = $_POST['comment'].' <br>(最後編輯：'.date("Y-m-d H:i:s").')';

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
				//確認為作者可以編輯
				$sql_author = "SELECT * FROM yayinchen_comments WHERE username = '$get_username' AND id = '$comment_id' ";
				$result_author = $conn->query($sql_author);
				if($result_author->num_rows > 0) {
					$sql_edit = "UPDATE yayinchen_comments SET comment = '$newComment' WHERE id = '$comment_id' ";
					$result_edit = $conn->query($sql_edit);
					if($result_edit) {
						echo '<script>alert("編輯成功！")</script>';
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