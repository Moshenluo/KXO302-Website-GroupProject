<?php
include "header.php";

$email = $_SESSION['email'];

if (empty($email)) {echo '<script>alert("请刷新页面")</script>';} 
else {
    $sql = "SELECT role FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userLevel = $row['role'];
    }}

if ($userLevel !== 'admin') {
    echo '<script>alert("Access requires administrator privileges");window.location = "index.php";</script>';
}


?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content=""/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>

    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>

    <link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="css/font-awesome.css" rel="stylesheet">

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>

    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>

</head>

<body>



<div class="blog">
    <div class="container">
        <!-- 标题 -->
        <h1>Artwork Management</h1>
        <!-- 作品管理表格 -->
        <table class="table table-bordered">
            <thead>
            <!-- 表头 -->
            <tr>
                <th>Artwork ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Artist</th>
                <th>Management</th>
            </tr>
            </thead>
            <tbody>
            <?php

                if($result =  $conn->query("select * from artwork left join user on user.user_id = artwork.user_id")){
                        while($row = mysqli_fetch_array($result)){
                           echo <<<HEERB
 <tr>
                <td>${row['artwork_id']}</td>
                <td>${row['title']}</td>
                <td>${row['type']}</td>
                <td>${row['name']}</td>
                <td>
                    <!-- 修改按钮 -->
                    <button class='btn btn-edit btn-primary btn-sm' 
                    data-id="${row['artwork_id']}"
                    data-title="${row['title']}"
                    data-type="${row['type']}"
                    data-name="${row['name']}"
                    data-user_id="${row['user_id']}"
                    >Alter</button>
                    <!-- 删除按钮 -->
                    <button class='btn btn-danger btn-sm btn-remove'   data-id="${row['artwork_id']}">Delete</button>
                </td>
</tr>
HEERB;
                        }
                }

            ?>

            </tbody>
        </table>

        <!-- 模态框 -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modify Artwork</h4>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="form-group">
                                <label for="itemId">Artwork ID:</label>
                                <input name="artwork_id" type="text" class="form-control" id="itemId" disabled>
                            </div>
                            <div class="form-group">
                                <label for="itemTitle">Title:</label>
                                <input name="title" type="text" class="form-control" id="itemTitle">
                            </div>
                            <div class="form-group">
                                <label for="itemType">Type:</label>
                                <select name="type"  class="form-control" id="itemType">
                                    <option>Traditional Painting</option>
                                    <option>Digital Design</option>
                                    <option>Sketch</option>
                                </select>
<!--                                <input name="type" type="text" class="form-control" id="itemType">-->
                            </div>
                            <div class="form-group">
                                <label for="itemArtist">Artist:</label>
                                <select name="user_id"  class="form-control" id="itemArtist" disabled>
                                    <?php

                                        if($result = $conn->query("select * from user")){
                                            while($row = mysqli_fetch_array($result)){
                                                echo "<option value='${row['user_id']}'>${row['name']}</option>";
                                            }
                                        }
                                        $conn->close();

                                    ?>
                                </select>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" id="saveChanges">保存更改</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<style>
    .footer a {
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
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
         class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1.708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
    </svg>
</button>


<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>-->
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
            document.getElementById('logoutLink').addEventListener('click', function (event) {
                event.preventDefault();
                localStorage.setItem('isLoggedIn', 'no');
                loginLink.innerHTML = '<a href="login.html">Login</a>';
                window.location.href = 'login.html';
            });
        }
    });
</script>
<script>
    $(function (){
        // update function

        $(".btn-edit").on("click", function (){
            $("#itemId").val($(this).data("id"))
            $("#itemTitle").val($(this).data("title"))
            $("#itemType").val($(this).data("type"))
            $("#itemArtist").val($(this).data("user_id"))
            $("#myModal").modal("show")
        })
        $("#saveChanges").on("click", function (){
            const formData = $("#editForm").serializeArray()
            const jsonData = {};

            $.each(formData, function() {
                jsonData[this.name] = this.value;
            });
            jsonData["artwork_id"] = $("#itemId").val()
            $.ajax({
                url: "artwork_management.php",
                method: 'POST',
                data: JSON.stringify(jsonData),
                contentType: 'application/json',
                success: function (res){

                    if(res === "success"){
                        alert("update success")
                        window.location.reload()
                    }else{
                        alert("update error")
                    }
                }
            })
        })
        // remove function
        $(".btn-remove").on("click", function (){
            const id = $(this).data("id")
            $.ajax({
                url: 'artwork_management.php?id=' + id,
                method: 'DELETE',
                success: function (res){
                    if(res === "success"){
                        alert("remove success")
                        window.location.reload()
                    }else{
                        alert("remove error")
                    }
                }
            })
        })
    })
</script>
</body>
</html>
