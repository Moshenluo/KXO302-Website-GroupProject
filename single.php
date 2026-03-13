
<?php
// 连接到数据库
include "header.php";

// 执行查询
$artwork_id = $_GET['artwork_id'];
echo "<script>console.log('The value of artwork_id is: " . $artwork_id . "');</script>";

//评论功能
if (isset($_POST["commentInput"])){
    $email = $_SESSION['email'];
    //检查登录状态
    if (empty($email)) {
        echo '<script>alert("You need to log in before making a comment!"); window.location = "login.php";</script>';
    } else {
        //上传评论
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['user_id'];}
        $comment_Send = mysqli_real_escape_string($conn ,trim($_POST["commentInput"]));
        $insert_query = "INSERT INTO `artwork_comment` (`user_id`, `artwork_id`, `content`) VALUES ('$userID', '$artwork_id', '$comment_Send')";
        $conn->query($insert_query);
        echo '<script>//alert("Thanks for your heartfelt comment!"); </script>';
        header("Location: single.php?artwork_id=" . $artwork_id);
        exit;
    }
}


// 查询数据库，获取指定 artwork_id 的艺术品详情
$sql = "SELECT title, cover, intro, post_time FROM artwork WHERE artwork_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $artwork_id);
$stmt->execute();
$result = $stmt->get_result();
//评论区数据库
$sql_comments = "SELECT ac.content, u.name FROM artwork_comment ac
                 JOIN user u ON ac.user_id = u.user_id
                 WHERE ac.artwork_id = ?";
$stmt_comments = $conn->prepare($sql_comments);
$stmt_comments->bind_param("i", $artwork_id);
$stmt_comments->execute();
$result_comments = $stmt_comments->get_result();
//like数据库
$sql_likes = "SELECT likes_count FROM artwork WHERE artwork_id = ?";
$stmt_likes = $conn->prepare($sql_likes);
$stmt_likes->bind_param("i", $artwork_id);
$stmt_likes->execute();
$result_likes = $stmt_likes->get_result();
//z
$sql_user = "SELECT user_id FROM artwork WHERE artwork_id = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $artwork_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
//获取user_id 动态跳转作者公开页
if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
    $user_id = $row_user['user_id']; // 获取 user_id
} else {
    $user_id = null; // 如果未找到对应的 user_id
}
echo "<script>console.log('The value of artwork_id is: " . $artwork_id . "');</script>";
?>
<!DOCTYPE html>
<html>
<head>
<title>Artwork</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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

</head>
</head>
<body>

	<div class="blog">
    <div class="container">
        <!-- 左侧主要内容区域 -->
         <?php
            //详情内容动态生成
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $title = htmlspecialchars($row['title']);
                $cover = htmlspecialchars($row['cover']);
                $intro = htmlspecialchars($row['intro']);
                $created_at = htmlspecialchars($row['post_time']);
                echo '
                <div class="col-md-8 blog-top-left-grid">
                    <div class="left-blog left-single">
                        <div class="blog-left">
                            <!-- 标题及作者信息和发布时间 -->
                            <div class="single-left-left wow fadeInUp animated" data-wow-delay=".5s">
                                <h2>' . $title . '</h2>
                                <p>Publish Time: ' . $created_at . '&nbsp;&nbsp;</p>
                                <img src="' . $cover . '" alt="' . $title . '" />
                            </div>
                            <!-- 第一段详细内容 -->
                            <div class="blog-left-bottom wow fadeInUp animated" data-wow-delay=".5s">
                                <p>' . $intro . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
            } else {
                echo "<p>未找到艺术品信息</p>";
            }
            ?>
        <!-- 右侧辅助内容区域 -->
        <div class="col-md-4 blog-top-right-grid">
            <div class="Categories wow fadeInUp animated" data-wow-delay=".5s">
                <!-- 用户操作按钮区域 -->
                <?php
                echo '<div class="action-buttons">
                    <button class="btn btn-outline-primary">
                    <a href="artist-forpublic.php?user_id=' . htmlspecialchars($user_id) . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        Profile</a>
                    </button>
                </div>';
                ?>
                    <br>
                    
                    <?php
                    //点赞数动态生成
                    if ($result_likes->num_rows > 0) {
                        $row = $result_likes->fetch_assoc();
                        $likes_count = htmlspecialchars($row['likes_count']);
                    } else {
                        $likes_count = 0; 
                    }

                    ?>
                    <button class="btn btn-outline-primary" id="likeButton" data-artwork-id="<?php echo $artwork_id; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1.176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>
                        Like    <span id="likesCount"><?php echo $likes_count; ?></span>
                    </button>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <style>
                            /* 点赞效果 */
                            .likeButtonRed {background-color: red;color: white;}
                            .likeButtonRed:hover {background-color: red;color: white; border: white; }
                            .likeButtonRed:focus {background-color: red;color: white; border: white;  outline: none;}
                        </style>

                    <script>
                        $(document).ready(function(){
                            var likeStatus = 'unliked';
                            $("#likeButton").click(function(){
                                var artwork_id = $(this).data("artwork-id");
                                console.log(artwork_id);
                                
                                // 传入数据
                                $.ajax({
                                    url: 'likes.php',
                                    type: 'POST',
                                    data: {
                                        artwork_id: artwork_id,
                                        likeStatus: likeStatus
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            $('#likesCount').text(response.likes_count);  // 更新点赞数
                                            if (response.likeStatus == 'liked') {
                                                $('#likeButton').addClass('likeButtonRed');  // 点赞时触发效果
                                                likeStatus = 'liked'; 
                                            } else {
                                                $('#likeButton').removeClass('likeButtonRed');
                                                likeStatus = 'unliked'; 
                                            }
                                        } else {alert(response.message);}
                                    },
                                    error: function() {alert("There was an error processing your request.");}
                                });
                            });
                        });
                    </script>

                </div>
                <!-- 评论区域 -->
                <?php
                // 连接到数据库
                // 评论部分的 HTML
                echo '<div class="comment-section">';
                echo '<h2 class="wow fadeInUp animated" data-wow-delay=".5s" style="font-size: 22px;">Comments</h2>';
                // 评论区动态生成
                if ($result_comments->num_rows > 0) {
                    while ($row = $result_comments->fetch_assoc()) {
                        $comment_user = htmlspecialchars($row['name']);
                        $comment_content = htmlspecialchars($row['content']);
                        echo '
                        <div class="comment">
                            <div class="comment-user-info">
                                <span class="comment-user" style="color:#e9881c">' . $comment_user . ':</span>
                            </div>
                            <p class="comment-text" style="font-size: 12px; font-family: 黑体">' . $comment_content . '</p>
                        </div>';
                    }
                } else {
                    echo "<p>No comments.</p>";
                }

                echo '</div>'; // 关闭 comment-section
                ?>
                        
                <!-- 发表评论表单区域 -->
                <div class="opinion">
                    <h2 class="wow fadeInUp animated" data-wow-delay=".5s" style="font-size: 22px;">Engage in communicate</h2>
                    <form method="POST" action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?artwork_id=' . urlencode($artwork_id); ?>"" id = "commentForm">
                        <textarea class="wow fadeInLeft animated" data-wow-delay=".5s" placeholder="Messages" required="" name = "commentInput"></textarea>
                        <input class="wow fadeInRight animated" data-wow-delay=".5s" type="submit" value="Send">
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

						</div>

					</div>
					<div class="clearfix"> </div>
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
			<center>
				<p>© 2024. All Rights Reserved. </p></center>
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
    // 页面加载时执行的代码
    window.addEventListener('DOMContentLoaded', (event) => {
        // 获取登录链接元素
        var loginLink = document.getElementById('loginLink');

        // 检查用户是否已经登录
        if (localStorage.getItem('isLoggedIn') === 'yes') {
            // 如果已经登录，更改链接文本为 "Logout"
            loginLink.innerHTML = '<a href="#" id="logoutLink">Logout</a>';

            // 为注销链接添加点击事件
            document.getElementById('logoutLink').addEventListener('click', function(event) {
                event.preventDefault();
                localStorage.setItem('isLoggedIn', 'no');
                loginLink.innerHTML = '<a href="login.html">Login</a>';
                window.location.href = 'login.html';
            });
        }
    });
  </script>
</body>
</html>
