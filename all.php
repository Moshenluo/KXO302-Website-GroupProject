<?php
// 包含头部文件
include "header.php";

// 初始化 $type，避免未定义变量错误
$type = '';

// 执行查询
$sql = "SELECT * FROM artwork";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Artworks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/font-awesome.css" rel="stylesheet">

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

</head>

<body>
    <div class="gallery">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-left:25%">
            <ul class="nav navbar-nav">

                <li><a href="all.php" class="active" style="color:black;font-size:25px;margin-left:15px">All</a></li>

                <li><a href="artwork-Traditional-Painting.php" style="color:black;font-size:25px;margin-left:15px">Traditional Painting</a>
                </li>
                <li><a href="artwork-Digital-Design.php" style="color:black;font-size:25px;margin-left:15px">Digital Design</a>
                </li>

                <li><a href="artwork-Sketch.php" style="color:black;font-size:25px;margin-left:15px">Sketch</a>
                </li>
                <li style="color:black;font-size:25px;margin-left:25px">
                    <!-- 包裹搜索框的表单，提交方式为 GET -->
                    <div class="input-group" style="margin-top:5px">
                        <!-- 搜索表单，提交到 search_results.php，使用GET方法发送关键字 -->
                        <form action="search_results.php" method="get">
                            <input type="hidden" name="type" value="<?php echo htmlspecialchars($type ?? ''); ?>">
                            <input type="text" class="form-control" name="keyword" placeholder="Search by keyword" style="width:70%">
                            <button class="btn btn-outline-primary" type="submit" style="margin-top:-6px">
                                <i class="fas fa-search"></i> <!-- 搜索图标 -->
                            </button>
                        </form>
                    </div>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="container">
            <!-- 画廊标题部分 -->
            <div class="gallery-heading">

            </div>
            <!-- 画廊网格区域 -->
            <div class="gallery-grids">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cover = htmlspecialchars($row["cover"]);
                        $title = htmlspecialchars($row["title"]);
                        $type = htmlspecialchars($row["type"]);
                        echo '
                    <div class="col-md-4 gallery-grid wow fadeInUp animated" data-wow-delay=".5s">
                        <div class="grid">
                            <figure class="effect-apollo">
                                <a class="example-image-link" href="single.php?artwork_id=' . $row["artwork_id"] . '">
                                    <img src="' . $cover . '" alt="' . $title . '" />
                                    <figcaption>
                                        <h3>' . $title . '</h3>
                                        <p>' . $type . '</p>
                                    </figcaption>
                                </a>
                            </figure>
                        </div>
                    </div>';
                    }
                } else {
                    echo "<p>没有找到艺术品信息</p>";
                }
                ?>
                <div class="clearfix"></div>
                <!-- 引入 lightbox-plus-jquery 插件 -->
                <script src="js/lightbox-plus-jquery.min.js"> </script>
            </div>
        </div>
    </div>

    <style>
        .footer a {
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
            <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1.708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
        </svg>
    </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById('back-to-top').style.display = 'block';
            } else {
                document.getElementById('back-to-top').style.display = 'none';
            }
        }

        document.getElementById('back-to-top').addEventListener('click', function() {
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
