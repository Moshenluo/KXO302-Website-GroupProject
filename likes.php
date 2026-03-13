<?php
session_start();
require 'dbconn.php';

$artwork_id = $_POST['artwork_id'];
$likeStatus = $_POST['likeStatus'];
$email = $_SESSION['email'];

// 判断登录
if (empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'You need to log in first']);
    exit;
}

// 更新点赞数
if ($likeStatus === 'liked') {
    $conn->query("UPDATE artwork SET likes_count = likes_count - 1 WHERE artwork_id = '$artwork_id'");
    $likeStatus = "unliked"; 
} else {
    $conn->query("UPDATE artwork SET likes_count = likes_count + 1 WHERE artwork_id = '$artwork_id'");
    $likeStatus = "liked"; 
}
$sql_likes = "SELECT likes_count FROM artwork WHERE artwork_id = '$artwork_id'";
$result_likes = $conn->query($sql_likes);
if ($result_likes->num_rows > 0) {
    $row = $result_likes->fetch_assoc();
    $likes_count = $row['likes_count'];
}

// 返回结果
echo json_encode([
    'status' => 'success',
    'likes_count' => $likes_count,
    'likeStatus' => $likeStatus
]);
?>