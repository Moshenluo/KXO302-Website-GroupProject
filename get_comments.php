<?php
include 'dbconn.php';

// 获取当前页面的 forum_id
$forum_id = isset($_GET['forum_id']) ? $_GET['forum_id'] : null;

if ($forum_id === null) {
    echo '<div class="error-message">Forum ID not found</div>';
} else {
    // 使用预处理语句防止 SQL 注入
    $sql = "SELECT * FROM discuss WHERE forum_id = ? ORDER BY post_time DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $forum_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="comment-box">';
            echo '<p>' . htmlspecialchars($row['content']) . '</p>';
            echo '<p>用户：' . htmlspecialchars($row['user_id']) . '，时间：' . htmlspecialchars($row['post_time']) . '</p>';
            echo '</div>';
        }
    } else {
        echo '<div class="info-message">当前论坛暂无评论</div>';
    }
    
    $stmt->close();
}

$conn->close();
?>