
<div class="board-container">

<?php
//留言板
$start = ($page - 1) * $per;
$sql = 'SELECT C.id, C.comment, C.username, C.created_at, U.nickname, U.username FROM yayinchen_comments as C LEFT JOIN yayinchen_users as U ON C.username = U.username ORDER BY C.created_at DESC LIMIT '.$start.', '.$per;
$result = $conn->query($sql);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	echo '<div class="card mb-3 origin">';
	echo 	 '<h5 class="card-header py-2">';
	echo 	 		'<div class="author">'.escape($row["nickname"]).'</div>';
	echo 	 	  '<div class="time-stamp">'.$row["created_at"].'</div>';
	
	if($row["username"]===$user) { //作者出現編輯刪除按鈕及編輯框
		echo 		'<button class="btn btn-outline-success btn-edit btn-sm mr-2 float-right">編輯</button>';
		echo 		'<button class="btn btn-outline-success btn-delete btn-sm mr-2 float-right" data-comment-id="'.$row["id"].'">刪除</button>';
		echo	'</h5>';
		echo  '<div class="card-body">';
		echo    '<div class="card-text comment-text">'.escape($row["comment"]).'</div>';
		echo  '<form name="edit-comment-form" class="edit-comment-form" style="display:none;">';
		echo    '<textarea class="form-control edit-comment" name="edit-comment" rows="3">'.escape($row["comment"]).'</textarea>';
		echo    '<button type="button" class="btn btn-secondary btn-sm my-2 cancel-edit-comment">捨棄</button>';
		echo    '<button type="button" class="btn btn-primary btn-sm my-2 submit-edit-comment" data-comment-id="'.$row["id"].'">送出</button>';
		echo  '</form>';
	} else {
		echo	'</h5>';
		echo  '<div class="card-body">';
		echo    '<div class="card-text comment-text">'.escape($row["comment"]).'</div>';
	}
	    
//回覆
	$comment_id = $row["id"];
	$reply_count = $conn->query("SELECT COUNT(id) FROM yayinchen_replies as R WHERE R.parent_id = '$comment_id'");
	$data = $reply_count->fetch_assoc(); //子留言總數
	$replies = $data['COUNT(id)'];
	if($user) {
		echo    '<button class="btn btn-outline-success btn-reply btn-sm float-right">回覆</button>';
		echo 		'<div class="comment-info float-right" data-replies="'.$replies.'">回覆 '.$replies.'</div>';
		echo  	'<div class="input-group" style="display:none;">';
		echo		  '<input type="text" class="form-control new-reply" placeholder="回覆留言">';
		echo		  '<div class="input-group-append">';
		echo		    '<button class="btn btn-outline-success btn-sm submit-reply" data-comment-id="'.$row["id"].'">送出</button>';
		echo		  '</div>';  
		echo  	'</div>'; 
	} else {
		echo 		'<div class="comment-info float-right">回覆 '.$replies.'</div>';
	}
	echo 	 '</div>';

//子留言
	$sql_reply = "SELECT R.reply, R.username, R.created_at, U.nickname, U.username FROM yayinchen_replies as R LEFT JOIN yayinchen_users as U ON R.username = U.username WHERE R.parent_id = '$comment_id' ORDER BY R.created_at ASC ";
	$result_reply = $conn->query($sql_reply);
	if($result_reply->num_rows > 0) {
		echo  '<div class="card card-body border-right-0 border-bottom-0 border-left-0 reply" style="display:none;">';
		while($data = $result_reply->fetch_assoc()) {
			echo '<div class="card-text d-flex mb-3">';
			
			if($data["username"]===$row["username"]) { //原po回覆留言
				echo '<div class="reply-user mr-2 font-weight-bold">'.escape($data["nickname"]).'</div>'; 
			} else {
				echo '<div class="reply-user mr-2">'.escape($data["nickname"]).'</div>'; 
			}
			echo   '<div class="reply-text border-left">'.escape($data["reply"]).'</div>';
			echo '</div>';
		}
		echo '</div>';
	}
	echo '</div>';		
	}
}
?>
