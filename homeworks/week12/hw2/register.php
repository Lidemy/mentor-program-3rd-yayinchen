<?php require_once('./conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>yayin留言板</title>
	<link rel="stylesheet" href="./index.css">
</head>
<body>
	<div class="container">
		<div class="warning"><span>！！！</span>本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼<span>！！！</span></div>
		<div class="header">yayin~的留言板</div>
		<div class="main">
			<form class="loginArea" name="login" method="POST" action="./handle_register.php">
				<div>設定帳號: <input type="text" name="username" /><span class="description">英數，勿使用真實的帳號</span></div>
				<div>設定密碼: <input type="password" name="password1" /><span class="description">英數，勿使用真實的密碼</span></div>
				<div>確認密碼: <input type="password" name="password2" /><span class="description">英數</span></div>
				<div>設定暱稱: <input type="text" name="nickname" /><span class="description">非必填，英數中文皆可</span></div>		
				<button class="btn_register">註冊</button>
				<a href="./login.php">取消</a>
				<div class="alert hidden">資料未齊全！</div>
			</form>
		</div>		
	</div>
		<script>
		const username = document.querySelector('input[name=username]')
		const password1 = document.querySelector('input[name=password1]')
		const password2 = document.querySelector('input[name=password2]')
		document.querySelector('.btn_register').addEventListener('click', function(e) {
			if(username.value === '' || password1.value === '' || password2.value === '' ) {
				e.preventDefault()
				document.querySelector('.alert').classList.remove('hidden')
			} else if(password1.value !== password2.value) {
				e.preventDefault()
				document.querySelector('.alert').innerText = '密碼不相同！'
				document.querySelector('.hidden').classList.remove('hidden')
			}
		})

	</script>
</body>
</html>