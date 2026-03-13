<?php
require 'dbconn.php'; // 包含数据库连接

// 从请求中获取搜索关键字和类型
$search_keyword = $_GET['keyword'] ?? ''; // 如果没有提供搜索关键字，则设为空字符串
$type = $_GET['type'] ?? ''; // 如果没有提供类型，则设为空字符串

$search_keyword = $conn->real_escape_string(trim($search_keyword)); // 去除搜索关键字前后的空格并进行安全处理
$type = $conn->real_escape_string(trim($type)); // 去除类型前后的空格并进行安全处理

// 查询数据库
if ($type) {
    // 如果指定了类型，就只查找该类型的艺术品
    $sql = "SELECT * FROM artwork WHERE title LIKE '%$search_keyword%' AND type = '$type'";
} else {
    // 如果没有指定类型，查找所有类型的艺术品
    $sql = "SELECT * FROM artwork WHERE title LIKE '%$search_keyword%'";
}
$result = $conn->query($sql); // 执行查询
?>

<!DOCTYPE html>
<html>
<head>
    <title>Artworks</title>
    <!-- 设置视口以优化移动浏览 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 设置字符集为 UTF-8 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- 空的关键字元标签，根据实际情况填写 -->
    <meta name="keywords" content="" />
    <!-- 用于移动设备上隐藏地址栏 -->
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- 引入 Bootstrap 样式表 -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <!-- 引入主样式表 -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- 引入 Font Awesome 图标样式表 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- 引入 jQuery 库 -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- 引入 Bootstrap JavaScript 文件 -->
    <script src="js/bootstrap.js"></script>
    <!-- 页面平滑滚动效果 -->
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
    <!-- 再次引入 Font Awesome 图标样式表 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- 引入动画效果样式表 -->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <!-- 初始化 WOW.js 动画 -->
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</head>

<body>
    <!-- 头部整体容器 -->
    <div class="header">
        <!-- 顶部头部，可能用于展示logo或标语 -->
        <div class="top-header">
            <div class="container">
                <div class="top-header-info">
                    <!-- 顶部左侧区域，动画效果为从左侧淡入，延迟0.5秒 -->
                    <div class="top-header-left wow fadeInLeft animated" data-wow-delay=".5s">
                        <p>Desert Oasis</p> <!-- 可能是网站的名字或标语 -->
                    </div>
                    <!-- 顶部右侧区域，包含表单和社交图标 -->
                    <div class="top-header-right wow fadeInRight animated" data-wow-delay=".5s">
                        <div class="top-header-right-info">
                            <ul>
                                <form></form> <!-- 这里原始代码中的表单为空，可以用于搜索或其他功能 -->
                            </ul>
                        </div>
                        <div class="social-icons">
                            <ul></ul> <!-- 社交媒体图标列表，当前为空 -->
                        </div>
                        <div class="clearfix"></div> <!-- 清除浮动 -->
                    </div>
                    <div class="clearfix"></div> <!-- 清除浮动 -->
                </div>
            </div>
        </div>
        <!-- 底部头部，包括logo和主导航菜单 -->
        <div class="bottom-header">
            <div class="container">
                <!-- logo部分，动画效果为从下方淡入，延迟0.5秒 -->
                <div class="logo wow fadeInDown animated" data-wow-delay=".5s">
                    <h1><a href="index.html"><img src="images/home.svg" alt="" /></a></h1> <!-- logo图像链接到首页 -->
                </div>
                <!-- 顶部导航，动画效果为从右侧淡入，延迟0.5秒 -->
                <div class="top-nav wow fadeInRight animated" data-wow-delay=".5s">
                    <nav class="navbar navbar-default">
                        <div class="container">
                            <!-- 响应式导航栏切换按钮 -->
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">Menu</button>
                        </div>
                        <!-- 导航栏折叠部分 -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="index.html" class="active">Home</a></li>
                                <li><a href="">Artworks</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="artist-personal.html">Artist</a></li>
                                <li><a href="admin.html">Admin</a></li>
                                <li><a href="about.html">Our team</a></li>
                                <li><a href="" style="height:87px"><img src="images/header.jpg" width="32px" style="margin-top:-20px"><br>&nbsp;user</a></li> <!-- 用户图标和链接，设计略显复杂，包含图像和文字 -->
                            </ul>
                            <div class="clearfix"></div> <!-- 清除浮动 -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery">
    <!-- 导航条折叠部分，调整左边距为25%，用于对齐和视觉效果 -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-left:25%">
        <ul class="nav navbar-nav">
            <!-- 导航项：全部艺术品 -->
            <li><a href="all.php" class="active" style="color:black;font-size:25px;margin-left:15px">All</a></li>
            <!-- 导航项：传统绘画 -->
            <li><a href="artwork-Traditional-Painting.php?type=Traditional Painting" style="color:black;font-size:25px;margin-left:15px">Traditional Painting</a></li>
            <!-- 导航项：数字设计 -->
            <li><a href="artwork-Digital-Design.php?type=Digital Design" style="color:black;font-size:25px;margin-left:15px">Digital Design</a></li>
            <!-- 导航项：素描 -->
            <li><a href="artwork-Sketch.php?type=Sketch" style="color:black;font-size:25px;margin-left:15px">Sketch</a></li>
            <!-- 搜索框项 -->
            <li style="color:black;font-size:25px;margin-left:25px">
                <div class="input-group" style="margin-top:5px">
                    <!-- 搜索表单，提交到 search_results.php，使用GET方法发送关键字 -->
                    <form action="search_results.php" method="get">
                        <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                        <input type="text" class="form-control" name="keyword" placeholder="Search by keyword" style="width:70%">
                        <button class="btn btn-outline-primary" type="submit" style="margin-top:-6px">
                            <i class="fas fa-search"></i> <!-- 搜索图标 -->
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>

    <!-- 搜索结果展示区 -->
    <div class="container">
        <!-- PHP 条件语句，检查是否有搜索结果 -->
        <?php if ($result->num_rows > 0): ?>
            <!-- 画廊网格区域 -->
            <div class="gallery-grids">
                <!-- 循环遍历搜索结果，每个结果作为一个数组元素 -->
                <?php while($row = $result->fetch_assoc()): ?>
                        <!-- 使用自定义的 gallery-grid 样式 -->
                        <div class="gallery-grid effect-apollo">
                        <!-- 使用特定的CSS效果 -->
                        <figure class='effect-apollo'>
                            <!-- 链接到艺术品详细页面 -->
                            <a class='example-image-link' href='single.php?artwork_id=<?php echo $row['artwork_id']; ?>'>
                                <!-- 条件判断，检查是否有封面图片 -->
                                <?php if (isset($row['cover'])): ?>
                                    <img src='<?php echo $row['cover']; ?>' alt='<?php echo $row['title']; ?>' class='img-responsive'>
                                <?php else: ?>
                                    <img src='path/to/default/image' alt='Default Image' class='img-responsive'>
                                <?php endif; ?>
                                <!-- 图片下方显示艺术品的标题与类型 -->
                                <figcaption>
                                    <h3><?php echo $row['title']; ?></h3>
                                    <p class="type-info"><?php echo $row['type']; ?></p> <!-- 添加类以便于特殊样式的应用 -->
                                </figcaption>
                            </a>
                        </figure>
                    </div>
                <?php endwhile; ?>
                <div class="clearfix"></div>
            </div>
        <?php else: ?>
            <!-- 如果没有搜索结果，显示提示信息 -->
            <p>没有找到艺术品信息。</p>
        <?php endif; ?>
    </div>

    <!-- CSS样式 -->
    <style>
        /* 定义画廊网格容器的布局 */
        .gallery-grids {
            display: grid; /* 使用 CSS Grid 布局 */
            grid-template-columns: repeat(3, 1fr); /* 默认设置为三列布局，每列等宽 */
            gap: 10px; /* 设置网格间的间隙为 10px */
            width: 100%; /* 确保容器宽度为100%，适应父容器 */
            padding: 0; /* 可选：设置内边距为0，调整布局 */
            box-sizing: border-box; /* 确保内边距和边框不会影响总宽度 */
        }
        /* 屏幕宽度小于 1200px 时，布局变为两列 */
        @media (max-width: 1200px) {
            .gallery-grids {
                grid-template-columns: repeat(2, 1fr); /* 设置为两列布局 */
            }
        }
        /* 屏幕宽度小于 768px 时，布局变为一列 */
        @media (max-width: 768px) {
            .gallery-grids {
                grid-template-columns: 1fr; /* 设置为一列布局 */
            }
        }
        /* 单个网格项的样式，应用于每个展示单元 */
        .gallery-grid {
            position: relative; /* 设置相对定位，为内部定位提供参照 */
            overflow: hidden; /* 隐藏超出容器的内容 */
            transition: transform 0.3s ease; /* 动画：平滑变换效果 */
            margin: 0; /* 去掉每个网格项的外边距，以便更好地适应网格布局 */
            width: 100%; /* 确保子项宽度填满网格单元 */
            height: 100%; /* 确保子项高度填满网格单元 */
        }
        /* 鼠标悬停在网格项上时的放大效果 */
        .gallery-grid:hover {
            transform: scale(0.95); /* 放大到原始尺寸的95% */
        }
        /* 图像样式 */
        .effect-apollo img {
            transition: transform 0.5s ease;
            width: 100%; /* 确保图片宽度适应容器宽度 */
            height: 100%; /* 修改为 100%，确保图片高度适应容器 */
            object-fit: cover; /* 图片自适应填充且不变形 */
        }
        /* 鼠标悬停时图像透明度变化 */
        .gallery-grid:hover img {
            opacity: 0.6; /* 鼠标悬停时改变透明度 */
        }
        .effect-apollo img {
            transition: transform 0.5s ease;
            width: 100%; /* 确保图片宽度适应容器宽度 */
            height: auto; /* 高度自适应，保持图片比例 */
            object-fit: contain; /* 保持图片比例且不裁剪，适应网格单元 */
        }
        .effect-apollo:hover img {
            transform: scale(0.9); /* 控制放大比例 */
            transform-origin: center; /* 确保放大效果从中心收拢 */
        }
        figcaption {
            position: absolute; /* 绝对定位，使其相对于父元素的位置生效 */
            width: 100%; /* 宽度覆盖整个图片 */
            height: 100%; /* 高度覆盖整个图片 */
            left: 0; /* 左侧对齐到父元素的左边缘 */
            top: 0; /* 顶部对齐到父元素的顶边缘 */
            display: flex; /* 使用 flexbox 布局，以便更好地控制内部元素的排列方式 */
            flex-direction: column; /* 将内部元素按列排列（垂直方向） */
            justify-content: space-between; /* 确保标题在顶部，其他内容在底部，两者之间均匀分布 */
            padding: 10px; /* 添加内边距，使内容与边缘保持距离 */
            color: white; /* 设置文本颜色为白色 */
            background: none; /* 移除 figcaption 的背景色 */
            transition: opacity 0.3s ease-in-out; /* 设置透明度变化的过渡效果，持续时间为 0.3 秒 */
            opacity: 1; /* 初始状态下 figcaption 的透明度为 1，即完全不透明 */
        }
        figcaption h3 {
            text-align: center; /* 标题居中 */
            color: #FFFFFF; /* 字体颜色为白色 */
            font-family: "Francois One", sans-serif; /* 设置字体 */
            font-size: 30px; /* 字体大小 */
            margin: 0; /* 移除外边距 */
            width: 100%; /* 宽度占满 */
            word-spacing: -0.15em; /* 添加字间距 */
            font-weight: 300; /* 字重 */
        }        
        .type-info {
            position: absolute; /* 绝对定位 */
            bottom: 10px; /* 距离图片底部 10px */
            right: 10px; /* 距离图片右边 10px */
            font-family: 'Francois One', sans-serif; /* 设置字体 */
            font-size: 14px; /* 调整字体大小 */
            color: #FFFFFF; /* 设置字体颜色为白色 */
            text-transform: uppercase; /* 将文本转换为大写 */
            letter-spacing: 1px; /* 调整字母间距 */
            text-align: right; /* 文本右对齐 */
            opacity: 0; /* 默认不显示 */
            transition: opacity 0.3s ease-in-out; /* 平滑过渡效果 */
        }
        figure:hover .type-info {
            opacity: 1; /* 鼠标悬停时显示类型信息 */
        }
    </style>

    <style>
        .footer a {
            color: #353535;             /* 设置链接颜色为深灰色 */
            font-size: 1em;              /* 设置字体大小为1em */
            font-family: 'Francois One', sans-serif; /* 设置字体样式 */
        }
    </style>

    <!-- 底部容器，包含版权信息和链接 -->
    <div class="footer">
        <div class="container">
            <div class="copyright wow fadeInUp animated" data-wow-delay=".5s">
			<center>
				<p>© 2024. All Rights Reserved. </p></center>
            </div>
        </div>
    </div>

    <!-- 返回顶部按钮 -->
    <button id="back-to-top" class="btn btn-outline-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1.708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
        </svg>
    </button>
    </div>

    <!-- 引入 Bootstrap 的 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // 控制返回顶部按钮的显示和隐藏
        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById('back-to-top').style.display = 'block'; // 当页面向下滚动超过20px时显示按钮
            } else {
                document.getElementById('back-to-top').style.display = 'none'; // 否则不显示按钮
            }
        }

        // 点击返回顶部按钮时，平滑滚动到页面顶部
        document.getElementById('back-to-top').addEventListener('click', function () {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        });

        // 页面加载时执行
        window.addEventListener('DOMContentLoaded', (event) => {
            // 登录逻辑处理，检查本地存储的登录状态
            var loginLink = document.getElementById('loginLink');

            if (localStorage.getItem('isLoggedIn') === 'yes') {
                // 如果已经登录，更改链接文本为 "Logout"
                loginLink.innerHTML = '<a href="#" id="logoutLink">Logout</a>';

                // 添加注销功能
                document.getElementById('logoutLink').addEventListener('click', function(event) {
                    event.preventDefault();
                    localStorage.setItem('isLoggedIn', 'no');
                    loginLink.innerHTML = '<a href="login.html">Login</a>';
                    window.location.href = 'login.html'; // 重定向到登录页面
                });
            }
        });
    </script>
</body>
</html>