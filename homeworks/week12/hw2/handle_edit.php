<?php 
	require_once('./conn.php');
	$comment_id = $_POST['id'];
	date_default_timezone_set('Asia/Taipei');
	$newComment = $_POST['comment'].'(最後編輯：'.date("Y-m-d H:i:s").')';
	$pass = $_COOKIE["member_id"];

	if(!isset($_COOKIE["member_id"])) {
		echo '<script>alert("尚未登入！");
			  location = "./login.php"</script>';
	} else {
		$sql_1 = $conn->prepare("SELECT * FROM yayinchen_users_certificate WHERE id = ?");
		$sql_1->bind_param("s", $pass);
		$sql_1->execute();
		$result_1 = $sql_1->get_result(); //確認通行證
			if($result_1->num_rows > 0) {
				$row_1 = $result_1->fetch_assoc();
				$get_username = $row_1["username"];
			} else {
				echo '<script>alert("尚未登入！");
			  		  location = "./login.php"</script>';
			}				
		$sql_author = $conn->prepare("SELECT * FROM yayinchen_comments WHERE username = ? AND id = ?");
		$sql_author->bind_param('si', $get_username, $comment_id);
		$sql_author->execute();
		$result_author = $sql_author->get_result(); //確認為作者可以編輯
		if($result_author->num_rows > 0) {
			$sql_edit = $conn->prepare("UPDATE yayinchen_comments SET comment = ? WHERE id = ?");
			$sql_edit->bind_param('si', $newComment, $comment_id);
			if($sql_edit->execute()) {
				echo '<script>alert("編輯成功！");
			  		  location = "./admin.php"</script>';
			} else {
				echo '<script>alert("Error: '.$conn->error.'");
			  		  location = "./admin.php"</script>';
			}		
		} else {
			echo '<script>alert("沒有權限！");
			  	  location = "./index.php"</script>';
		}
	} 		
 ?>