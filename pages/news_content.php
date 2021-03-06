<?php
	include "../php/getnewscontent_mysql.php";
	require '../php/cookieverify.php';
	// require '../php/conndis_mysql.php';
	// var_dump($_SESSION['user']);
	// var_dump(session_id());

	$come = getnewscontent();
?>
<!doctype html>
<HTML> 
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../images/gclipsa.ico" type="image/x-icon">
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/news_content_mainbody.css">

<TITLE>GClipsa News: <?php echo $come['name']?></TITLE> 
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
					<h1 class="welcome_text"><?php echo $come['name'] ?></h1>
				</div>
				<div class="familiar_box">
					<div class="familiar_box_items">
						<div class="familiar_box_item_describe">
							<h2 class="describe_folus"><?php echo $come['header'] ?></h2>
							<div class="ungrline_small">
							<img class="undrln_small" src="../svg/underline.svg" alt="underline.svg"></div>
							<p class="describe_project"><?php echo $come['data'] ?></p>
							<div class="ungrline_big">
							<img class="undrln_big" src="../svg/underline.svg" alt="underline.svg"></div>
						</div>

						<div class="familiar_box_item_box">
							<div class="familiar_box_item_box_vidpic">

								<?php
								if ($come['picture'] != null && $come['video'] == null)
								{
								?>
								<img class="familiar_box_item_box_vidpic_item" src="<?php echo $come['picture'] ?>">
								<?php
								}
								else if($come['video'] != null)
								{
								?>
									<iframe class="familiar_box_item_box_vidpic_item"
										src="https://www.youtube.com/embed/<?php echo $come['video'] ?>"
						    			frameborder="0"
						    			allow="accelerometer; autoplay; fullscreen; encrypted-media; gyroscope; picture-in-picture"
						    			allowfullscreen>
									</iframe>
								<?php
								}
								?>
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
</HTML>