<?php
require 'php/conndis_mysql.php';
require 'php/cookieverify.php';
require 'php/lang_identify_funcs.php';

$ml_headers = lang_ml_header();
$ml_header = $ml_headers[0];
$ml_header_link = $ml_headers[1];
$lang = $ml_headers[2];

?>
<!doctype html>
<HTML lang = "<?php echo $lang ?>">
<HEAD> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="https://gclipsa.com/images/favicon.ico" type="image/x-icon">

<link rel="canonical" href="https://gclipsa.com/">

<title>GClipsa - high quality software products</title>
<meta property="og:title" content="GClipsa - high quality software products">
<meta name="robots" content="index, follow"> 
<meta name="description" content="Our software developing company will create high quality custom software, we have qualified  development group, that can make a good programs  for your needs.">
<meta property="og:description" content="Our software developing company will create high quality custom software, we have qualified  development group, that can make a good programs  for your needs.">

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/menu_panels.css">
<link rel="stylesheet" type="text/css" href="css/index_mainbody.css">

	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
   ym(73094083, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/73094083" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</HEAD> 
<BODY> 
	<div class="bg"></div>
	<div class="wrapper">
		<div class="top_panel">
			<div class="tp_imgbox">
				<img class="tp_imgbox_pic" src="svg/gc.svg" alt="gc.svg">
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
						<li><a href="pages/<?php echo $ml_header_link["tp_menu_news"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_news"] ?></a></li>
						<li class="sofware_li"><a href="pages/<?php echo $ml_header_link["tp_menu_services"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_services"] ?></a><!-- pages/software.php -->
							<ul class="dropdown">
								<a href="pages/<?php echo $ml_header_link["tp_menu_allprojects"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><li><?php echo $ml_header["tp_menu_allprojects"] ?></li></a>
								<a href="pages/<?php echo $ml_header_link["tp_menu_orderproject"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><li><?php echo $ml_header["tp_menu_orderproject"] ?></li></a>
								<!-- <a href="#"><li>Bots & automation</li></a> -->
							</ul>
						</li>
						<?php if($username == null) { ?>
						<li><a href="pages/<?php echo $ml_header_link["tp_menu_identification"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_identification"] ?></a></li>
						<?php 
						} 
						else { ?>
						<li><a href="pages/<?php echo $ml_header_link["tp_menu_mycabinet"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $username ?></a></li>
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
				<li><a href="pages/<?php echo $ml_header_link["tp_menu_news"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_news"] ?></a></li>
				<li class="mob_sofware_li"><a href="#"><?php echo $ml_header["tp_menu_services"] ?></a></li>
				<ul class="mob_dropdown">
					<li><a href="pages/<?php echo $ml_header_link["tp_menu_allprojects"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_allprojects"] ?></a></li>
					<li><a href="pages/<?php echo $ml_header_link["tp_menu_orderproject"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_orderproject"] ?></a></li>
					<!-- <li><a href="#">Bots & automation</a></li> -->
				</ul>
				<?php if($username == null) { ?>
					<li><a href="pages/<?php echo $ml_header_link["tp_menu_identification"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $ml_header["tp_menu_identification"] ?></a></li>
				<?php 
				} 
				else { ?>
				<li><a href="pages/<?php echo $ml_header_link["tp_menu_mycabinet"]."?".http_build_query(array_merge(['lang' => $lang]));?>"><?php echo $username ?></a></li>
				<?php } ?>
				<li><select class="lang_select_burg" id="Lang_select_burg">
					<option value="ru"<?php if($lang == "ru") echo "selected"?>>LANGUAGE: RU</option>
					<option value="en" <?php if($lang == "en") echo "selected"?>>LANGUAGE: EN</option>
				</select></li>
			</ul>
		</div>

		<div class="main_body" id="Main_body">
			<div class="container1">
				<div class="welcome_box">
					<h1 class="welcome_text">WELCOME TO PROJECT GCLIPSA</h1>
				</div>
				<div class="familiar_box">
					<div class="blockvideo">
						<div class="video">
							<iframe  id="iframe" class="video_frame" width="560" height="315"
							srcdoc="<style>html, body, a, img {display: block; width: 100%; height: 100%; margin: 0; padding: 0;}a:before, a:after {position: absolute; content: ''; left: 50%; top: 50%;} a:before {margin: -4.9% 0 0 -7%; background: rgba(31,31,30,.8); padding-top: 9.8%; width: 14%; border-radius: 16% / 27%;} a:after {margin: -1.9vw 0 0 -1vw; border: 2vw solid transparent; border-left: 3.8vw solid #fff;} a:hover:before {background: #c0171c;}</style><a href='https://www.youtube.com/embed/m19XhA2-9vA?mute=1&rel=0&autoplay=1'><img src='https://img.youtube.com/vi/m19XhA2-9vA/maxresdefault.jpg' srcset='https://img.youtube.com/vi/m19XhA2-9vA/mqdefault.jpg 320w, https://img.youtube.com/vi/m19XhA2-9vA/maxresdefault.jpg 1307w'></a>"
						    frameborder="0"
						    allow="accelerometer; autoplay; fullscreen; encrypted-media; gyroscope; picture-in-picture"
						    allowfullscreen>
							</iframe>
						</div>	
					</div>
					<div class="schema">
						<p class="schema_folus">FOLLOW US</p>
						<div class="ungrline">
						<img class="undrln_small" src="svg/underline.svg" alt="underline.svg"></div>
						<p class="schema_project">GClipsa - project of developing software.</p>
						<div class="ungrline">
						<img class="undrln_big" src="svg/underline.svg" alt="underline.svg"></div>
						<div class="schema_pic">
							<img class="schema_pic_img" src="svg/schema.svg" alt="schema.svg">
						</div>
					</div>
				</div>
				<div class="transfer1">
					<img class="transfer1_pic" src="svg/transfer.svg" alt="transfer.svg">
				</div>
			</div>
			<div class="container2">
				<div class="underwelc">
					<h2 class="underwelc_text">LAST NEWS AND ABOUT US</h2>
				</div>
				<div class="newsabout">
					<div class="lastnews">
						<div class="slider">
							<div class="slider_item">
								<a href="#"><img src="images/p1.jpg" alt="p1.jpg"></a>
							</div>
							<div class="slider_item">
								<img src="images/p2.jpg" alt="p2.jpg">
							</div>
							<div class="slider_item">
								<img src="images/p3.jpg" alt="p3.jpg">
							</div>
							<div class="slider_item">
								<img src="images/p4.jpg" alt="p4.jpg">
							</div>
						</div>						
					</div>
					<div class="about">
						<div class="about_buff">
							<p class="about_us schema_folus">ABOUT US</p>
							<div class="about_ungrline ungrline">
							<img class="about_undrln_pic  undrln_small" src="svg/underline.svg" alt="underline.svg"></div>

							<p class="about_us_text schema_project">There are not a lot of us, developers, but thanks to this we can 
				   			effectively develop a lot of projects.</p>
							<div class="about_ungrline ungrline">
							<img class="about_undrln_pic  undrln_big" src="svg/underline.svg" alt="underline.svg"></div>

							<p class="about_us_text schema_project">The GClipsa works every day, we create, update and 
							support our projects every day, seven days a week, and the quality
							of free products is comparable to many paid counterparts.</p>
							<div class="about_ungrline ungrline">
							<img class="about_undrln_pic  undrln_big" src="svg/underline.svg" alt="underline.svg"></div>

							<p class="about_us_text schema_project">	 We always try to provide the best quality products, 
							no matter if it's a free or a paid project - quality comes first!</p>
							<div class="about_ungrline ungrline">
							<img class="about_undrln_pic  undrln_big" src="svg/underline.svg" alt="underline.svg"></div>

							<p class="about_us_text schema_project">Grow with GClipsa!</p>
							<div class="about_ungrline ungrline">
							<img class="about_undrln_pic  undrln_small" src="svg/underline.svg" alt="underline.svg"></div>
						</div>
					</div>
				</div>
				<div class="transfer2">
					<img class="transfer2_pic" src="svg/transfer.svg" alt="transfer.svg">
				</div>
			</div>
			<div class="container3">
				<div class="underwelc1">
					<h2 class="underwelc_text1">DEVELOPERS</h2>
				</div>
				<div class="developers">
					<div class="devtext">
						<p class="devtext_irr schema_folus">IRREPLACEABLE</p>
						<div class="devtext_irr_ungrline">
						<img class="devtext_irr_ungrline_pic" src="svg/underline.svg" alt="underline.svg"></div>

						<p class="devtext_cre schema_project">Creative people who create what we can use for our needs.</p>
						<div class="devtext_cre_ungrline">
						<img class="devtext_cre_ungrline_pic" src="svg/underline.svg" alt="underline.svg"></div>
					</div>
					<div class="devbox">
						<div class="dev_slider">
							<div class="dev_slider_item">
								<img src="images/developer.png" alt="p1.jpg">
							</div>
							<div class="dev_slider_item">
								<img src="images/developer.png" alt="p1.jpg">
							</div>
							<div class="dev_slider_item">
								<img src="images/developer.png" alt="p1.jpg">
							</div>
							<div class="dev_slider_item">
								<img src="images/developer.png" alt="p1.jpg">
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
	<script type="text/javascript" id="cookieinfo"
	src="//cookieinfoscript.com/js/cookieinfo.min.js"
	data-bg="#645862"
	data-font-family="verdana"
	data-fg="#FFFFFF"
	data-link="#F1D600"
	data-cookie="CookieInfoScript"
	data-text-align="left"
    data-close-text="Got it!">
	</script>
</BODY>
<!-- JS -->
<script src="js/jquery.js"></script>
<script src="js/burgmenu.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/slider.js"></script>
<script src="js/mod_url_params.js"></script>
<script src="js/langchangelistener.js"></script>
</HTML>