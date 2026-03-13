<?php
include "header.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/show.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/show.js"></script>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>

        /* 白天模式样式 */
       .light-mode {
            background-color: #a8d8d8;
            color: #333;
        }

        /* 黑夜模式样式 */
       .dark-mode {
            background-color: gray;
            color: #fff;
        }
		input[type="search"] {
  padding-right: 50px; /* Make space for the button */
}

button[type="submit"] {
  background: transparent;
  border: none;
  font-size: 16px; /* Adjust as needed */
  position: absolute;
  right: 0;
  top: 0;
}
    </style>


<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<body class="light-mode">
<div class="mode-toggle" style="position: fixed; top: 10px; right: 10px;z-index: 9999">
        <button id="toggle-mode" class="btn btn-outline-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill" viewBox="0 0 16 16">
                <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1.5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1.5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1.5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0.707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1.707 0zm-9.193 9.193a.5.5 0 0 1 0.707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1.707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1.707-.707l1.414 1.414a.5.5 0 0 1 0.707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1.707-.707l1.414 1.414a.5.5 0 0 1 0.708z"/>
            </svg>
        </button>
    </div>
	<script>
        document.getElementById('toggle-mode').addEventListener('click', function () {
            const body = document.body;
            if (body.classList.contains('light-mode')) {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
            } else {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
            }
        });
    </script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<div class="header">
    <!-- 顶部头部区域 -->
    <div class="top-header">
        <div class="container">
            <!-- 顶部头部信息 -->
            <div class="top-header-info">
                <!-- 左侧信息：显示“敦煌艺术”字样 -->
                   <div class="top-header-left wow fadeInLeft animated" data-wow-delay=".5s">

                </div>
                <!-- 右侧信息 -->
                <div class="top-header-right wow fadeInRight animated" data-wow-delay=".5s">
                    <!-- 右侧具体信息 -->
                    <div class="top-header-right-info">
                        <ul>
                            <!-- 可能是预留的表单位置 -->
                            <form>
                            </form>
                        </ul>
                    </div>
                    <!-- 社交图标区域 -->
                    <div class="social-icons">
                        <ul>
                            <!-- 这里可能用于放置各种社交平台的图标链接 -->
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>

    <!-- 底部头部区域 -->

</div>



			<div class="banner">
    <!-- 轮播图区域 -->
    <div class="slider">
        <!-- 轮播图标题 -->
        <h2 class="wow shake animated" data-wow-delay=".5s"> Desert Oasis</h2>
        <!-- 装饰边框 -->
        <div class="border"></div>
        <!-- 引入响应式轮播图插件 -->
        <script src="js/responsiveslides.min.js"></script>
        <script>
            // 初始化轮播图插件
            $(function () {
                $("#slider3").responsiveSlides({
                    auto: true, // 自动播放
                    pager: true, // 显示分页器
                    nav: true, // 显示导航按钮
                    speed: 500, // 切换速度
                    namespace: "callbacks", // 命名空间
                    before: function () {
                        $('.events').append("<li>before event fired.</li>");
                    },
                    after: function () {
                        $('.events').append("<li>after event fired.</li>");
                    }
                });
            });
        </script>
        <!-- 轮播图容器 -->
        <div id="top" class="callbacks_container-wrap">
            <ul class="rslides" id="slider3">
                <li>
                    <!-- 单个轮播图内容 -->
                    <div class="slider-info">
                        <h3 class="wow fadeInRight animated" data-wow-delay=".5s">Unveil Dunhuang’s Masterpieces</h3>

                        <div class="more-button wow fadeInRight animated" data-wow-delay=".5s">
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="information">
    <div class="container">
        <!-- 信息部分标题 -->
        <div class="information-heading">
            <h3 class="wow fadeInDown animated" data-wow-delay=".5s">Our Mission</h3>
            <p class="wow fadeInUp animated" data-wow-delay=".5s">We hope to promote the popularization and development of Dunhuang art by providing a multi-functional online platform</p>
        </div>
        <!-- 信息网格区域 -->
        <div class="information-grids">
            <!-- 第一个信息网格 -->
            <div class="col-md-4 information-grid wow fadeInLeft animated" data-wow-delay=".5s">
                <div class="information-info">
                    <div class="information-grid-img">
                        <img src="images/8.jpg" alt="" />
                    </div>
                    <div class="information-grid-info">
                        <h4>Exhibition </h4>
                        <p>Our platform provides a stage for artworks to show their work, and each artwork is able to upload their Dunhuang-inspired artwork through their personal homepage.。</p>
                    </div>
                </div>
            </div>
            <!-- 第二个信息网格 -->
            <div class="col-md-4 information-grid wow fadeInUp animated" data-wow-delay=".5s">
                <div class="information-info">
                    <div class="information-grid-info">
                        <h4>Appreciation</h4>
                        <p>We are committed to providing users with a convenient online viewing experience, users can easily browse and appreciate the works, enjoy the charm of art。</p>
                    </div>
                    <div class="information-grid-img">
                        <img src="images/3.jpg" alt="" />
                    </div>
                </div>
            </div>
            <!-- 第三个信息网格 -->
            <div class="col-md-4 information-grid wow fadeInRight animated" data-wow-delay=".5s">
                <div class="information-info">
                    <div class="information-grid-img">
                        <img src="images/7.jpg" alt="" />
                    </div>
                    <div class="information-grid-info">
                        <h4>Interaction</h4>
                        <p>An interactive platform for artworks and viewers to communicate directly,which help deepen their understanding and appreciation of Dunhuang's art.</p>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<div class="popular">
    <div class="container">
        <!-- 热门部分标题 -->
        <div class="popular-heading information-heading">
            <h3 class="wow fadeInDown animated" data-wow-delay=".5s">Background of Dunhuang</h3>
            <p class="wow fadeInUp animated" data-wow-delay=".5s">Dunhuang is the original cultural heritage, we are here to supplement the relevant background information to help you more understand of the art and culture of Dunhuang, so that you can better relish this exhibition!</p>
        </div>
        <!-- 轮播图区域 -->
        <div class="popular-slide">
            <script>
                // 初始化轮播图插件
                $(function () {
                    $("#slider1").responsiveSlides({
                        auto: true, // 自动播放
                        pager: true, // 显示分页器
                        nav: false, // 不显示导航按钮
                        speed: 500, // 切换速度
                        namespace: "callbacks", // 命名空间
                        before: function () {
                            $('.events').append("<li>before event fired.</li>");
                        },
                        after: function () {
                            $('.events').append("<li>after event fired.</li>");
                        }
                    });
                });
            </script>
            <div id="top" class="callbacks_container-wrap">
                <ul class="rslides" id="slider1">
                    <!-- 第一个轮播图内容 -->
                    <li>
                        <div class="popular-slide-info wow bounceIn animated" data-wow-delay=".5s">

                        </div>
                    </li>
                    <!-- 第二个轮播图内容 -->
                    <li>
                        <div class="popular-slide-info popular-slide1">

                        </div>
                    </li>
                    <!-- 第三个轮播图内容 -->
                    <li>
                        <div class="popular-slide-info popular-slide2">

                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- 热门网格区域 -->
        <div class="popular-grids">
            <!-- 第一个热门网格 -->
            <div class="col-md-4 popular-grid wow fadeInLeft animated" data-wow-delay=".5s">
                <h5>location</h5>
                <p>Dunhuang is located in Gansu Province in northwestern China and was the transportation hub of the ancient Silk Road</p>
            </div>
            <!-- 第二个热门网格 -->
            <div class="col-md-4 popular-grid wow fadeInUp animated" data-wow-delay=".5s">
                <h5>History</h5>
                <p>The construction of the Mogao Caves began in 366 A.D., with an overall creation time of about one thousand years</p>
            </div>
            <!-- 第三个热门网格 -->
            <div class="col-md-4 popular-grid wow fadeInRight animated" data-wow-delay=".5s">
                <h5>Dunhuang art！</h5>
                <p>It has three main forms: the art of mural painting, the art of colored sculpture, and grotto architecture.</p>
            </div>
			<div class="col-md-12 popular-grid wow fadeInRight animated" data-wow-delay=".5s">

                <p>Because of its long history, there are different genres of art forms, and the above motion picture is to show you the style of frescoes in different periods</p>
            </div>

            <div class="clearfix"> </div>
        </div>
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
        <!-- 版权信息 -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        // 当页面滚动距离超过 20px 时显示返回顶部按钮
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById('back-to-top').style.display = 'block';
        } else {
            document.getElementById('back-to-top').style.display = 'none';
        }
    }

    document.getElementById('back-to-top').addEventListener('click', function () {
        // 点击返回顶部按钮时，页面滚动回到顶部
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });


</script>
</body>
</html>
