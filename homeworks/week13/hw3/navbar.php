
<h4 class="text-center">你好，本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼！！！</h4>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <span class="navbar-brand mb-0 h1">Yayin</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">留言板<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link nav-profile" href="./profile.php">個人頁面</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle nav-other" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          其他 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item nav-simple active" href="#">簡單版面</a>
          <a class="dropdown-item nav-complete" href="#">完整版面</a>
          <a class="dropdown-item nav-hint" href="#">使用提示</a>
        </div>
      </li>
    </ul>
  	<button class="btn btn-outline-success btn-login mr-2" data-toggle="modal" data-target="#userLogin" type="submit" id='1'>登入</button>
  	<button class="btn btn-outline-success btn-register mr-2" data-toggle="modal" data-target="#userRegister" type="submit" >註冊</button>
    <button class="btn btn-outline-success btn-logout mr-2" onclick="userLogout()">登出</button>
    <button class="btn btn-outline-success btn-comment mr-2" data-toggle="modal" data-target="#inputComment" type="submit">新增留言</button>
  </div>
</nav>
<?php
if($nickname) {
    echo '<h5 class="text-center" style="background:pink;position:sticky;top:56px;z-index:5">Hello, '.$nickname.'</h5>';
  }; 
?>

<!--新增留言modal-->
<div class="modal fade" id="inputComment" tabindex="-1" role="dialog" aria-labelledby="inputComment" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">新增留言</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="comment-form" action="./handle/add_comment.php" method="post">
        <div class="modal-body">
          <textarea class="form-control" name="comment" id="comment-form" rows="6"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary submit-comment">送出</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!--登入modal-->
<div class="modal fade" id="userLogin" tabindex="-1" role="dialog" aria-labelledby="userLogin" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">登入帳號</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="login-form"  name="login" method="POST" action="./handle/login.php">
        <div class="modal-body">
          <div>帳號: <input class="input" type="text" name="username" /></div>
  		    <div>密碼: <input type="password" name="password" /></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id='submit-login'>登入</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!--註冊modal-->
<div class="modal fade" id="userRegister" tabindex="-1" role="dialog" aria-labelledby="userRegister" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">註冊帳號</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="register-form" name="register" method="POST" action="./handle/register.php">
        <div class="modal-body">
      		<div>設定帳號: <input type="text" name="username" /><span class="description">英數，勿使用真實的帳號</span></div>
      		<div>設定密碼: <input type="password" name="password1" /><span class="description">英數，勿使用真實的密碼</span></div>
      		<div>確認密碼: <input type="password" name="password2" /><span class="description">英數，勿使用真實的密碼</span></div>
      		<div>設定暱稱: <input type="text" name="nickname" /><span class="description">非必填，英數中文皆可</span></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
          <button type="button" class="btn btn-primary" id='submit-register'>註冊</button>
        </div>
      </form>
    </div>
  </div>
</div>
