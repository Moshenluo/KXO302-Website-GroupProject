<?php 
session_start();
require 'dbconn.php';
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
} else {
    $email = "";
}

if (empty($email)) {
        echo '<script>console.log(Viewer);</script>';
    $email = "";
    $userLevel = "";

} else {
    $sql = "SELECT role FROM user WHERE email =     '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userLevel = $row['role'];
    }}


?>
<div class="header">
	<div class="top-header">
		<div class="container">
			<div class="top-header-info">
				   <div class="top-header-left wow fadeInLeft animated" data-wow-delay=".5s">   <p>Desert Oasis </p>

				</div>
				<div class="top-header-right wow fadeInRight animated" data-wow-delay=".5s">
					<div class="top-header-right-info">
						<ul>

							<form>

							</form>
						</ul>
					</div>
					<div class="social-icons">
						<ul>
							</ul>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

    <div class="bottom-header">
        <div class="container">
            <!-- 网站 logo -->
            <div class="logo wow fadeInDown animated" data-wow-delay=".5s">
                <h1><a href="index.php"><img src="images/home.svg" alt="" /></a></h1>
            </div>
            <!-- 顶部导航栏 -->
            <div class="top-nav wow fadeInRight animated" data-wow-delay=".5s">
                <nav class="navbar navbar-default">
                    <div class="container">
                        <!-- 响应式菜单按钮 -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">Menu
                        </button>
                    </div>
                    <!-- 导航栏内容 -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <!-- 首页链接 -->
                            <li><a href="index.php" class="active">Home</a></li>
                            <!-- 下拉菜单：艺术家 -->
                            <li><a href="all.php" >Artworks</a>

                            </li>

                            <!-- 艺术家页面链接 -->
                            <?php if($userLevel == 'artist'): ?>
                            <li><a href="artist-personal.php">Artist</a></li>
                            <?php endif; ?>
                            <?php if($userLevel == 'admin'): ?>
                            <li><a href="admin.php">Admin</a></li>
                            <?php endif; ?>
                            <?php if($userLevel !== ''): ?>
                            <li><a href="product.php">Store</a></li>
                            <?php endif; ?>
                            <li><a href="about.php">Our team</a></li>
                            <?php if($userLevel !== ''): ?>
                            <li><a href="logout.php">Logout</a></li>
                            <?php endif; ?>
                            <?php if($userLevel == ''): ?>
                            <li><a href="login.php">Login</a></li>
                            <?php endif; ?>
                            
                            <!-- 搜索删掉 -->
                            <li><a href="" style="height:87px"><img src="images/header.jpg" width="32px" style="margin-top:-20px"><br>&nbsp;
                                    <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'user'; ?>
                                </a></li>
                        </ul>
                        <div class="clearfix"> </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>