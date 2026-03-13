<?php
// 连接到数据库
include "header.php";

// 检查用户是否已登录

if (!isset($_SESSION['email'])) {
    // 未登录，重定向到登录页面
    header("Location: login.php");
    exit();
}

// 获取用户的 email
$user_email = $_SESSION['email'];

// 查询用户的 role 和 user_id
$sql = "SELECT user_id, role FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

// 检查查询结果
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id']; // 获取 user_id
    $user_role = $row['role']; // 获取 role
} else {
    echo "User not found.";
    exit();
}

// 根据用户角色进行判断
if ($user_role !== 'artist') {
    echo "Access denied."; // 非艺术家用户拒绝访问
    exit();
}

// 初始化变量
$name = $email = $slogan = null;
$artworks = []; // 用于存储所有艺术作品

// 查询用户详情
$sql = "SELECT name, email, slogan FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// 检查查询结果
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = htmlspecialchars($row['name'] ?? ''); // 使用 null 合并运算符提供默认值
    $email = htmlspecialchars($row['email'] ?? '');
    $slogan = htmlspecialchars($row['slogan'] ?? '');

    // 查询与 user_id 相关的所有 artwork
    $artworkSql = "SELECT artwork_id, cover, intro FROM artwork WHERE user_id = ?";
    $artworkStmt = $conn->prepare($artworkSql);
    $artworkStmt->bind_param("i", $user_id);
    $artworkStmt->execute();
    $artworkResult = $artworkStmt->get_result();

    // 存储所有艺术作品
    while ($artworkRow = $artworkResult->fetch_assoc()) {
        $artworks[] = [
            'artwork_id' => htmlspecialchars($artworkRow['artwork_id']),
            'cover' => htmlspecialchars($artworkRow['cover']),
            'intro' => htmlspecialchars($artworkRow['intro']),
        ];
    }
} else {
    // 如果未找到用户信息
    echo "User details not found.";
    exit();
}

// 处理文件上传
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['artworkFile']) && $_FILES['artworkFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['artworkFile']['tmp_name'];
        $fileName = $_FILES['artworkFile']['name'];
        $title = $_POST['title'];
        $type = $_POST['type']; // 获取选择的类型
        $content = $_POST['content']; // 对应数据库中的 intro

        // 设置文件上传路径
        $uploadFileDir = 'images/art_picture/'; // 确保这个文件夹存在
        $destPath = $uploadFileDir . $fileName;

        // 移动上传的文件到目标目录
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            // 检查艺术作品是否已存在
            $checkQuery = "SELECT COUNT(*) FROM artwork WHERE title = ? AND cover = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("ss", $title, $destPath);
            $checkStmt->execute();
            $checkStmt->bind_result($count);
            $checkStmt->fetch();
            $checkStmt->close();

            if ($count > 0) {
                echo "This artwork already exists. Please upload a different one.";
            } else {
                // 将文件路径和其他数据插入数据库
                $insertQuery = "INSERT INTO artwork (user_id, title, type, cover, intro) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("issss", $user_id, $title, $type, $destPath, $content);

                if ($insertStmt->execute()) {
                    // 上传成功后重定向到当前页面
                    header("Location: " . $_SERVER['PHP_SELF']); // 使用当前页面的 URL
                    exit(); // 确保脚本停止执行
                } else {
                    echo "Error: " . $insertStmt->error;
                }
            }
        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }
}




?>
<!DOCTYPE html>
<html>
<head>
<title>Artist-personal</title>
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
            <!-- 艺术家作品上传标题 -->
            <div class="contact-heading" style="text-align:left;margin-top:250px">
                <h2 class="wow fadeInDown animated" data-wow-delay=".5s">Upload Artwork</h2>
            </div>
            <!-- 上传表单 -->
            <div class="contact-form wow fadeInUp animated" data-wow-delay=".5s">
                <form method="POST" enctype="multipart/form-data">
                    <!-- 文件上传输入 -->
                    <input type="file" name="artworkFile" required="">
                    <br>
                    <!-- 名称输入 -->
                    <input type="text" name="title" placeholder="Title" required="">
                    <br>
                    <!-- 类型选择框 -->
                    <select name="type" required="">
                        <option value="" disabled selected>Select Type</option>
                        <option value="Traditional Painting">Traditional Painting</option>
                        <option value="Digital Design">Digital Design</option>
                        <option value="Sketch">Sketch</option>
                    </select>
                    <br>
                    <!-- 内容输入 -->
                    <textarea name="content" placeholder="Content" required=""></textarea>
                    <!-- 提交按钮 -->
                    <button type="submit" class="btn1 btn-1 btn-1b">Submit</button>
                </form>
            </div>
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
