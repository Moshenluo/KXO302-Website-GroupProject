<?php
include "header.php";

$_SESSION['username'] = '';
if (isset($_POST["userName"]) && isset($_POST["userPassword"]) && isset($_POST["userEmail"])) {
    $username = mysqli_real_escape_string($conn ,trim($_POST["userName"]));
    $email = mysqli_real_escape_string($conn ,trim($_POST["userEmail"]));
    $password = mysqli_real_escape_string($conn ,trim($_POST["userPassword"]));
    $hashedPassword = crypt($password, "Group46");
    $userRole = mysqli_real_escape_string($conn ,trim($_POST["userRole"]));

    $check_email = "SELECT * FROM `user` WHERE `email` = '$email'";  //检查邮件是否唯一
    $email_result = $conn->query($check_email);
    if ($email_result->num_rows > 0) {
        echo "<script>alert('The email address is already registered! Please re-register.'); </script>";
    }
    else{
        $check_username = "SELECT * FROM `user` WHERE `name` = '$username'";  //检查用户名是否唯一
        $result = $conn->query($check_username);
        if($result->num_rows > 0){
            echo "<script>alert('The user name has been duplicated! Please re-register.'); </script>";
        } else{
        
            $insert_query = "INSERT INTO `user` (`name`, `password`, `email`, `role`) VALUES ('$username', '$hashedPassword', '$email' , '$userRole')";
            $conn->query($insert_query);
            
            echo "<script>alert('Registration was successful! Please login again.'); window.location.href='login.php'</script>";
        }
    }
    }



?>




<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
<body>

	<div class="login">
    <div class="container">
        <!-- 登录主体部分 -->
        <div class="login-body">
            <!-- 登录标题 -->
            <div class="login-heading">
                <h1>Register</h1>
            </div>
            <!-- 登录信息表单 -->
            <div class="login-info">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="registrationForm">
                    <!-- 输入用户名 -->
                    <input type="text" class="user" name="userName" placeholder="UserName" required=""id="loginCreateAccount">
                    <p class="loginError" id="loginCreateAccountError" style = "color: rgb(255, 0, 0);"></p>
                    <!-- 输入邮箱 -->
                    <input type="text" class="user" name="userEmail" placeholder="Email" required=""id="loginCreateEmail">
                    <p class="loginError" id="loginEmailError"style = "color: rgb(255, 0, 0);"></p>
                    <!-- 输入密码 -->
                    <input type="password" name="userPassword" class="lock" placeholder="Password"id="loginCreatePassword">
                    <p class="loginError" id="loginCreatePasswordError" style = "color: rgb(255, 0, 0);"></p>
                    <!-- 确认密码 -->
                    <input type="password" name="password" class="lock" placeholder="Confirm Password"id="loginComfirmPassword">
                    <p class="loginError" id="loginComfirmPasswordError" style = "color: rgb(255, 0, 0);"></p>
                    <!-- 选择用户类型 -->
                    <select class="form-select" name="userRole" style="font-size: 0.9em;
    padding: 10px 0px;
    width: 100%;
    color: #A8A8A8;
    outline: none;
    border: 1px solid #D3D3D3;
    border-top: none;
    border-left: none;
    border-right: none;
    background: #FFFFFF;
    margin: 0em 0em 1.5em 0em">
                        <option value="visitor">User</option>
                        <option value="artist">Artist</option>

                    </select>
                    <!-- 同意隐私政策复选框 -->
                    <input type="checkbox" id="brand1" value="">
                    <label for="brand1" ><span></span>I agree the <a href="privacy.php" target="_blank" style="text-decoration: underline; color: #007bff;">private policy</a> </label>&nbsp;&nbsp;&nbsp;
                    <!-- 注册按钮 -->
                    <input type="submit" name="Sign In" value="Register">
                    <!-- 已有账号登录链接 -->
                    <div class="signup-text">
                        <a href="login.php">Have one,Plase Login</a>
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
  <script src="js/signup.js"></script>
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

    /*
	var registrationForm = document.getElementById('registrationForm');
	registrationForm.addEventListener('submit', function(event) {
		event.preventDefault();
		var privacyPolicyCheckbox = document.getElementById('brand1');
		if (privacyPolicyCheckbox.checked) {
			window.location.href = 'login.html';
		} else {
			alert('You must agree to the private policy to register.');
		}
	});
    */

  </script>
</body>
</html>
