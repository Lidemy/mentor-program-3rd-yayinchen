<?php 
	require_once '../conn.php';
	require_once '../utils.php';
	require_once '../check_login.php';

	if(!$user) { //未登入
		alertMsg("尚未登入！", "./index.php");		
	};

	$sql_del = $conn->prepare("DELETE FROM yayinchen_comments WHERE username = ? AND id = ?");
	$sql_del->bind_param('si', $user, $_POST['comment_id']);
	if($sql_del->execute()) {
		echo json_encode(array(
			'result' => 'success',
			'message' => 'deleted successfully'
			));
	} else {
		echo json_encode(array(
			'result' => 'failure',
			'message' => 'deleted fail'
			));
	}		
					
 ?>