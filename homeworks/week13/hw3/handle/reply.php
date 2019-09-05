<?php
	require_once '../conn.php';
	require_once '../utils.php';
	require_once '../check_login.php';

	if(!$user) { //未登入
		alertMsg("尚未登入！", "./index.php");		
	}
	if(empty($_POST["reply"])) { //內容為空
		exit();
	} 

	$sql = $conn->prepare("INSERT INTO yayinchen_replies(username, reply, parent_id) VALUES (?, ?, ?)");
	$sql->bind_param('ssi', $user, $_POST["reply"], $_POST["comment_id"]);
	if($sql->execute()) {
		echo json_encode(array(
			'result' => 'success',
			'message' => 'reply successfully',
			'nickname' => $nickname,
			'reply' => $_POST["reply"],
			));
	} else {
		echo json_encode(array(
			'result' => 'failure',
			'message' => 'reply failed',
			));
	}
				
?>

