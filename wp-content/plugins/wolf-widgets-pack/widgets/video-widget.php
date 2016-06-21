<?php
/*-----------------------------------------------------------------------------------*/
/*  Create the widget
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'wolf_video_widget_init' );

function wolf_video_widget_init() {

	register_widget( 'wolf_video_widget' );
	
}

/*-----------------------------------------------------------------------------------*/
/*  Widget Class
/*-----------------------------------------------------------------------------------*/
class wolf_video_widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*  Widget Setup
	/*-----------------------------------------------------------------------------------*/
	function wolf_video_widget() {

		// Widget settings
		$ops = array(
			'classname' => 'wolf_widget_video', 
			'description' => __( 'Display an embed video', 'wolf' )
		);

		// Create the widget
		$this->WP_Widget( 'wolf_widget_video', 'Wolf Video', $ops );
		
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Display Widget
	/*-----------------------------------------------------------------------------------*/
	function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		$desc = $instance['desc'];
		if ( $desc ) {
			echo '<p>';
			echo $instance['desc'];
			echo '</p>';
		}

		wolf_widget_video( $instance['embed'] );
		echo $after_widget;
	
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['desc'] = $new_instance['desc'];
		$instance['embed'] = $new_instance['embed'];

		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Displays the widget settings controls on the widget panel
	/*-----------------------------------------------------------------------------------*/
	function form( $instance ) {

			// Set up some default widget settings
			$defaults = array(
				'title' => 'Big Buck Bunny', 
				'embed' => '<iframe src="http://player.vimeo.com/video/61693087?title=0&byline=0&portrait=0&color=ABBF32" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', 
				'desc' => '' );
			$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Optional Text', 'wolf' ); ?>:</label>
			<textarea class="widefat"  id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" ><?php echo $instance['desc']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e( 'Embed code', 'wolf' ); ?>:</label>
			<textarea class="widefat"  id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>" ><?php echo $instance['embed']; ?></textarea>
		</p>
		<?php
	}

}

if ( ! function_exists( 'wolf_widget_video' ) ) :
/*-----------------------------------------------------------------------------------*/
/*	Video Function
/*-----------------------------------------------------------------------------------*/
function wolf_widget_video( $embed ) {
	echo '<div class="widget-video-container">' . $embed . '</div>';
}
endif;
?>