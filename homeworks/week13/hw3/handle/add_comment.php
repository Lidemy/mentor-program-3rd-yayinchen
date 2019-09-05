<?php
	require_once '../conn.php';
	require_once '../utils.php';
	require_once '../check_login.php';
	
	if(empty($_POST["comment"])) { //留言為空則離開
		exit();
	};

	if(!$user) { //未登入
		alertMsg("尚未登入！", "./index.php");		
	};

	$sql = $conn->prepare("INSERT INTO yayinchen_comments(username, comment) VALUES (?, ?)");
	$sql->bind_param("ss", $user, $_POST["comment"]);
	if($sql->execute()) {
		$last_id = $sql->insert_id;
		$new = $conn->prepare("SELECT * FROM yayinchen_comments WHERE id = ?");
		$new->bind_param("i", $last_id);
		$new->execute();
		$result = $new->get_result();
		$row = $result->fetch_assoc();
		echo json_encode(array(
			'result' => 'success',
			'message' => 'posted successfully',
			'id' => $last_id,
			'time' => $row["created_at"],
			'nickname' => $nickname
			));
	} else {
		echo json_encode(array(
			'result' => 'failure',
			'message' => 'posted fail'
			));
	}				
?>

