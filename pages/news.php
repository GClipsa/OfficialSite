<?php
	require "../php/getnumberlines_mysql.php";
	require "../php/getnews_func.php";
	require "../php/getalternativelinks.php";
	require '../php/cookieverify.php';
	require '../php/lang_identify_funcs.php';

	$ml_headers = lang_ml_header();
	$ml_header = $ml_headers[0];
	$ml_header_link = $ml_headers[1];
	$lang = $ml_headers[2];

	$colvo = 6;
	$result = getnumberlines("prenews");

	$colvopages = ceil(($result/$colvo));
	
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
<HTML lang = "<?php echo $lang ?>">
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
			<select class="lang_select" id="Lang_select">
					<option value="ru"<?php if($lang == "ru") echo "selected"?>>RU</option>
					<option value="en" <?php if($lang == "en") echo "selected"?>>EN</option>
			</select>
			<div class="tp_menu">
				<div class="tp_menu_buff">
					<ul class="tp_menu_ul">
						<li><a href="<?php echo $ml_header_link["tp_menu_main"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_main"] ?></a></li>
						<li><a href="<?php echo $ml_header_link["tp_menu_news"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_news"] ?></a></li>
						<li class="sofware_li"><a href="<?php echo $ml_header_link["tp_menu_services"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_services"] ?></a><!-- pages/software.php -->
							<ul class="dropdown">
								<a href="<?php echo $ml_header_link["tp_menu_allprojects"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><li><?php echo $ml_header["tp_menu_allprojects"] ?></li></a>
								<a href="<?php echo $ml_header_link["tp_menu_orderproject"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><li><?php echo $ml_header["tp_menu_orderproject"] ?></li></a>
								<!-- <a href="#"><li>Bots & automation</li></a> -->
							</ul>
						</li>
						<?php if($username == null) { ?>
						<li><a href="<?php echo $ml_header_link["tp_menu_identification"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_identification"] ?></a></li>
						<?php 
						} 
						else { ?>
						<li><a href="<?php echo $ml_header_link["tp_menu_mycabinet"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $username ?></a></li>
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
				<li><a href="<?php echo $ml_header_link["tp_menu_main"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_main"] ?></a></li>
				<li><a href="<?php echo $ml_header_link["tp_menu_news"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_news"] ?></a></li>
				<li class="mob_sofware_li"><a href="#"><?php echo $ml_header["tp_menu_services"] ?></a></li>
				<ul class="mob_dropdown">
					<li><a href="<?php echo $ml_header_link["tp_menu_allprojects"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_allprojects"] ?></a></li>
					<li><a href="<?php echo $ml_header_link["tp_menu_orderproject"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_orderproject"] ?></a></li>
					<!-- <li><a href="#">Bots & automation</a></li> -->
				</ul>
				<?php if($username == null) { ?>
					<li><a href="<?php echo $ml_header_link["tp_menu_identification"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_identification"] ?></a></li>
				<?php 
				} 
				else { ?>
				<li><a href="<?php echo $ml_header_link["tp_menu_mycabinet"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $username ?></a></li>
				<?php } ?>
				<li><select class="lang_select_burg" id="Lang_select_burg">
					<option value="ru"<?php if($lang == "ru") echo "selected"?>>LANGUAGE: RU</option>
					<option value="en" <?php if($lang == "en") echo "selected"?>>LANGUAGE: EN</option>
				</select></li>
			</ul>
		</div>

		<div class="main_body">
			<div class="container1">
				<div class="welcome_box">
					<h1 class="welcome_text">NEWS OF PROJECT GCLIPSA</h1>
				</div>

				<div class="familiar_box">
					<div class="familiar_box_items" id="Familiar_box_items">
						<?php
						foreach ($news as $come) 
						{

						?>
						<div class="familiar_box_item">
							<img class="familiar_box_item_pic" src="<?php echo $come['picture'] ?>" alt="<?php echo $come['picture'] ?>">
							<a href="<?php echo $come['news']."&lang=".$lang ?>"><div class="familiar_box_item_overlay">
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
			<p> &copy; GCLIPSA / 2021 </p>
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
<script src="../js/opacAnimating.js"></script>
<script src="../js/newschanger.js"></script>
<script src="../js/mod_url_params.js"></script>
<script src="../js/langchangelistener.js"></script>
</HTML>