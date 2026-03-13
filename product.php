<?php
// 引入数据库连接
include 'header.php';

// 启动会话
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 只有当 add_to_cart 存在并且请求为 POST 时，才执行添加到购物车的逻辑
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    // 检查用户是否登录
    if (!isset($_SESSION['user_id'])) {
        // 如果没有登录，则跳转到登录页面并传递返回路径
        header("Location: login.php?redirect_to=product.php");
        exit();
    }

    // 获取当前登录用户的 user_id
    $user_id = $_SESSION['user_id'];

    // 检查 user_id 是否为空
    if (empty($user_id)) {
        die("Error: User ID is null. Please login again.");
    }

    // 获取商品ID
    $product_id = $_POST['product_id'];

    // 检查该商品是否已经在购物车中（未下单，ordered = FALSE）
    $check_query = "SELECT * FROM order_detail WHERE user_id = ? AND product_id = ? AND ordered = FALSE";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $user_id, $product_id); // 绑定参数
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 如果购物车中已存在该商品，更新数量
        $update_query = "UPDATE order_detail SET amount = amount + 1 WHERE user_id = ? AND product_id = ? AND ordered = FALSE";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ii", $user_id, $product_id); // 绑定参数
        $update_stmt->execute();
        echo "<script>localStorage.setItem('cartMessage', 'The product has been added to the shopping cart!');</script>";
    } else {
        // 如果购物车中没有该商品，插入新记录
        $insert_query = "INSERT INTO order_detail (user_id, product_id, amount, ordered) VALUES (?, ?, 1, FALSE)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param("ii", $user_id, $product_id); // 绑定参数
        $insert_stmt->execute();
        echo "<script>localStorage.setItem('cartMessage', 'The product has been added to the shopping cart!');</script>";
    }

    // 使用重定向来避免表单的重复提交
    echo "<script>
            setTimeout(function() {
                window.location.href = 'product.php';
            }, 0);
          </script>";
    exit();
}

// 获取所有商品数据
$query = "SELECT * FROM product";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Shopping</title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>new WOW().init();</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 检查 localStorage 中是否有购物车消息
        if (localStorage.getItem('cartMessage')) {
            alert(localStorage.getItem('cartMessage')); // 显示消息
            localStorage.removeItem('cartMessage'); // 显示后清除消息
        }
    });
</script>
</head>

<body>
    <div class="product-model" style="background-color:#fbf7f7">  
        <div class="container">
            <div class="row"> <!-- 新增的父级容器 row -->
                <!-- 产品列表部分 -->
                <div class="col-md-9 product-model-sec">
                    <?php
                    if ($result->num_rows > 0) {
                        // 输出商品列表
                        while ($product = $result->fetch_assoc()) {
                            $product_id = $product['product_id'];  // 获取每个商品的 product_id
                            $product_name = $product['name'];      // 获取商品名称
                            $product_price = $product['price'];    // 获取商品价格
                            $product_image = $product['cover'];    // 获取商品图片路径
                            ?>
                            <!-- 商品展示部分 -->
                            <a> <!-- 包裹整个商品卡片 -->
                                <div class="product-grid">
                                    <div class="product-img b-link-stripe b-animate-go thickbox">
                                        <img src="<?php echo $product_image; ?>" class="img-responsive" alt="<?php echo $product_name; ?>">
                                        <div class="b-wrapper">
                                            <h4 class="b-animate b-from-left b-delay03"></h4>
                                        </div>
                                    </div>
                                    <div class="product-info simpleCart_shelfItem">
                                        <div class="product-info-cust prt_name">
                                            <span class="item_price">Price: <?php echo $product_price; ?> </span>
											<h4 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; color: black;"><?php echo $product_name; ?></h4>
                                            <div class="clearfix"></div>
											<!-- 商品添加到购物车的表单 -->
											<form action="product.php" method="post">
												<input type="hidden" name="add_to_cart" value="1">
												<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
												<button type="submit" class="item_add items">Add into Cart</button>
											</form>
                                            <div class="clearfix"></div>
                                        </div>                                                
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    } else {
                        echo "<p>没有找到商品。</p>";
                    }
                    ?>
                </div>

				<!-- 侧边栏部分 -->
				<div class="rsidebar span_1_of_left">
					<section class="sky-form">
						<div class="product_right">
							<h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Category：</h4>
							<div class="tab1">
								<ul class="place">
									<!-- 将“我的购物车”变成链接，跳转到 shoppingcart.php -->
									<li class="sort" style="background-color:dark">
										<a href="shoppingcart.php" style="background-color:dark">【My Shopping Cart】</a>
									</li>
									<div class="clearfix"> </div>
								</ul>
							</div>
							<div class="tab2">
								<ul class="place">
									<!-- 将“我的订单”变成链接，跳转到 myorder.php -->
									<li class="sort">
										<a href="myorder.php">【My Order】</a>
									</li>
									<div class="clearfix"> </div>
								</ul>
							</div>
						</div>
					</section>
				</div>
            </div> <!-- 结束 row 容器 -->
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