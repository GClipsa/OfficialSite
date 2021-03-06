<?php
	include "../php/getsoftwarecontent_mysql.php";
	require '../php/cookieverify.php';

	$come = getsoftwarecontent();
?>
<!doctype html>
<HTML> 
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../images/gclipsa.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/software_content_mainbody.css">
<link rel="stylesheet" type="text/css" href="../css/magnific-popup.css">

<TITLE>GClipsa Software: <?php echo $come['name']?></TITLE> 
</HEAD> 
<BODY> 
	<div class="bg"></div>
	<div class="wrapper">
		<div class="top_panel">
			<div class="tp_imgbox">
				<img class="tp_imgbox_pic" src="../svg/gc.svg" alt="gc.svg">
				<p class="tp_imgbox_text">GCLIPSA</p>
			</div>
			<div class="tp_menu">
				<div class="tp_menu_buff">
					<ul class="tp_menu_ul">
						<li><a href="../index.php">Main</a></li>
						<li><a href="news.php">News</a></li>
						<li class="sofware_li"><a href="software.php">Software</a><!-- pages/software.php -->
							<ul class="dropdown">
								<a href="software.php"><li>all projects</li></a>
								<a href="#"><li>For streams</li></a>
								<a href="#"><li>Bots & automation</li></a>
							</ul>
						</li>
						<?php if($username == null) { ?>
						<li><a href="identification.php">My cabinet</a></li>
						<?php 
						} 
						else { ?>
						<li><a href="mycabinet.php"><?php echo $username ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="tp_burg-lines">
				<span></span>
			</div>
		</div>
		<div class="rp_menu-burg" id="Rp_menu-burg">
			<ul class="rp_menu-burg_ul">
				<li><a href="../index.php">Main</a></li>
				<li><a href="news.php">News</a></li>
				<li class="mob_sofware_li"><a href="#">Software</a></li>
				<ul class="mob_dropdown">
					<li><a href="software.php">all projects</a></li>
					<li><a href="#">For streams</a></li>
					<li><a href="#">Bots & automation</a></li>
				</ul>
				<?php if($username == null) { ?>
				<li><a href="identification.php">My cabinet</a></li>
				<?php 
				} 
				else { ?>
				<li><a href="mycabinet.php"><?php echo $username ?></a></li>
				<?php } ?>
			</ul>
		</div>

		<div class="main_body">
			<div class="container1">
				<div class="welcome_box">
					<h1 class="welcome_text"><?php echo $come['name']?></h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="video_box">
							<div class="videopic">
								<div class="video_buffer">
									<iframe class="video_buffer_item"
											src="https://www.youtube.com/embed/<?php echo $come['video']?>"
							    			frameborder="0"
							    			allow="accelerometer; autoplay; fullscreen; encrypted-media; gyroscope; picture-in-picture"
							    			allowfullscreen>
									</iframe>
								</div>
							</div>
							<div class="devbox">
								<div class="dev_slider">
									<?php 	
										$pictures =  explode(",",$come['pictures']);
										foreach ($pictures as $img) 
										{
									?>
									<div class="dev_slider_item">
										<a class="popup" href="<?php echo $img ?>"><img src="<?php echo $img ?>" alt="p1.jpg"></a>
									</div>
									<?php  	
										} 
									?>
								</div>	
							</div>								
						</div>
						<div class="info_box">
							<div class="info_box_header">
								<h2 class="info_box_header_p"><?php echo $come['header']?></h2>
								<img class="undrln_small" src="../svg/underline.svg" alt="underline.svg">
							</div>
							<div class="text_info">
								<p class="text_info_p"><?php echo $come['data']?></p>
							</div>
							<div class="undrln_pic">
								<img class="undrln_big" src="../svg/underline.svg" alt="underline.svg">
							</div>
							<div class="downbuy">
								<div class="downbuy_pic">
									<img class="downbuy_pic_img" src="../svg/<?php echo $come['gettype']?>.svg" alt="<?php echo $come['gettype']?>.svg">
								</div>
								<p class="downbuy_text_p"><?php echo $come['gettype']?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="prefooter">
			<p></p>
		</div>
		<div class="footer">
			<p> &copy; GCLIPSA / 2021 </p>
		</div>
	</div>
</BODY>
<!-- JS -->
<script src="../js/jquery.js"></script>
<script src="../js/burgmenu.js"></script>
<script src="../js/slick.min.js"></script>
<script src="../js/soft_content_slider.js"></script>
<script src="../js/magnific-popup.min.js"></script>
<script src="../js/popup_image.js"></script>
</HTML>