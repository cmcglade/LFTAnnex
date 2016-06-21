<?php
/*-----------------------------------------------------------------------------------*/
/*  Create the widget
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'wolf_recent_comments_widget_init' );

function wolf_recent_comments_widget_init() {

	register_widget( 'wolf_recent_comments_widget' );
	
}


/*-----------------------------------------------------------------------------------*/
/*  Widget class
/*-----------------------------------------------------------------------------------*/
class wolf_recent_comments_widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
	function wolf_recent_comments_widget() {

		// Widget settings
		$ops = array(
			'classname' => 'wolf_widget_recent_comments', 
			'description' => __( 'Recent Comments with avatar', 'wolf' )
		);

		// Create the widget
		$this->WP_Widget( 'wolf_widget_recent_comments', __( 'Wolf Recent Comments', 'wolf' ), $ops );
		
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/
	function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		wolf_recent_comments( $instance['count'] );
		echo $after_widget;
	
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update( $new_instance, $old_instance ){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Displays the widget settings controls on the widget panel
	/*-----------------------------------------------------------------------------------*/
	function form( $instance ){

			// Set up some default widget settings
			$defaults = array('title' => __( 'Last Reactions', 'wolf' ), 'count' => 3);
			$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of comments', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>">
		</p>
		
		<?php
	}

	

}

if ( ! function_exists( 'wolf_recent_comments' ) ) :
/*-----------------------------------------------------------------------------------*/
/*	Comments functions
/*-----------------------------------------------------------------------------------*/
function wolf_recent_comments( $nbr_comments = 3, $comment_len = 45 ) {
    	global $wpdb;

    	$comments = get_comments( apply_filters( 'widget_comments_args', array( 
	    		'number' => $nbr_comments, 
	    		'status' => 'approve', 
	    		'post_status' => 'publish' 
    		) 
    	) );

	if ( $comments ) {

		foreach ($comments as $comment) {
			$comment_text = wolf_widgets_pack_sample( $comment->comment_content, $comment_len );
			$comment_img_title_attr = wolf_widgets_pack_sample( $comment->comment_content, 250 );
			$comment_post_title = wolf_widgets_pack_sample( $comment->post_title, 35 );
			?>
			<article class="widget-entry">
				<a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ) . '#comment-' . $comment->comment_ID; ?>" class="widget-thumbnail-link">
					<?php echo get_avatar($comment->comment_author_email); ?>
				</a>
				<a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ) . '#comment-' . $comment->comment_ID; ?>">
					<?php echo wolf_get_author($comment); ?></a> <?php _e('said', 'wolf'); ?>
					<span class="comment-excerpt">
						"<?php echo $comment_text; ?>"
					</span> <?php _e('on', 'wolf'); ?> <a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID )) . '#comment-' . $comment->comment_ID; ?>" title="<?php _e( 'Read the comment', 'wolf' ); ?>">
						<?php echo $comment_post_title; ?></a>
				<div class="clear"></div>
			</article>
			<?php
		}

	} else {
		_e( 'No comment yet', 'wolf' );
	}
}
endif;

if ( ! function_exists( 'wolf_get_author' ) ) :
/**
 * Get the author name
 */
function wolf_get_author( $comment ) {
	
	$author ='';

	if ( empty( $comment->comment_author ) ) {
		$author = __( 'Anonymous', 'wolf' );
	} else {
		$author = $comment->comment_author;
	}
		
	return $author;
}
endif;
?>