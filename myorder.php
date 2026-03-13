<?php
include "header.php";
$email = $_SESSION['email'];
// 判断登录
if (empty($email)) {
    echo'<script>alert("You need to log in first."); window.location.href="login.php";</script>';
}
$user_id = $_SESSION['user_id'];

//查询订单
$sql_orders = "SELECT * FROM orders WHERE user_id = ? ORDER BY create_at DESC";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("i", $user_id);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();
?>

<!DOCTYPE html>
<html>
<head>
<title>My Order</title>
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

<?php
if ($result_orders->num_rows > 0) {
	while ($order = $result_orders->fetch_assoc()) {
		$order_id = $order['order_id'];
		$total_price = $order['total_price'];
		$address = $order['address'];
		$phone = $order['phone'];
		$recipient = $order['recipient'];
		$status = $order['status'];

		// 显示订单基本信息
		echo '<div class="blog">';
		echo '<div class="content">';
		echo '<div class="container">';
		echo '<div class="col-md-12 col-sm-12 women-dresses">';
		echo '<div class="ckeckout" style="background-color:white">';
		echo '<style>.newinput{padding: 10px;width: 80%;border: none;outline: none;color: #464646;font-size: 1.1em; border: 1px solid rgba(85, 85, 85, 0.19); -webkit-appearance: none;}</style>';


		echo '<div class="ckeckout-top">';
		echo '<div class="cart-items">';
		echo '<div class="contact-form">';
		echo '<form>';
		echo "<div><span><label>Name</label></span><span>$recipient</span></div>";
		echo "<div><span><label>Address</label></span><span>$address</span></div>";
		echo "<div><span><label>Tel</label></span><span>$phone</span></div>";
		echo "<div><span><label>Status</label></span><span>$status</span></div>";
		echo '</form>';
		echo '</div>';

		// 查询订单详情
		$sql_order_details = "SELECT od.amount, p.name, p.price, p.cover 
							FROM order_detail od
							JOIN product p ON od.product_id = p.product_id
							WHERE od.order_id = ?";
		$stmt_details = $conn->prepare($sql_order_details);
		$stmt_details->bind_param("i", $order_id);
		$stmt_details->execute();
		$result_details = $stmt_details->get_result();

		// 显示订单商品信息
		echo '<div class="in-check"><ul class="unit">';
		echo '<li><span>Product</span></li>';
		echo '<li><span>Name</span></li>';
		echo '<li><span>Unit Price</span></li>';
		echo '<li><span>Quantity</span></li>';
		echo '<div class="clearfix"> </div></ul>';

		while ($detail = $result_details->fetch_assoc()) {
			$product_name = $detail['name'];
			$unit_price = $detail['price'];
			$amount = $detail['amount'];
			$cover = $detail['cover'];

			echo '<ul class="cart-header2">';
			echo "<li class='ring-in'><img src='$cover' class='img-responsive' alt='' style='max-width: 40%;'></li>";
			echo "<li><span class='name'>$product_name</span></li>";
			echo "<li><span class='cost'>$unit_price</span></li>";
			echo "<li><span class='quantity'>$amount</span></li>";
			echo '<div class="clearfix"> </div></ul>';
		}

		echo '</div>'; // 结束 in-check

		// 显示订单号和总价
		echo "<div style='margin-left:0%;margin-top:20px'>";
		echo "<div class='col-md-6 product-left p-left'><span class='item_add items'> Order Number: $order_id</span></div>";
		echo "<div class='col-md-4 product-left p-left' style='margin-left:10px'><span class='item_add items'>Total Price: $total_price</span></div>";
		echo '</div>';

		echo '</div>'; // 结束 cart-items及其他div
		echo '</div>'; 
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
} else {
	echo "<p>You have no orders yet.</p>";
}
?>
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
