<?php 
	require_once '../conn.php';
	require_once '../utils.php';
	require_once '../check_login.php';

	if(!$user) { //未登入
		alertMsg("尚未登入！", "./index.php");		
	};
	if(empty($_POST['edit_comment'])) { //內容為空
		exit();
	}

	date_default_timezone_set('Asia/Taipei');
	$edit_comment = $_POST['edit_comment'].'
	( 最後編輯：'.date("Y-m-d H:i:s").' )';

	$sql_edit = $conn->prepare("UPDATE yayinchen_comments SET comment = ? WHERE username = ? AND id = ?");
	$sql_edit->bind_param('ssi', $edit_comment, $user, $_POST['comment_id']);
	if($sql_edit->execute()) {
		echo json_encode(array(
			'result' => 'success',
			'message' => 'edited successfully',
			'edited_comment' => $edit_comment
			));
	} else {
		echo json_encode(array(
			'result' => 'failure',
			'message' => 'edited fail'
			));
	}		
	

 ?>