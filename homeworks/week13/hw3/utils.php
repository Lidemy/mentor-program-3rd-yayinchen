<?php

function escape($str) { //避免xss攻擊
  $data = htmlspecialchars($str, ENT_QUOTES, 'utf-8');
  return $data;
}

function alertMsg($msg, $redirect) { //動作結果通知加跳轉網頁
	echo "<script>alert('".htmlentities($msg, ENT_QUOTES)."');
	      location = '".$redirect."'</script>";
}


?>