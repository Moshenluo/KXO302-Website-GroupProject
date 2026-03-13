<?php
include "header.php";?>

<!DOCTYPE html>
<html>
<head>
<title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />


<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="css/font-awesome.css" rel="stylesheet">


<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>

</head>
</head>
<body>

	<div class="contact">
    <div class="container">
        <!-- 团队简介部分 -->
        <div class="contact-heading">
            <h2 class="wow fadeInDown animated" data-wow-delay=".5s">Team Profile</h2>
   
		  </style>
<style type="text/css">
* {padding: 0;margin: 0;font-family: "微软雅黑";font-size: 14px;}
ul,li {list-style: none;}
a {text-decoration: none;color: black;}
.box{width: 800px;height: 400px;margin: 20px auto;overflow: hidden;position: relative;}
.box-1 ul{}
.box-1 ul li{width: 800px;height: 400px;position: relative;overflow: hidden;}
.box-1 ul li img{display:block;width: 800px; height: 400px;}
.box-1 ul li h2{position: absolute;left: 0;bottom: 0;height: 40px;width:300px;background: rgba(125,125,120,.4);text-indent: 2em;
				padding-right:500px ;font-size: 15px;line-height: 40px;text-overflow: ellipsis;overflow: hidden;
				white-space: nowrap;font-weight: normal;color: ghostwhite}
.box-2{position: absolute;right: 10px;bottom: 14px;}
.box-2 ul li{float:left;width: 12px;height: 12px;overflow: hidden; margin: 0 5px; border-radius: 50%;
				background: rgba(0,0,0,0.5);text-indent: 100px;cursor: pointer;}
.box-2 ul .on{background: rgba(255,255,255,0.6);}
.box-3 span{position: absolute;color: white;background: rgba(125,125,120,.3);width: 50px;height: 80px;
				top:50%; font-family: "宋体";line-height: 80px;font-size:60px;margin-top: -40px;
				text-align: center;cursor: pointer;}
.box-3 .prev{left: 28px;}
.box-3 .next{right: 10px;}
.box-3 span::selection{background: transparent;}
.box-3 span:hover{background: rgba(125,125,120,.8);}
</style>

<script type="text/javascript">
window.onload = function(){
	function $(param){
		if(arguments[1] == true){
			return document.querySelectorAll(param);
		}else{
			return document.querySelector(param);
		}
	}
	var $box = $(".box");
	var $box1 = $(".box-1 ul li",true);
	var $box2 = $(".box-2 ul");
	var $box3 = $(".box-3");
	var $length = $box1.length;
	
	var str = "";
	for(var i =0;i<$length;i++){
		if(i==0){
			str +="<li class='on'>"+(i+1)+"</li>";
		}else{
			str += "<li>"+(i+1)+"</li>";
		}
	}
	$box2.innerHTML = str;
	
	var current = 0;
	
	var timer;
	timer = setInterval(go,2000);
	function go(){
		for(var j =0;j<$length;j++){
			$box1[j].style.display = "none";
			$box2.children[j].className = "";
		}
		if($length == current){
			current = 0;
		}
		$box1[current].style.display = "block";
		$box2.children[current].className = "on";
		current++;
	}
	
	for(var k=0;k<$length;k++){
		$box1[k].onmouseover = function(){
			clearInterval(timer);
		}
		$box1[k].onmouseout = function(){
			timer = setInterval(go,2000);
		}
	}
	for(var p=0;p<$box3.children.length;p++){
		$box3.children[p].onmouseover = function(){
			clearInterval(timer);
		};
		$box3.children[p].onmouseout = function(){
			timer = setInterval(go,2000);
		}
	}
	
	for(var u =0;u<$length;u++){
		$box2.children[u].index  = u;
		$box2.children[u].onmouseover = function(){
			clearInterval(timer);
			for(var j=0;j<$length;j++){
				$box1[j].style.display = "none";
				$box2.children[j].className = "";
			}
			this.className = "on";
			$box1[this.index].style.display = "block";
			current = this.index +1;
		}
		$box2.children[u].onmouseout = function(){
			timer = setInterval(go,2000);
		}
	}
	
	$box3.children[0].onclick = function(){
		back();
	}
	$box3.children[1].onclick = function(){
		go();
	}
	function back(){
		for(var j =0;j<$length;j++){
			$box1[j].style.display = "none";
			$box2.children[j].className = "";
		}
		if(current == 0){
			current = $length;
		}
		$box1[current-1].style.display = "block";
		$box2.children[current-1].className = "on";
		current--;
	}
}
</script>

<body>

	
    <div class="container">
<div class="box ">
	<div class="box-1 col-md-4">
		<ul>
			<li>
				<img src="images/project1.jpg" alt="这里是第一场图片"></img>
				
			</li>
			<li>
				<img src="images/project2.jpg" alt="这里是第二张图片"></img>
				
			</li>
			<li>
				<img src="images/project3.jpg" alt="这里是第三张图片"></img>
			
			</li>
			<li>
				<img src="images/project4a.jpg" alt="这里是第一场图片"></img>
				
			</li>
			<li>
				<img src="images/project4b.jpg" alt="这里是第一场图片"></img>
			
			</li>
			<li>
				<img src="images/project5.jpg" alt="这里是第一场图片"></img>
				
			</li>
			<li>
				<img src="images/project6.jpg" alt="这里是第一场图片"></img>
			
			</li>
		</ul>
	</div>
	<div class="box-2">
		<ul>
			
		</ul>
	</div>
	<div class="box-3">
		<span class="prev"> < </span>
		<span class="next"> > </span>
	</div>
</div>
        </div>
		<style>
        p {
           font-family:"Arial";
		   font-size:16px;
        }
		h3
		{
		margin-left:110px;
		
		}
    </style>
        <!-- 隐私声明部分 -->
		<div style="clear:both"></div>
        <div class="about">
           <div class="container mt-4">
		<h2 class="wow fadeInDown animated" data-wow-delay=".5s">Copyright Notice</h2>
        <p style="text-align:left;font-weight:bold">Effective Date: 30/06/2025</p>
        <p style="text-align:left;font-weight:bold">Last Updated: 06/11/2024</p>
        <p style="text-align:left">The website Desert Oasis: unveilinging Dunhuang’s Masterpieces strictly adheres to the Copyright Law of the People’s Republic of China and the Regulations on the Protection of the Right to Network Dissemination of Information, as well as the EU Copyright Directive (Directive (EU) 2019/790 on copyright and related rights in the Digital Single Market), the U.S. Copyright Act of 1976, and Australia’s Copyright Act 1968 (Cth). Advanced technologies are also employed for content protection. By accessing, browsing, or using the website, you should indicate that you have read, fully understood, and voluntarily agree to be bound by the following terms and to comply with all applicable laws and regulations. If you do not agree to any of the following terms, please cease using this website immediately.</p>

        <h3 style="text-align:left;font-size:18px;font-weight:bold"> Copyright Statement</h4>
        <p style="text-align:left">All content on this website, including but not limited to images, text, website layout, and web design, unless otherwise noted, is owned by the Desert Oasis project team. Without prior written permission, no entity or individual may use any of the above content for commercial purposes. Unauthorised commercial use or illegal purposes infringing on our copyrights or impacting our reputation will be fully pursued by the law. For usage inquiries, please contact the relevant department in advance.</p>

        <h3 style="text-align:left;font-size:18px;font-weight:bold"> Use and Modification of Website Content</h2>
        <p style="text-align:left">Any entity or individual using this website’s content in forms such as reproduction, citation, extraction, or download must credit the author and indicate the source as ‘Desert Oasis: unveilinging Dunhuang’s Masterpieces’ or include a link to the website’s URL. Without written permission from Desert Oasis or other rights holders (i.e. artists), no modifications to the content are permitted.</p>

         <h3 style="text-align:left;font-size:18px;font-weight:bold"> Infringement Notice</h2>
        <p style="text-align:left">Some content on this website may have been obtained through our content partners, authorised artists, or free resources. If you believe your copyrighted work has been used in a way that infringes on your copyright, please provide proof of identity and ownership of the copyrighted material. We will address the issue promptly following applicable legal requirements.</p>

         <h3 style="text-align:left;font-size:18px;font-weight:bold"> Disclaimer of Warranties</h2>
        <p style="text-align:left">While we strive to provide accurate materials and content on this website, Desert Oasis does not guarantee the accuracy, completeness, sufficiency, or reliability of any materials or information, including but not limited to text, images, data, opinions, and suggestions. Desert Oasis makes no express or implied warranties concerning these materials or content, including but not limited to any warranties of rights, quality, or absence of computer viruses. We disclaim any liability for errors or omissions in this content. Furthermore, Desert Oasis does not make any statements, guarantees, or endorsements regarding any products, services, or information provided on the website. All products and services for sale are subject to their respective sales contracts and terms.</p>

        <h3 style="text-align:left;font-size:18px;font-weight:bold;"> Limitation of Liability</h2>
        <p style="text-align:left">The website Desert Oasis: unveilinging Dunhuang’s Masterpieces is not liable for any direct, indirect, or incidental damages arising from your use or inability to use the information on this site. Additionally, we are not liable for any legal issues that may arise if you violate the site’s terms or applicable laws. If this website requires a temporary suspension of services due to system maintenance or upgrades, prior notice will be given. Should services be interrupted due to hardware failure or other force majeure events, the website disclaims any liability for any inconvenience or losses incurred during the suspension period. The right to modify, update, and interpret this statement belongs solely to the project teams of Desert Oasis: unveilinging Dunhuang’s Masterpieces.</p>

        <p style="text-align:left">Hope you have a lovely tour at Desert Oasis!</p>
    </div>
        </div>
        <!-- 联系信息部分 -->
        <div class="address">
            <div class="col-md-4 address-grids wow fadeInLeft animated" data-wow-delay=".5s">
                <h4>Address: 999 Hucheng Huan Road, Shanghai</h4>
                
            </div>
            <div class="col-md-4 address-grids wow fadeInUp animated" data-wow-delay=".5s">
                <h4>Tel: (86) 1380 293 5782</h4>
                <p></p>
            </div>
            <div class="col-md-4 address-grids wow fadeInRight animated" data-wow-delay=".5s">
                <h4>E-mail: customersupport@desertoasis.art.cn</h4>
                <p><a href=""></a></p>
            </div>
            <div class="clearfix"> </div>
        </div>
       
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


</body>
</html>
