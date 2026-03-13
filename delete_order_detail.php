<?php
include "header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 打印提交的 POST 数据进行调试
    var_dump($_POST);

    // 确保 order_detail_id 存在
    if (isset($_POST['order_detail_id']) && !empty($_POST['order_detail_id'])) {
        $order_detail_id = $_POST['order_detail_id'];

        // 执行删除操作
        $delete_query = "DELETE FROM order_detail WHERE order_detail_id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $order_detail_id);
        $delete_stmt->execute();

        // 检查删除是否成功
        if ($delete_stmt->affected_rows > 0) {
            // 删除成功后，刷新页面
            header("Location: shoppingcart.php"); // 假设当前页面为 shoppingcart.php
            exit; // 确保 header 执行后不会继续输出
        } else {
            echo "删除失败，找不到相应的订单明细。";
        }

        $delete_stmt->close();
    } else {
        echo "未提供有效的订单明细ID。";
    }
}

$conn->close();
?>
