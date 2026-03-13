<?php

require "dbconn.php";
if($_SERVER['REQUEST_METHOD'] == "DELETE"){
    $id = $_GET['id'];
    if($conn->query("DELETE FROM artwork WHERE artwork_id = '$id'")){
        echo "success";
    }else{
        echo "error";
    }

}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    // 获取原始 POST 数据
    $jsonData = file_get_contents('php://input');

// 将 JSON 字符串转换为 PHP 数组
    $data = json_decode($jsonData, true);
    if($conn->query("UPDATE  artwork set title='$data[title]', type='$data[type]', user_id='$data[user_id]'  where artwork_id = '$data[artwork_id]'")){
        echo "success";
    }else{
        echo "error";
    }

}

$conn->close();