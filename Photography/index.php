<!DOCTYPE HTML>
<?php 
require_once ('template.php');
require_once ('personalization/Template_Personalization.php');
$t = new Template();
$p = new T_Personalization();
?>


<!-- DON'T TOUCH THIS SECTION -->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- END OF DON'T TOUCH -->

<!-- Website Title -->
<title><?php $p->print_title_page()?></title>
<!-- END OF Website Title -->

<!--  Website description - Change the 'content' section to whatever you want -->
<meta name="description" content="Replace this text with a summary of your website. i.e. John Smith - Web Developer and Photographer - Welcome to my portfolio website! Here you will find all of my latest work. Enjoy!">
<!-- END OF Website description -->

<!-- DON'T TOUCH THIS SECTION -->
<?php 
$t -> includes();
?>

</head>
<!-- END OF DON'T TOUCH -->

<body>
<div class="wrapper">
	<div id="top">
        <div id="logo">
            <img id="logoimage" src="images/logo.png" alt="logo">	<!-- Logo image -->
            <h1 id="logotitle"><?php $p->print_title_page()?></h1>	<!-- Logo text -->
        </div><!--/logo-->
    
        <!-- Navigation Start -->
        <?php $t->navigation();?>
        <!-- Navigation End -->
    </div><!--/top-->
    
    
    <hr/><!-- Horizontal Line -->
    
    
    <header>	<!-- Header Title Start -->
    	<h1><?php $p -> print_header1()?></h1>
        <h2>&ndash; <?php $p -> print_header2()?> &ndash;</h2>
    </header>	<!-- Header Title End -->
    <section id="slideshow">	<!-- Slideshow Start -->
        <div class="html_carousel">
			<div id="slider">
            
				<div class="slide">
					<img src="images/slideshow/sliderimage1.jpg" width="3000" height="783" alt="image 1"/><!-- Replace these images with your own but make sure they are 3000px wide and 783px high or the same ration -->
				</div><!--/slide-->
                
				<div class="slide">
					<img src="images/slideshow/sliderimage2.jpg" width="3000" height="783" alt="image 2"/><!-- Replace these images with your own but make sure they are 3000px wide and 783px high or the same ration -->
				</div><!--/slide-->
                
                <div class="slide">
					<img src="images/slideshow/sliderimage3.jpg" width="3000" height="783" alt="image 3"/><!-- Replace these images with your own but make sure they are 3000px wide and 783px high or the same ration -->
				</div><!--/slide-->
                
			</div><!--/slider-->
			<div class="clearfix"></div>
		</div><!--/html_carousel-->
    </section>	<!-- Slideshow End -->
    
    
    <aside id="about" class=" left"> <!-- Text Section Start -->
    	<h3><?php $p->print_about_me_title()?></h3><!-- Replace all text with what you want -->
    	<p><?php $p->print_about_me_text()?></p>
    </aside>
    <aside class="right">
    	<h3><?php $p->print_my_work_title()?></h3>
    	<p><?php $p->print_my_work_text()?></p>
    </aside>
    <div class="clearfix"></div> <!-- Text Section End -->
    
    
    <section id="work"> <!-- Work Links Section Start -->
	<?php 
	$t->printAlbums();
	?>  
        <div class="clearfix"></div>
    </section> <!-- Work Links Section End -->
    
    
    <section id="bottom"> <!-- Last Words Section Start -->
    	<h3><?php $p->print_bottom()?></h3>
    </section><!-- Last Words Section End-->
</div>

<!-- TO MAKE THE PHP FORM WORK, ALL YOU NEED TO DO IS OPEN UP THE FILE CALLED 'submitemail.php' AND CHANGE WHERE IT SAYS 'your email goes here' -->

<!-- DON'T TOUCH THIS SECTION -->

<footer id="footer">
	<div class="wrapper">
    	<section class="left">
    	<h4>Contact</h4>
            <div id="formwrap">
                <form method="post" id="submitform" action="submitemail.php" >
                            <input type="text" class="formstyle" title="Name" name="name" />
                            <input type="text" class="formstyle" title="Email" name="email" />
                            <textarea name="message" title="Message"></textarea>
                            <input class="formstyletwo" type="submit" value="Send">  
                </form>
            </div>
            <div id="error"></div>
        </section>

<!-- DON'T TOUCH THIS SECTION END -->        
        
    	<section class="right social"> <!-- Social Icons Start -->
		<a href="<?php $p->print_googleP()?>"><img class="icon" src="images/icons/google.png" width="32" height="32" alt="google"></a><!-- Replace with any 32px x 32px icons -->
        <a href="<?php $p->print_youtube()?>"><img class="icon" src="images/icons/youtube.png" width="32" height="32" alt="youtube"></a><!-- Replace with any 32px x 32px icons -->
        <a href="<?php $p->print_facebook()?>"><img class="icon" src="images/icons/facebook.png" width="32" height="32" alt="facebook"></a><!-- Replace with any 32px x 32px icons -->
        <a href="<?php $p->print_twitter()?>"><img class="icon" src="images/icons/twitter.png" width="32" height="32" alt="twitter"></a><!-- Replace with any 32px x 32px icons -->
        </section> <!-- Social Icons End -->
        <p>lets get social - </p>
        </section> <!-- Social Icons End -->
    </div>
    <div class="clearfix"></div>
</footer>

<!-- SLIDESHOW SCRIPT START -->
<script type="text/javascript">
$("#slider").carouFredSel({
	responsive	: true,
	scroll		: {
		fx			: "crossfade",
		easing		: "swing",
		duration	: 1000,
		
	},
	items		: {
		visible		: 1,
		height		: "27%"
	}
});
</script>
<!-- SLIDESHOW SCRIPT END -->
</body>
</html>

<!-- Thanks for looking at Liquid Gem! I hope you find it useful :) -->
