<?php
/*
You can overwrite any functions here.
Make sure that the function you want to overwrite is wrapped in the parent theme like this :

if ( ! functions_exists( 'the_function_name' ) ) :
	function the_function_name(){}
endif;

----------
Example :

if ( ! functions_exists( 'wolf_custom_function' ) ) :

function wolf_custom_function() {
	//your fancy code here
}

endif;
*/

//-------------------------------------------------------------------------

/**
 * You can overwrite the admin menu settings and update notification constants in this function
 */

// Display the theme update notice
define( 'WOLF_UPDATE_NOTICE', true );

// Display the link to the support forum
define( 'WOLF_SUPPORT_PAGE', true );

// Enable the customizer
define( 'WOLF_ENABLE_CUSTOMIZER', true );

// Have fun!


add_action('wp_footer', 'add_google_analytics');
function add_google_analytics() { ?>
 
<script>
Ê (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
Ê (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
Ê m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
Ê })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
Ê
Ê ga('create', 'UA-63280045-1', 'auto');
Ê ga('send', 'pageview');
Ê
</script>
 
<?php } ?>