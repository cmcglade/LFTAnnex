<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 */
?>	
	
		</div><!-- .wrap -->
	</section><!-- section#main -->

	<?php wolf_bottom_holder(); ?>
	
	<?php wolf_footer_before(); ?>
	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php wolf_footer_start(); ?>
		
		<?php get_sidebar( 'footer_area' ); ?>

		<?php wolf_footer_end(); ?>

	</footer><!-- #colophon -->

	<div id="bottom-bar">
		<div class="wrap">
			<nav id="site-navigation-tertiary" class="navigation tertiary-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'bottom-menu', 'menu_class' => 'nav-menu-tertiary', 'fallback_cb'  => '' ) ); ?>
			</nav><!-- #site-navigation -->
			<?php wolf_site_info(); ?>
		</div>
	</div>
	
	<?php wolf_footer_after(); ?>
</div><!-- #page .hfeed .site -->


<?php wolf_body_end(); ?>
<?php wp_footer(); ?>
</body>
</html>