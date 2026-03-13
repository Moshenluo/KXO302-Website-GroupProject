<?php
include "header.php";

$_SESSION['email'] = '';

$checkuseremail = isset($_POST["email"]) ? $_POST['email'] : "";
$checkuserpassword = isset($_POST["password"]) ? $_POST['password'] : "";

if (!empty($checkuseremail) && !empty($checkuserpassword)) {
    $email = mysqli_real_escape_string($conn ,trim($_POST["email"]));
    $password = mysqli_real_escape_string($conn ,trim($_POST["password"]));
    $hashedPassword1 = $password;
    if($email != "admin001@artgallery.com") {
        $hashedPassword1 = crypt($password, "Group46");
    }

    $check_login = "SELECT * FROM `user` WHERE `email` = '$email'";
    if ($check_result = $conn->query($check_login)){
        if ($check_result->num_rows === 1 ){
            $row = $check_result->fetch_assoc();
            if($row["password"]===$hashedPassword1){
                $_SESSION['email'] = $email;  //会话变量：email
                $user_id = $row['user_id'];
                $_SESSION['user_id'] = $user_id; //会话变量：userid
                $user_name = $row['name'];
                $_SESSION['user_name'] = $user_name;  //会话变量：username
                $email_encoded = urlencode($email); // 对 email 进行 URL 编码
                echo "<script>alert('Login successful!');window.location.href='index.php'; </script>";
            }
            else{
                echo "<script>alert('The email or password is incorrect.'); </script>";
            }
        }
        else{
            echo "<script>alert('The email or password is incorrect.'); </script>";
        }
    }
    $conn->close();
}

?>





<!DOCTYPE html>
<html>
<head>
<title>Login</title>
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

	<div class="login">
    <div class="container">
        <!-- 登录主体部分 -->
        <div class="login-body">
            <!-- 登录标题 -->
            <div class="login-heading">
                <h1>Login</h1>
            </div>
            <!-- 登录信息表单 -->
            <div class="login-info">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="loginForm">
                    <!-- 输入邮箱 -->
                    <input type="text" class="user" name="email" placeholder="Email" required="">
                    <p class="loginError" id="loginAccountError" style = "color: rgb(255, 0, 0);"></p>
                    <!-- 输入密码 -->
                    <input type="password" name="password" class="lock" placeholder="Password" required="">
                    <p class="loginError" id="loginPasswordError" style = "color: rgb(255, 0, 0);"></p>
                    <!-- 同意条款和忘记密码部分 -->
                    <div class="forgot-top-grids">
                        <div class="forgot-grid">
                            <ul>
                                <li>
                                    <!-- 同意条款复选框 -->
                                    <!-- <input type="checkbox" id="brand1" value="">
                                    <label for="brand1"><span></span>agree</label> -->
                                </li>
                            </ul>
                        </div>
                        <div class="forgot">
                            <!-- 忘记密码链接 -->
                            <a href="getPasswordBack">Forget Password？</a>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <!-- 登录按钮 -->
                    <input type="submit" name="Sign In" value="Login">
                    <!-- 创建账号链接 -->
                    <div class="signup-text">
                        <a href="signup.php">Create One</a>
                    </div>
                    <hr>
                    <h2>Login</h2>
                    <!-- 登录图标区域 -->
                    <div class="login-icons">
                        <ul>
                        </ul>
                    </div>
                </form>
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
    // window.onscroll = function () {
    //   scrollFunction();
    // };

    // function scrollFunction() {
    //   if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    //     document.getElementById('back-to-top').style.display = 'block';
    //   } else {
    //     document.getElementById('back-to-top').style.display = 'none';
    //   }
    // }

    // document.getElementById('back-to-top').addEventListener('click', function () {
    //   document.body.scrollTop = 0;
    //   document.documentElement.scrollTop = 0;
    // });




	// var loginForm = document.getElementById('loginForm');
	// loginForm.addEventListener('submit', function(event) {
	// 	event.preventDefault();
	// 	var agreementCheckbox = document.getElementById('brand1');
	// 	if (agreementCheckbox.checked) {
	// 		window.location.href = 'index.html';
	// 		//假设登录成功，将isLoggedIn存储到localStorage中
	// 		localStorage.setItem('isLoggedIn', 'yes');
	// 	} else {
	// 		alert('You must agree to the terms to login.');
	// 	}
	// });

  </script>
  <script src="js/login.js"></script>
</body>
</html>
