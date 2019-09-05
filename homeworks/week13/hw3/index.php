<!DOCTYPE HTML>
<html>
<head>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <META HTTP-EQUIV="REFRESH" CONTENT="600;URL=./handle/logout.php"> <!--一小時自動登出-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel='stylesheet' href='style.css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
  require_once 'conn.php'; 
  require_once 'utils.php';
  require_once 'check_login.php'; 
//版面
  require_once './navbar.php';
  require './pagination.php'; 
  require_once './board.php';
  require './pagination.php'; 
?>

<script>
//判斷登入顯現不同navbar選單
  const user = <?php echo json_encode($user);?>;
  if(user) { 
    $('.btn-login, .btn-register').remove();
    $('.nav-profile, .nav-other').addClass('disabled');//功能未完成
  } else {
    $('.btn-logout, .btn-comment').remove();
    $('.nav-profile, .nav-other').addClass('disabled');
  }

//登入功能
  $(document).ready(function() {
    $("#submit-login").on('click', function() {
        $("#login-form").submit();
    });
  });

//登出功能
  function userLogout() { 
    const logout = confirm('確定要登出嗎？');
    if(logout == true) {
      location = './handle/logout.php';
    };
  };

//註冊功能
  $(document).ready(function() {
    $("#submit-register").on('click', function() {
        $("#register-form").submit();
    });
  });

//新增留言
  $(document).ready(function() {
    $(".submit-comment").click(function(e) {
      const comment = $("#comment-form").val();
      $.ajax({
        url: 'handle/add_comment.php',
        method: 'POST', 
        data: {
          comment
        },
      }).done(function(response) {
        const msg = JSON.parse(response);
        const time = msg.time;
        const id = msg.id;
        const nickname = msg.nickname;
        $(".board-container").prepend(addComment(id, nickname, comment, time));
        $("#inputComment").modal('hide');
        $("#comment-form").val("");
        alert('留言成功！');
      }).fail(function() {
        alert('留言失敗！');
      });
    });
  });

  function addComment(id, nickname, comment, time) {
    const newPost = `
      <div class="card my-3 origin">
        <h5 class="card-header py-2">
          <div class="author">${nickname}</div>
          <div class="time-stamp">${time}</div>
          <button class="btn btn-outline-success btn-edit btn-sm mr-2 float-right">編輯</button>
          <button class="btn btn-outline-success btn-delete btn-sm mr-2 float-right" data-comment-id="${id}">刪除</button>
        </h5>
        <div class="card-body">
          <div class="card-text comment-text">${comment}</div>           
          <form name="edit-comment-form" class="edit-comment-form" style="display:none;">
            <textarea class="form-control edit-comment" name="edit-comment" rows="3">${comment}</textarea>
            <button type="button" class="btn btn-secondary btn-sm my-2 cancel-edit-comment">捨棄</button>
            <button type="button" class="btn btn-primary btn-sm my-2 submit-edit-comment" data-comment-id="${id}">送出</button>
          </form>
          <button class="btn btn-outline-success btn-reply btn-sm float-right">回覆</button>
          <div class="comment-info float-right" data-replies="0">回覆 0</div>
          <div class="input-group" style="display:none;">
            <input type="text" class="form-control new-reply" placeholder="回覆留言">
            <div class="input-group-append">
              <button class="btn btn-outline-success btn-sm submit-reply" data-comment-id="${id}">送出</button>
            </div>
          </div>
        </div>
      </div>`
    return newPost
  };

//展開reply 
$(document).ready(function(){
  $(".board-container").on("click", ".card", function(e){ 
    if($(e.target).filter("button, textarea, input").length==0) {
      $(this).find('.reply').slideToggle("slow");
    }       
  }); 
});

//展開reply輸入區
  $(document).ready(function() {
    $(".board-container").on("click", ".btn-reply", function() { 
      $(this).siblings(".input-group").slideToggle("slow");
    });
  }); 

//送出子留言
  $(document).ready(function() {
    $(".board-container").on("click", ".submit-reply", function(e) { 
      const reply = $(this).parent().siblings(".new-reply").val();
      const comment_id = $(this).attr("data-comment-id");
      const author = $(this).parents(".origin").find(".author").text();
      const replies = $(this).parents(".origin").find(".comment-info").attr("data-replies");
      const newReplies = Number(replies)+1;
      $.ajax({
        url: 'handle/reply.php',
        method: 'POST', 
        data: {
          comment_id,
          reply
        },
      }).done(function(response){
        const msg = JSON.parse(response);
        const nickname = msg.nickname;
        const replyText = msg.reply;
        if(replies==0) {
          $(e.target).parents(".origin").append('<div class="card card-body border-right-0 border-bottom-0 border-left-0 reply" style="display:none;"><div>');
        }
        $(e.target).parents(".origin").find(".reply").append(addReply(nickname, replyText, author));
        $(e.target).parents(".origin").find(".reply").slideDown();
        $(e.target).parents(".origin").find(".comment-info").text("回覆 "+ newReplies);
        $(e.target).parents(".origin").find(".comment-info").attr("data-replies", newReplies);
        $(e.target).parents(".origin").find(".input-group").hide();
        $(e.target).parents(".origin").find(".new-reply").val("");
        alert('送出回覆！');
      }).fail(function() {
        alert('無法回覆！');
      });
    });
  });

  function addReply(nickname, replyText, author) {
    if(author == nickname) { //原po暱稱加粗
      const reply = `
      <div class="card-text d-flex mb-3">
        <div class="reply-user mr-2  font-weight-bold">${nickname}</div> 
        <div class="reply-text border-left flex-fill">${replyText}</div>    
      </div>`
      return reply
    } else {
      const reply = `
      <div class="card-text d-flex mb-3">
        <div class="reply-user mr-2">${nickname}</div> 
        <div class="reply-text border-left flex-fill">${replyText}</div>    
      </div>`
      return reply
    }   
  }

//展開編輯框
  $(document).ready(function() {
    $(".board-container").on("click", ".btn-edit", function(){ 
      $(this).parent().parent().find(".edit-comment-form").slideToggle("slow");
    });
  });

//捨棄編輯留言
  $(document).ready(function() {
    $(".board-container").on("click", ".cancel-edit-comment", function() { 
      $(this).siblings(".edit-comment").empty();
      $(this).parent().slideUp("slow");
    });
  });

//送出編輯過留言
  $(document).ready(function() {
    $(".board-container").on("click", ".submit-edit-comment", function(e) { 
      const edit_comment = $(this).parents(".origin").find(".edit-comment").val();
      const comment_id = $(this).attr("data-comment-id");
      $.ajax({
        url: './handle/edit_comment.php',
        method: 'POST', 
        data: {
          comment_id,
          edit_comment
        },
      }).done(function(response){
        const msg = JSON.parse(response);
        $(e.target).parent().parent().find(".comment-text").text(msg.edited_comment);
        $(e.target).parent().parent().find(".edit-comment-form").hide();
        alert('編輯成功！');
      }).fail(function() {
        alert('編輯失敗！');
      });   
    });
  });

//刪除留言
  $(document).ready(function() {
    $(".board-container").on("click", ".btn-delete", function(e) { 
      const delComment = $(this).parent().parent().find('.comment-text').text();
      const id = $(this).attr("data-comment-id");
      const delPost = confirm('確定要刪除此留言嗎？\n留言內容：\n' + delComment);
      if(delPost == true) {     
        $.ajax({
            url: './handle/delete_comment.php',
            method: 'POST', 
            data: {
              comment_id: id
            },
        }).done(function() {
          alert('刪除成功！');
          $(e.target).parent().parent().hide(200);
        }).fail(function() {
          alert('刪除失敗！');
        });
      };    
    });
  }); 

</script>
</body>
</html>