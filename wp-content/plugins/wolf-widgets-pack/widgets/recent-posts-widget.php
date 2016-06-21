<?php
/*-----------------------------------------------------------------------------------*/
/*  Create the widget
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'wolf_recent_posts_widget_init' );

function wolf_recent_posts_widget_init() {

	register_widget( 'wolf_recent_posts_widget' );
	
}

/*-----------------------------------------------------------------------------------*/
/*  Widget class
/*-----------------------------------------------------------------------------------*/
class wolf_recent_posts_widget extends WP_Widget {


	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/
	function wolf_recent_posts_widget() {

		// Widget settings
		$ops = array(
			'classname' => 'wolf_widget_recent_posts', 
			'description' => __( 'Display your recent posts by category, recents or populars', 'wolf' )
		);

		// Create the widget
		$this->WP_Widget( 'wolf_widget_recent_posts', __( 'Wolf Recent Posts with Thumbnails', 'wolf' ), $ops );
		
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/
	function widget( $args, $instance ) {
		
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$count = $instance['count'];
		$display_date = ( isset( $instance['display_date'] ) && $instance['display_date'] ) ? true : false;
		$display_comments = ( isset( $instance['display_comments'] ) && $instance['display_comments'] ) ? true : false;
		
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		wolf_post_types_widget( $count, $instance['display'], $instance['category'], $display_date, $display_comments );
		echo $after_widget;
	
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Update Widget
	/*-----------------------------------------------------------------------------------*/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['count'] = absint( $new_instance['count'] );
		$instance['display'] = $new_instance['display'];
		$instance['category'] = $new_instance['category'];
		$instance['display_date'] = ( isset( $new_instance['display_date'] ) ) ? true : false;
		$instance['display_comments'] = ( isset( $new_instance['display_comments'] ) ) ? true : false;

		return $instance;
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Displays the widget settings controls on the widget panel
	/*-----------------------------------------------------------------------------------*/
	function form( $instance ) {
		global $wolf_theme;
		
		// Set up some default widget settings
		$defaults = array(
			'title' => __( 'Recent Posts', 'wolf' ),
			'post-type' => 'post', 
			'count' => 3, 
			'display' => 'recent', 
			'category' => 'all',
			'display_date' => '',
			'display_comments' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

	?>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Post Category', 'wolf' ); ?>:</label><br>
			<select  name="<?php echo $this->get_field_name( 'category' ); ?>" id="<?php echo $this->get_field_id( 'category' ); ?>">
				<?php 
				$categories = get_categories();
				$categories_tab = array();
				
				foreach ( $categories as $category ) {
					$categories_tab['all'] = 'All';
					$categories_tab[$category->cat_ID] = $category->name;
				} 
		
				foreach ( $categories_tab as $k => $v ) : ?>
		
				<option value="<?php echo $k; ?>" <?php if ( $instance['category'] == $k) echo 'selected="selected"'; ?>><?php echo $v; ?></option>
				<?php endforeach; ?>
				
				
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['display_date'] ); ?> id="<?php echo $this->get_field_id( 'display_date' ); ?>" name="<?php echo $this->get_field_name( 'display_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'display_date '); ?>"><?php _e( 'Display date' ); ?></label><br />
			<input class="checkbox" type="checkbox" <?php checked( $instance['display_comments'] ); ?> id="<?php echo $this->get_field_id( 'display_comments' ); ?>" name="<?php echo $this->get_field_name( 'display_comments' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'display_comments '); ?>"><?php _e( 'Display comments count' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e( 'Display', 'wolf' ); ?>:</label><br>
			<select name="<?php echo $this->get_field_name( 'display' ); ?>" id="<?php echo $this->get_field_id( 'display' ); ?>">
				<option <?php if ( $instance['display'] == 'recent') echo 'selected="selected"'; ?>><?php _e( 'recent', 'wolf' ); ?></option>
				<option <?php if ( $instance['display'] == 'popular') echo 'selected="selected"'; ?>><?php _e( 'popular', 'wolf' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>">
		</p>
		<?php
	}

	

}

if ( ! function_exists( 'wolf_post_types_widget' ) ) :
/*-----------------------------------------------------------------------------------*/
/*	Function
/*-----------------------------------------------------------------------------------*/
function wolf_post_types_widget( $count = 5, $display, $category, $display_date, $display_comments ) {
	
	global $wpdb;
	
	$do_not_duplicate = array();
	
	if ( is_single() ) {
		global $wp_query;
		$do_not_duplicate[] = $wp_query->post->ID;
	}

	$args = array( 
		'post_type' => array( 'post' ) ,
		'posts_per_page' => $count,
		'ignore_sticky_posts' => 1,
		//'meta_key'    => '_thumbnail_id',
	);


	if ( $display == 'popular' ) {
		
		$args['orderby'] = 'comment_count';
	}
	

	if ( $category != 'all' ) {
		$args['category__in'] = $category;
	}

	if ( is_single() ) {
		$args['post__not_in'] = $do_not_duplicate;
	}

	$loop = new WP_Query($args);
	
	if ( $loop->have_posts() ):
			
		while ( $loop->have_posts()) : $loop->the_post();
			
			$format = get_post_format() ? get_post_format() : 'standard';
			$thumbnail = has_post_thumbnail() ? get_the_post_thumbnail( get_the_ID(), 'widget-thumb', array( 'title' => '') ) : '<img class="widget-default-thumb" src="' . WOLF_WIDGETS_PACK_URL . '/images/' . $format . '.jpg" width="80" height="80" alt="" title="">'
		?>
			<article class="widget-entry">
				<a href="<?php esc_url( the_permalink() ); ?>" class="widget-thumbnail-link">
					<?php echo $thumbnail; ?>
				</a>
				<span class="widget-entry-content">
					<span class="widget-entry-title">
						<a href="<?php esc_url( the_permalink() ); ?>" title="<?php printf( __( 'Permanent Link to %s', 'wolf' ), get_the_title() ); ?>">
							<?php echo wolf_widgets_pack_sample( get_the_title(), 40 ); ?>
						</a>
					</span>
					<?php if ( true == $display_date ) : ?>
						<span class="time"><?php echo get_the_date( get_option( 'date_format' ) ); ?></span>
					<?php endif; ?>
					<?php if ( true == $display_comments ) : ?>
						<span class="comment-count"><?php comments_popup_link(); ?></span>
					<?php endif; ?>
				</span>
			</article>
			<?php
		endwhile;
	endif;
	wp_reset_query();
}
endif;
?>