<?php
include "header.php";

// 检查用户是否登录
if (!empty($email)) {
    // 查询用户ID
    $user_query = "SELECT user_id FROM user WHERE email = ?";
    $user_stmt = $conn->prepare($user_query);
    $user_stmt->bind_param("s", $email);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['user_id'];

        // 查询购物车商品信息
        $cart_query = "SELECT od.order_detail_id, od.product_id, od.amount, p.name, p.price, p.cover 
                       FROM order_detail od 
                       JOIN product p ON od.product_id = p.product_id 
                       WHERE od.user_id = ? AND od.ordered = 0";
        $cart_stmt = $conn->prepare($cart_query);
        $cart_stmt->bind_param("i", $user_id);
        $cart_stmt->execute();
        $cart_result = $cart_stmt->get_result();

        if ($cart_result->num_rows === 0) {
            $cart_empty = true;  // 购物车为空的标志
        } else {
            $cart_empty = false; // 购物车不为空
        }
    } else {
        echo "未找到用户信息。";
        $cart_empty = true; // 假设未找到用户信息时购物车为空
    }

    $user_stmt->close();
} else {
    // 如果未登录，重定向到登录页面
    header("Location: login.php");
    exit();
}

// 处理订单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取表单数据
    $recipient = $_POST['recipient'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // 防止 SQL 注入，使用预处理语句
    $insert_order_sql = "INSERT INTO orders (user_id, recipient, address, phone, total_price, status) 
                         VALUES (?, ?, ?, ?, ?, ?)";

    if ($order_stmt = $conn->prepare($insert_order_sql)) {
        $total_amount = 0;
        // 计算总金额
        while ($row = $cart_result->fetch_assoc()) {
            $total_amount += $row['price'] * $row['amount'];
        }

        // 设置订单状态为 "Pending shipment"
        $status = 'Pending shipment'; 

        $order_stmt->bind_param("issdss", $user_id, $recipient, $address, $phone, $total_amount, $status);
        if ($order_stmt->execute()) {
            // 获取新订单ID
            $order_id = $conn->insert_id;

            // 将购物车商品添加到订单详情表中，同时将订单商品的 `ordered` 设置为 1
            $insert_order_detail_sql = "UPDATE order_detail SET order_id = ?, ordered = 1 WHERE order_detail_id = ? AND user_id = ?";
            $order_detail_stmt = $conn->prepare($insert_order_detail_sql);

            // 重新执行购物车查询
            $cart_stmt->execute();
            $cart_result = $cart_stmt->get_result();
            while ($row = $cart_result->fetch_assoc()) {
                // 更新每个购物车商品的订单ID和已下单状态
                $order_detail_stmt->bind_param("iii", $order_id, $row['order_detail_id'], $user_id);
                $order_detail_stmt->execute();
            }

            echo "<p>订单已成功提交！</p>";
            header("Location: myorder.php?order_id=" . $order_id);
            exit();
        } else {
            echo "<p>订单提交失败: " . $order_stmt->error . "</p>";
        }
        $order_stmt->close();
    } else {
        echo "<p>SQL 错误: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>

<div class="ckeckout" style="background-color:white">
    <div class="container">
        <div class="ckeck-top heading">
            <h4>Product List</h4>
        </div>

        <!-- 显示购物车中的商品 -->
        <div class="ckeckout-top">
            <div class="cart-items">
                <div class="in-check">
                    <ul class="unit">
                        <li><span>Image</span></li>
                        <li><span>Name</span></li>
                        <li><span>Unit Price</span></li>
                        <li><span>Quantity</span></li>
                        <div class="clearfix"> </div>
                    </ul>

                    <?php
                    if (!$cart_empty) {
                        // 只有购物车不为空时才显示商品
                        $cart_result->data_seek(0); // 重置游标
                        $total = 0;
                        while ($row = $cart_result->fetch_assoc()) {
                            $product_total = $row['price'] * $row['amount'];
                            $total += $product_total;
                            echo '<ul class="cart-header" style="display: flex; align-items: center;">';
                            echo '<li class="ring-in"><a href="single.html"><img src="' . $row['cover'] . '" class="img-responsive" alt="" style="max-width: 40%;"></a></li>';
                            echo '<li><span class="name">' . $row['name'] . '</span></li>';
                            echo '<li><span class="cost"> ' . $row['price'] . '</span></li>';
                            echo '<li><span class="quantity">' . $row['amount'] . '</span></li>';
                            echo '<div class="clearfix"> </div>';
                            echo '</ul>';
                        }
                    } else {
                        // 如果购物车为空，显示提示信息
                        echo "<p>您的购物车为空，无法创建订单。</p>";
                    }
                    ?>

                </div>
            </div>
        </div>

        <!-- 显示总金额 -->
        <?php if (!$cart_empty): ?>
        <div class="col-md-6" style="margin-top: 20px;">
            <div class="col-md-6 product-left p-left">
                <span class="item_add items">Total: <?php echo number_format($total, 2); ?></span>
            </div>
        </div>
        <?php endif; ?>

        <!-- 订单表单 -->
        <div class="contact">
            <div class="container">
                <div class="section group">
                    <div class="col-md-12 span_2_of_3">
                        <div class="contact-form">
                            <form method="POST" action="order.php">
                                <div>
                                    <span><label>Name</label></span>
                                    <span><input name="recipient" type="text" class="textbox" required></span>
                                </div>
                                <div>
                                    <span><label>Address</label></span>
                                    <span><input name="address" type="text" class="textbox" required></span>
                                </div>
                                <div>
                                    <span><label>Phone</label></span>
                                    <span><input name="phone" type="text" class="textbox" required></span>
                                </div>
                                <div>
                                    <center><span><input type="submit" class="mybutton" value="Submit" style="font-weight:bold"></span></center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>

