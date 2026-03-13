<?php
include "header.php";  // 包含数据库连接等

// 获取表单提交的数据
if (isset($_POST['order_detail_id']) && isset($_POST['amount'])) {
    $order_detail_id = $_POST['order_detail_id'];
    $new_amount = $_POST['amount'];

    if ($new_amount == 0) {
        // 直接在此文件中执行删除操作
        $delete_query = "DELETE FROM order_detail WHERE order_detail_id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $order_detail_id);
        $delete_stmt->execute();
    } else {
        // 更新数据库中的 amount
        $update_query = "UPDATE order_detail SET amount = ? WHERE order_detail_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ii", $new_amount, $order_detail_id);
        $update_stmt->execute();
    }

    // 刷新当前页面
    header("Location: shoppingcart.php");
    exit();
} else {
    echo "无效的请求。";
}

$conn->close();
?>
