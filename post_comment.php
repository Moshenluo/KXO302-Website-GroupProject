<?php
session_start();
include 'dbconn.php';

// var_dump($_SESSION);
// $comment = $_POST['comment'];
// $forum_id = $_POST['forum_id'];
// $user_id = $_SESSION['user_id'];// 获取当前登录用户ID

// var_dump($_SESSION['email']);exit;
if (isset($_POST['comment']) && isset($_POST['forum_id'])&& isset($_SESSION['user_id'])) {
    $comment = $_POST['comment'];
    $forum_id = $_POST['forum_id'];
    $user_id = $_SESSION['user_id'];  // Ensure session is properly started

    // Debug: Output the received values
    echo "Comment: " . $comment . "<br>";
    echo "Forum ID: " . $forum_id . "<br>";
    echo "User ID: " . $user_id . "<br>";

    $sql = 'INSERT INTO discuss (user_id, content,forum_id) VALUES ("'.$user_id.'", "'.$comment.'", "'.$forum_id.'")';

    $res = $conn->query($sql);
    // 插入数据库
    // $stmt = $conn->prepare("INSERT INTO discuss (user_id, content,forum_id) VALUES (?, ?, ?)");
    // $stmt->bind_param("is", $user_id, $comment, $forum_id);
    // $stmt->execute();
    // $stmt->close();

    $conn->close();

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing comment, forum_id, or user_id'
    ]);
    exit;
}



echo '评论提交成功！';