<?php
class FlexityFeaturedPosts_Widget extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'flexityfeaturedposts_widget',
			__( 'Flexity Featured Posts', 'flexity' ),
			array(
				'classname'   => 'flexityfeaturedposts_widget',
				'description' => __( 'Featured Blog Posts' )
				)
			);

		load_plugin_textdomain( 'flexity', false, basename( dirname( __FILE__ ) ) . '/languages' );

	}

    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

    	extract( $args );

    	$title      = apply_filters( 'widget_title', $instance['title'] );
    	$posts_count    = intval($instance['posts_count']);

    	echo $before_widget;

    	if ( $title ) {
    		echo $before_title . $title . $after_title;
    	}

    	$feautured_query = new WP_Query( array(
    		'post_type'   => 'post',
    		'post_status' => 'publish',
    		'posts_per_page' => $posts_count,
    		'meta_key'       => 'my_meta_box_check_post',
    		'meta_value'     => 'on',
    		) );
    	if ($feautured_query->have_posts()) :

    		while ($feautured_query->have_posts()) : $feautured_query->the_post();
    	$category = get_the_category();
    	?>
    	<div class="blog-featured">
    		<p class="blog-featured-info">
    			<?php if (!empty($category)) : ?>
    				<?php foreach ($category as $key=>$cat) : ?>
    					<a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo $cat->name; ?></a><?php echo ($key+1<count($category)) ? ', ' : ''; ?>
    				<?php endforeach; ?>
    			<?php endif; ?>
    			<time datetime="<?php echo get_the_date('Y-m-d H:i'); ?>"><?php echo get_the_date(); ?></time>
    		</p>
    		<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    	</div>
	    <?php endwhile;
	    endif;
	    wp_reset_postdata();

	    echo $after_widget;

	}


    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {        

    	$instance = $old_instance;

    	$instance['title'] = strip_tags( $new_instance['title'] );
    	$instance['posts_count'] = strip_tags( $new_instance['posts_count'] );

    	return $instance;

    }

    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    

    	if (!empty($instance['title'])) {
    		$title      = esc_attr( $instance['title'] );
    	} else {
    		$title      = '';
    	}
    	if (!empty($instance['posts_count'])) {
    		$posts_count      = esc_attr( $instance['posts_count'] );
    	} else {
    		$posts_count      = '';
    	}
    	?>

    	<p>
    		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    	</p>
    	<p>
    		<label for="<?php echo $this->get_field_id('posts_count'); ?>"><?php _e('Posts Count:'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id('posts_count'); ?>" name="<?php echo $this->get_field_name('posts_count'); ?>" type="text" value="<?php echo $posts_count; ?>" />
    	</p>

    	<?php 
    }

}

/* Register the widget */
function flexity_feature_posts_widget_init () {
	register_widget( 'FlexityFeaturedPosts_Widget' );
}
add_action( 'widgets_init', 'flexity_feature_posts_widget_init');