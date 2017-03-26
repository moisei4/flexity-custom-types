<?php
class FlexityCalendar_Widget extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'flexitycalendar_widget',
			__( 'Flexity Events Calendar', 'flexity' ),
			array(
				'classname'   => 'flexitycalendar_widget',
				'description' => __( 'Calendar with Events' )
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

    	echo $before_widget;

    	if ( $title ) {
    		echo $before_title . $title . $after_title;
    	}

		$events_query = new WP_Query( array(
			'post_type'   => 'events',
			'post_status' => 'publish',
			'order'               => 'DESC',
			'orderby'             => 'date',
			'posts_per_page'         => 50,
		) );
		if ($events_query->have_posts()) :
		?>
			<div class="blog-calendar" id="blog-calendar"></div>
			<script>
			function myDateFunction(id) {
				var date = jQuery("#" + id).data("date");
				var hasEvent = jQuery("#" + id).data("hasEvent");
				if (!hasEvent) {
					return false;
				}
				jQuery('#blog-calendar-cont').html(jQuery("#" + id).attr("title")).slideDown();
				return true;
			}
			var eventData = [
			<?php
			while ($events_query->have_posts()) : $events_query->the_post();
				$events_date = vp_metabox('flexity_meta_events.events_date');
        $events_cont = get_the_content();
        $events_cont = str_replace( array( "\n", "\r" ), array( "\\n", "\\r" ), $events_cont );
			?>
			{"date":"<?php echo $events_date?>","badge":false,"title":"<h4><?php the_title(); ?></h4> <?php echo $events_cont; ?>"},
			<?php endwhile; ?>
			];
			</script>
			<div class="blog-calendar-cont" id="blog-calendar-cont"></div>
		<?php endif;

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
    	?>

    	<p> 
    		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
    		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    	</p>
    	<?php 
    }

}

/* Register the widget */
function flexity_calendar_widget_init () {
	register_widget( 'FlexityCalendar_Widget' );
}
add_action( 'widgets_init', 'flexity_calendar_widget_init');