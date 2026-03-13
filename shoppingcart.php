<?php
include "header.php";

if (!empty($email)) {
    // 查询 user 表获取 user_id
    $user_query = "SELECT user_id FROM user WHERE email = ?";
    $user_stmt = $conn->prepare($user_query);
    $user_stmt->bind_param("s", $email);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    
    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['user_id'];
        
        // 将 user_id 存储到会话中（如果需要在多个页面使用）
        //$_SESSION['user_id'] = $user_id;
        
        // 查询 order_detail 表，获取未下单的产品
        $query = "SELECT od.order_detail_id, od.product_id, od.amount, p.name, p.price, p.cover 
          FROM order_detail od 
          JOIN product p ON od.product_id = p.product_id 
          WHERE od.user_id = ? AND od.ordered = 0";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        echo "未找到对应的用户ID";
    }
    $user_stmt->close();
} else {
    // 如果用户未登录，重定向到登录页面
    header("Location: login.php");
    exit();  // 确保后续代码不会执行
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Shopping Cart</title>
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
	<script>
		 new WOW().init();
	</script>

</head>
</head>
<body >
<div class="ckeckout" style="background-color:white">
		<div class="container">
			<div class="ckeck-top heading">
				<h4>My Shopping Cart</h4>
			</div>
			<div class="ckeckout-top">
			<div class="cart-items">

			<div class="in-check">
				<ul class="unit">
					<li><span>Image</span></li>
					<li><span>Name</span></li>		
					<li><span>Unit Price</span></li>
					<li><span>Quantity</span></li>
					<li> </li>
					<div class="clearfix"> </div>
				</ul>

				<?php
					$total = 0; // 用于存储总价

					while ($row = $result->fetch_assoc()) {
						// 计算每个产品的总价 (单价 * 数量)
						$product_total = $row['price'] * $row['amount'];
						$total += $product_total; // 累加总价

						echo '<ul class="cart-header" style="display: flex; align-items: center;">';
						
						// 删除操作表单
						echo '<form method="POST" action="delete_order_detail.php" style="margin-right: 10px;">'; 
						echo '<input type="hidden" name="order_detail_id" value="' . $row['order_detail_id'] . '">';
						echo '<button type="submit" class="close1" ></button>';
						echo '</form>'; 

						// 商品的显示部分
						echo '<li class="ring-in"><a href="single.html"><img src="' . $row['cover'] . '" class="img-responsive" alt="" style="max-width: 40%;"></a></li>';
						echo '<li><span class="name">' . $row['name'] . '</span></li>';
						echo '<li><span class="cost"> ' . $row['price'] . '</span></li>';

						// 更新数量操作表单
						echo '<form method="POST" action="update_amount.php" style="margin-left: 10px;">'; 
						echo '<input type="hidden" name="order_detail_id" value="' . $row['order_detail_id'] . '">';
						echo '<li><input type="text" class="item_quantity" name="amount" value="' . $row['amount'] . '" 
								data-id="' . $row['order_detail_id'] . '" 
								onkeydown="if(event.key === \'Enter\'){this.form.submit();}" style="width: 50px; text-align: center;" /></li>';
						echo '</form>'; 
						
						echo '<div class="clearfix"> </div>';
						echo '</ul>';
					}
				?>
			</div>
			<div class="col-md-16" style="margin-top: 20px;">
				<!-- 保持原始布局样式 -->
				<div class="col-md-6 product-left p-left">
					<span class="item_add items"> Total: <?php echo number_format($total, 2); ?></span>
				</div>

				<!-- 创建订单按钮 -->
				<div class="col-md-3 product-left p-left">
					<a class="item_add items" href="order.php">Create Order</a>
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
