<?php
	require "../php/getnumberlines_mysql.php";
	require "../php/getnews_func.php";
	require "../php/getalternativelinks.php";
	require '../php/cookieverify.php';
	$colvo = 6;
	$result = getnumberlines("prenews");

	$colvopages = ceil(($result/$colvo)+0.4);
	
	if (isset($_SESSION['newspage']))
	{
		$numberpage = $_SESSION['newspage'];
	}
	else
	{
		$numberpage = 1;
		$_SESSION['newspage'] = 1;
	}
	$news = getnews_func($numberpage, $colvo);
	$altind = getalternativelinks("SELECT news FROM prenews");
	// var_dump($altind);
?>

<!doctype html>
<HTML> 
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">

<link rel="canonical" href="https://gclipsa.com/pages/news">

<title>Check news about GСlipsa software company</title> 
<meta property="og:title" content="Check news about GСlipsa software company">
<meta name="robots" content="index, follow"> 
<meta name="description" content="Fresh updates about  GClipsa - software developing company. Get information about our software - telegram bots, twitch manager and about our another software development projects.">
<meta property="og:description" content="Fresh updates about  GClipsa - software developing company. Get information about our software - telegram bots, twitch manager and about our another software development projects.">

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="../css/news_mainbody.css">


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
						<li><a href="../">Main</a></li>
						<li><a href="news">News</a></li>
						<li class="sofware_li"><a href="software">Software</a><!-- pages/software.php -->
							<ul class="dropdown">
								<a href="software"><li>all projects</li></a>
								<a href="#"><li>For streams</li></a>
								<a href="#"><li>Bots & automation</li></a>
							</ul>
						</li>
						<?php if($username == null) { ?>
						<li><a href="identification">My cabinet</a></li>
						<?php 
						} 
						else { ?>
						<li><a href="mycabinet"><?php echo $username ?></a></li>
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
				<li><a href="../index">Main</a></li>
				<li><a href="news">News</a></li>
				<li class="mob_sofware_li"><a href="#">Software</a></li>
				<ul class="mob_dropdown">
					<li><a href="software">all projects</a></li>
					<li><a href="#">For streams</a></li>
					<li><a href="#">Bots & automation</a></li>
				</ul>
				<?php if($username == null) { ?>
				<li><a href="identification">My cabinet</a></li>
				<?php 
				} 
				else { ?>
				<li><a href="mycabinet"><?php echo $username ?></a></li>
				<?php } ?>
			</ul>
		</div>

		<div class="main_body">
			<div class="container1">
				<div class="welcome_box">
					<h1 class="welcome_text">NEWS OF PROJECT GCLIPSA</h1>
				</div>

				<div class="familiar_box">
					<div class="familiar_box_items">
						<?php
						foreach ($news as $come) 
						{

						?>
						<div class="familiar_box_item">
							<img class="familiar_box_item_pic" src="<?php echo $come['picture'] ?>" alt="<?php echo $come['picture'] ?>">
							<a href="<?php echo $come['news'] ?>"><div class="familiar_box_item_overlay">
								<div class="familiar_box_item_overlay_text"><p><?php echo $come['description'] ?></p></div>
							</div></a>
						</div>
						<?php
						}
						?>
					</div>
				</div>

				<div class="changer">
					<div class="prev_news">
						<p class="prev_news_text">FIRST PAGE</p>
					</div>

					<div class="changer_left">
						<?php
						if ($numberpage <= 1) 
						{

						?>
						<img id="Left_pic"  style="pointer-events: none" class="changer_left_pic changer_pic" src="../svg/left.svg" alt="left.svg">
						<?php
						}
						else 
						{
						?>
						<img id="Left_pic" class="changer_left_pic changer_pic" src="../svg/left.svg" alt="left.svg">
						<?php	
						}
						?>

					</div>

					<div class="start_num nums">
						<p id="Start_num_page"><?php echo $numberpage ?></p>
					</div>

					<div class="dots_num nums">
						<p id="Dots_num_page">...</p>
					</div>

					<div class="end_num nums">
						<p id="End_num_page"><?php echo $colvopages ?></p>
					</div>

					<div class="changer_right">

						<?php
						if ($numberpage >= $colvopages) 
						{

						?>
						<img id="Right_pic" style="pointer-events: none" class="changer_right_pic changer_pic" src="../svg/right.svg" alt="right.svg">
						<?php
						}
						else 
						{
						?>
						<img id="Right_pic" class="changer_right_pic changer_pic" src="../svg/right.svg" alt="right.svg">
						<?php	
						}
						?>

					</div>

					<div class="next_news">
						<p class="next_news_text">LAST PAGE</p>
					</div>
				</div>
			</div>
		</div>

		<div class="prefooter">
			<p></p>
		</div>
		<div class="footer">
			<p> &copy; GClipsa / DOKERcom / 2021 </p>
		</div>
	</div>
</BODY>
<?php
foreach ($altind as $altinder) 
{
?>
<a href="<?php echo $altinder ?>"></a>
<?php
}
?>
<!-- JS -->
<script src="../js/jquery.js"></script>
<script src="../js/burgmenu.js"></script>
<script src="../js/newschanger.js"></script>
</HTML>