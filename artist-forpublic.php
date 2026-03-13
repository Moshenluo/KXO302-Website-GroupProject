<?php
// 连接到数据库
include "header.php";

// 获取当前页面的 user_id
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;

// 初始化变量
$name = $email = $slogan = null;
$artworks = []; // 用于存储所有艺术作品

if ($user_id !== null) {
    // 查询数据库，获取指定 user_id 的用户详情
    $sql = "SELECT name, email, slogan FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // 检查查询结果
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $slogan = $row['slogan'];

        // 查询与 user_id 相关的所有 artwork，包括 intro
        $artworkSql = "SELECT artwork_id, cover, intro FROM artwork WHERE user_id = ?"; // 获取艺术作品
        $artworkStmt = $conn->prepare($artworkSql);
        $artworkStmt->bind_param("i", $user_id);
        $artworkStmt->execute();
        $artworkResult = $artworkStmt->get_result();

        // 检查 artwork 查询结果并存储所有作品
        while ($artworkRow = $artworkResult->fetch_assoc()) {
            $artworks[] = [
                'artwork_id' => htmlspecialchars($artworkRow['artwork_id']),
                'cover' => htmlspecialchars($artworkRow['cover']),
                'intro' => htmlspecialchars($artworkRow['intro']), // 获取 intro
            ];
        }
    } else {
        // 如果未找到用户信息
        $name = $email = $slogan = null; 
    }
} else {
    // 处理未提供 user_id 的情况
    $name = $email = $slogan = null;
}
// 输出结果
//echo "Name: " . $name . "<br>";
//echo "Email: " . $email . "<br>";
//echo "Slogan: " . $slogan . "<br>";
//echo "Cover: " . $cover;




?>
<!DOCTYPE html>
<html>
<head>
<title>Artist-forpublic</title>
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
        <!-- 顶部网格区域 -->
        <div class="blog-top-grids">
            <!-- 左侧网格 -->
            <div class="col-md-6 blog-top-left-grid">
                <div class="left-blog">
                    <div class="blog-left">
                        <!-- 左侧图片部分 -->
                        <div class="blog-left-left wow fadeInUp animated" data-wow-delay=".5s">
                        <?php if (!empty($artworks)): ?>
                            <?php 
                                $firstArtwork = $artworks[0]; // 获取第一张艺术作品
                                $artwork_id = htmlspecialchars($firstArtwork['artwork_id']);
                                $cover = htmlspecialchars($firstArtwork['cover']);
                            ?>
                            <a href="single.php?artwork_id=<?php echo $artwork_id; ?>">
                                <img src="<?php echo $cover; ?>" alt="Artwork" />
                            </a>
                        <?php else: ?>
                            <p>No artwork available.</p>
                        <?php endif; ?>
                        </div>

                        <!-- 右侧文字部分 -->
                        <div class="blog-left-right wow fadeInUp animated" data-wow-delay=".5s">
                        <?php if ($name !== null): ?>
                        <p>Name: <?php echo $name; ?></p>
                        <p>E-mail: <?php echo $email; ?></p>
                        <p>Slogan: <?php echo $slogan; ?></p>
                    <?php else: ?>
                        <p>未找到用户信息。</p>
                    <?php endif; ?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <!-- 右侧网格 -->
            <div class="col-md-6 blog-top-right-grid">
            <div class="Categories wow fadeInUp animated" data-wow-delay=".5s">
                <h3>Introduction</h3>
                <p>
                    <?php 
                    if (isset($artworks) && !empty($artworks)): 
                        $firstArtwork = $artworks[0]; // 获取第一张艺术作品
                        $intro = htmlspecialchars($firstArtwork['intro']); // 获取介绍
                        echo $intro; // 输出介绍
                    else: 
                    ?>
                        这里是没有介绍的默认文本。
                    <?php endif; ?>
                </p>
            </div>
        </div>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<div class="contact">
    <div class="container">
        <hr>
        <!-- 联系部分标题 -->
        <div class="contact-heading" style="text-align:left">
            <h2 class="wow fadeInDown animated" data-wow-delay=".5s">Display All Artworks</h2>
        </div>
        <!-- 画廊网格区域 -->
        <div class="gallery">
        <h2>Artworks</h2>
        <div class="gallery-grids">
            <?php if (!empty($artworks)): ?>
                <?php foreach ($artworks as $index => $artwork): ?>
                    <div class="col-md-3 gallery-grid wow fadeInUp animated" data-wow-delay=".5s">
                        <div class="grid">
                            <figure class="effect-apollo">
                                <a class="example-image-link" href="single.php?artwork_id=<?php echo $artwork['artwork_id']; ?>">
                                    <img src="<?php echo $artwork['cover']; ?>" alt="Artwork" />
                                    <figcaption>
                                        <h3>Artwork</h3>
                                        <p><?php echo $artwork['intro']; ?></p>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No artworks available for this artist.</p>
            <?php endif; ?>
        </div>
    </div>
            <hr style="">
            <!-- 交流部分标题 -->
			<style>
			#myLink {  
    text-decoration: none; /* 去除下划线 */  
    color: initial; /* 初始颜色，可以根据需要设置 */  
    transition: color 0.3s ease; /* 添加颜色变化的过渡效果 */  
}  
  
#myLink:active {  
    color: red; /* 点击时的颜色 */  
}

#myLink.clicked {  
    color: red; /* 点击后保持的颜色 */  
}
</style>
<script>
document.getElementById('myLink').addEventListener('click', function(event) {  
    event.preventDefault(); // 阻止链接的默认行为  
    this.classList.toggle('clicked'); // 切换类来标记链接状态  
});
</script>
            <div class="contact-heading" style="text-align:left;margin-top:100px;float:left;width:100%">
                <h2 class="wow fadeInDown animated" data-wow-delay=".5s">Artist-user Exchange   <a href="1.php?forum_id=<?php echo $user_id; ?>" style="margin-left:30%;font-size:20px" id="myLink">Get More</a></h2>
			
            </div>
			<div style="float:left;width:20%"></div>
            <!-- 交流表单区域 -->
           
    </div>
</div>
<div style="height:100px"></div>
<style>
		.footer a
		{
		color: #353535;
    font-size: 1em;
    font-family: 'Francois One', sans-serif;
		}
		</style>
		</div>
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
