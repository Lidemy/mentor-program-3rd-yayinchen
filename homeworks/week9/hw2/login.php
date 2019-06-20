<?php require_once('./conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>week9留言板</title>
	<link rel="stylesheet" href="./index.css">
</head>
<body>
	<div class="container">
		<div class="warning"><span>！！！</span>本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼<span>！！！</span></div>
		<div class="header">yayin~week9的留言板</div>
		<div class="main">
			<form class="loginArea" name="login" method="POST" action="./handle_login.php">
				<div>帳號: <input class="input" type="text" name="username" /></div>
				<div>密碼: <input type="password" name="password" /></div>
				<button class="btn btn_login">登入</button>
				<div class="alert hidden">資料未齊全！</div>
			</form>
			<form class="loginArea" name="register" method="GET" action="./register.php">
				<div>沒有帳號嗎？ <button class="btn btn_register1">我要註冊</button></div>
			</form>
		</div>		
	</div>
	<script>
		const username = document.querySelector('input[name=username]')
		const password = document.querySelector('input[name=password]')
		document.querySelector('.btn_login').addEventListener('click', function(e) {
			if(username.value === '' || password.value === '') {
				e.preventDefault()
				document.querySelector('.hidden').classList.remove('hidden')
			}
		})

	</script>
</body>
</html>