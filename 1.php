<?php
// 连接到数据库
include "header.php";

// 获取当前页面的 user_id
$forum_id = isset($_GET['forum_id']) ? $_GET['forum_id'] : null;
echo "<script>console.log('The value of forum_id is: " . $forum_id . "');</script>"; 
?>

<!DOCTYPE html>
<html>
<head>
<title>Forum</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

<link href="css/font-awesome.css" rel="stylesheet"> 

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>	

<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>


</style>  


            <!-- 广告栏 --> 
        

            <style>
                 .ad-banner {
                    text-align: center;
                    margin-bottom: 20px;
                    overflow: hidden; /* 隐藏超出部分 */
                    white-space: nowrap; /* 使内容不换行 */
                    position: relative; /* 设定相对定位 */
                    height: 90px; /* 设置固定高度以便于展示 */
                    background-color: #a8d8d8; /* 设置背景颜色，可以使用 rgba 或其他颜色值 */
                }

                .ad-images {
                        display: inline-block; /* 使图片水平排列 */
                        white-space: nowrap; /* 保持内容不换行 */
                        animation: scroll 10s linear infinite; /* 动画效果 */
                    }

                .ad-images img {
                        max-width: 120px; /* 设置为合适的宽度 */
                        height: 90px; /* 固定高度 */
                        display: inline-block; /* 保持图片水平排列 */
                    }
                    .ad-images img {
                        max-width: 1500px; /* 每张图片的最大宽度 */
                        height: 90px; /* 固定高度 */
                        display: inline-block; /* 保持图片水平排列 */
                    }

                

                @keyframes scroll {
                    0% {
                        transform: translateX(100%); /* 从右侧开始 */
                    }
                    100% {
                        transform: translateX(-100%); /* 滚动到左侧 */
                    }
                }
            </style>

            </div > 
            
            <div class="forum-container">  
                <div class="class-2"> <!-- 为div指定class属性为"class-2" -->    
                      
                    <div class="forum-header"> <!-- 新增一个容器来包裹标题和欢迎框 -->  
                        <h2 class="forum-title">Forum</h2   >  
                        <div class="welcome-box">  
                            <img src="user.jpg" alt="Welcome Image" class="welcome-image"> <!-- 替换为你的图片路径 -->  
                            <p class="welcome-text">欢迎你</p>  
                        </div>  
                    </div>  
                      
                    <div class="input-group">  
                        <input type="text" id="userInput" class="form-control" placeholder="输入你的消息..." />  
                        <button id="postButton" data-forum_id="<?php echo $forum_id ;?>" class="post-button">Post</button>  
                    </div>  
                    <div class="discussion-area" id="discussionArea">  
                        <!-- 讨论内容将在此处显示 -->  
                    </div>  
                </div>  
            </div>
        </div>
        <br>

            <style>

                /* 新增的CSS样式 */  
.comment-box {  
    margin-bottom: 10px; /* 可选：为评论框之间添加一些垂直间距 */  
    padding: 10px; /* 可选：为评论内容添加内边距 */  
    border-radius: 4px; /* 可选：为评论框添加圆角 */  
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* 添加阴影效果 */  
    background-color: #fff; /* 可选：设置背景颜色 */  
}
                /* 在现有CSS的末尾添加以下样式 */  
.delete-button {  
    padding: 5px 10px;  
    background-color: #dc3545; /* 红色背景表示删除 */  
    color: white;  
    border: none;  
    border-radius: 4px;  
    cursor: pointer;  
    transition: background-color 0.3s;  
    margin-left: 10px; /* 与消息文本保持一些距离 */  
}  
  
.delete-button:hover {  
    background-color: #c82333; /* 悬停时颜色加深 */  
}
              /* 新增的CSS样式 */  
.forum-header {  
    display: flex;  
    justify-content: space-between;  
    align-items: center;  
    margin-bottom: 20px; /* 给输入框留出一些空间 */  
}  
  
.welcome-box {  
    display: flex;  
    flex-direction: column;  
    align-items: center;  
    margin-left: 20px; /* 与论坛标题保持一些距离 */  
}  
  
.welcome-image {  
    width: 50px; /* 根据需要调整图片大小 */  
    height: 50px; /* 根据需要调整图片大小 */  
    border-radius: 50%; /* 如果想要圆形图片 */  
}  
  
.welcome-text {  
    margin-top: 5px; /* 图片下方的文字间距 */  
    font-size: 0.9em; /* 根据需要调整文字大小 */  
    color: #333; /* 根据需要调整文字颜色 */  
}
              
              .forum-container {
                background-image: url('R.jpg'); /* 替换为你的图片路径 */
                background-size: cover; /* 背景图像覆盖整个容器 */
                background-position: center; /* 居中显示背景图像 */
                background-repeat: no-repeat; /* 不重复背景图像 */
                width: 100%; /* 让容器宽度为100% */
                padding: 0px 0; /* 添加上下内边距 */
            }


                .class-2 {
                    background: linear-gradient(135deg, #f4f7f9, #e1e5e8); /* 渐变背景 */
                    color: rgb(0, 0, 0);
                    padding: 20px;
                    min-height: 250px; 
                    border-radius: 8px;
                    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
                    margin: 10px auto; /* 上下边距保持，左右自动 */
                    width: 80%; /* 设置宽度为80% */
                    max-width: 800px; /* 最大宽度为600px */
                    
                }
                .forum-title {
                    text-align: center;
                    font-size: 2em;
                    margin-bottom: 20px;
                    color: #333;
                }
                .input-group {
                    display: flex;
                    margin-bottom: 20px;
                }
                .form-control {
                    flex: 1;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    margin-right: 10px;
                    transition: border-color 0.3s;
                }
                .form-control:focus {
                    border-color: #007bff;
                    outline: none;
                }
                .post-button {
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                .post-button:hover {
                    background-color: #0056b3;
                }
                .discussion-area {
                    max-height: 300px;
                    overflow-y: auto;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    padding: 10px;
                    background-color: white;
                    margin-top: 10px;
                }
                .discussion-area div {
                    padding: 8px;
                    border-bottom: 1px solid #eee;
                }
                .discussion-area div:last-child {
                    border-bottom: none;
                }
                .message {
                    margin-bottom: 10px;
                    font-size: 0.9em;
                }
                .timestamp {
                    font-size: 0.8em;
                    color: #888;
                }

                 
                
            </style>
        
            <script>
                document.getElementById('postButton').addEventListener('click', function() {  
    
   
    if (input.value.trim()) {  
        const newMessage = document.createElement('div');  
        // 为新生成的评论框添加 .comment-box 类  
        newMessage.className = 'comment-box';  
  
        const messageDiv = document.createElement('div');  
        const messageText = document.createElement('div');  
        const timestampDiv = document.createElement('div');  
        const deleteButton = document.createElement('button');  
        const timestamp = new Date().toLocaleString();  
  
        // 设置消息文本和时间戳（与之前相同）  
        messageText.textContent = input.value.trim();  
        messageText.className = 'message';  
        timestampDiv.textContent = timestamp;  
        timestampDiv.className = 'timestamp';  
  
        
  
        // 构建消息结构并添加到讨论区（与之前相同）  
        messageDiv.appendChild(messageText);  
        messageDiv.appendChild(timestampDiv);  
        newMessage.appendChild(messageDiv);  
        newMessage.appendChild(deleteButton);  
        discussionArea.appendChild(newMessage);  
        input.value = '';  
        discussionArea.scrollTop = discussionArea.scrollHeight; // 滚动到底部  
    } else {  
        alert("请输入您的消息。");  
    }  
});
            </script>
        

                <style>  
                    /* 在<style>标签内定义CSS样式 */  
                    .class-2 {  
                        background-color: #f4f7f9;   
                        color: rgb(0,0,0); /* 可选：将文本颜色设置为白色 */  
                        padding: 10px; /* 可选：为div添加内边距 */  

                    }  
                </style> 

            </div>	
            
		</div>
        
	</div>
	

	<style>
		.footer a
		{
		color: #353535;
    font-size: 1em;
    font-family: 'Francois One', sans-serif;
		}

        
		</style>
	<div class="footer">
		<div class="container">
			
			<div class="copyright wow fadeInUp animated" data-wow-delay=".5s">
			<center><a href="">Contact us </a>|<a href="">Bug report </a>|<a href="">Address </a>
				<p>© 2024  . All Rights Reserved . </p></center>
			</div>
		</div>
	</div>
	<button id="back-to-top" class="btn btn-outline-primary">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1.708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
      </svg>
    </button>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.onscroll = function () {
      scrollFunction();
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById('back-to-top').style.display = 'block';
      } else {
        document.getElementById('back-to-top').style.display = 'none';
      }
    }

    document.getElementById('back-to-top').addEventListener('click', function () {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    });

    
    $(document).ready(function() {
        $('#postButton').click(function() {
            console.log('click successfully');
            var comment = $('#userInput').val();
            var forum_id = $(this).data("forum_id");
            console.log(comment);
            console.log(forum_id);
            if (!comment || !forum_id) {
             alert("Comment or Forum ID is missing");
             return;
         }
            $.ajax({
                url: 'post_comment.php',
                type: 'POST',
                data: { comment: comment, 
                    forum_id: forum_id
                },
                success: function(response) {
                    // 处理服务器返回结果，比如显示成功提示或错误信息
                    // 重新加载评论列表
                    loadComments();
                },
                
            });
        });

        // 加载评论列表
        function loadComments() {
    var forum_id = $('#postButton').data('forum_id'); // 获取 forum_id
    $.ajax({
        url: 'get_comments.php',
        type: 'GET',
        data: { forum_id: forum_id }, // 添加 forum_id 参数
        success: function(response) {
            $('#discussionArea').html(response);
        }
    });
}

        // 初次加载评论
        loadComments();
    });


    
  </script>


</style>  
</body>	
</html>