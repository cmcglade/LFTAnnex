<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 */
?>
<!DOCTYPE html> 
<html <?php language_attributes(); ?>>
<head> 
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wolf_meta_head(); ?>

	<!-- Title -->
	<title><?php wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<!-- RSS & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php  bloginfo( 'rss2_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
	
	<?php wolf_head(); ?>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js" type="text/javascript"></script>
	<![endif]-->

</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wolf_message_bar' ) ) wolf_message_bar(); ?>
<div id="top"></div><a id="top-arrow" class="scroll" href="#top"></a>
<?php wolf_body_start(); ?>
<div id="page" class="hfeed site">
	<nav id="primary-menu-container" role="navigation" class="site-navigation main-navigation clearfix">
		<div class="wrap">
			<?php 
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'menu_id'         => 'primary-menu',
				'menu_class' => 'nav-menu'
			)); 
			?>
		</div>
	</nav><!-- .site-navigation .main-navigation -->
	<?php wolf_header_before(); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="wrap">
			<div class="table-head">
				<?php wolf_logo(); ?>
			
				<div id="head-slider-container">
					<?php 
					if(function_exists('wolf_flexslider_show'))
						wolf_flexslider_show();
					?>
				</div>
			</div>
		</div>
		

	<?php
	/**
	* We display the feature header here
	*/
	if( is_front_page() )
		get_template_part( 'partials/feature', 'header' ); 
	?>

		
	</header><!-- #masthead .site-header -->

	<nav id="mobile-menu-container" role="navigation" class="site-navigation mobile-navigation">
		<ul id="mobile-menu-dropdown"><li><?php _e('Browse', 'wolf'); ?></li></ul>
		<?php 
		wp_nav_menu(array(
			'theme_location' => 'primary',
			'menu_id'         => 'mobile-menu',
		)); 
		?>
	</nav><!-- .site-navigation .mobile-navigation -->

	<?php wolf_header_after(); ?>

	<section id="main" class="site-main clearfix">
		<div class="wrap">
