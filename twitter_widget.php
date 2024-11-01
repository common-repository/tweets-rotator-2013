<?php

/**
 * Plugin Name: Tweets Rotator 
 * Plugin URI: http://themefantasy.com/twitter-tweets/
 * Description: A widget that allows you to display the tweets. Add your Twitter feed to your sidebar with this widget.
 * Version: 1.2
 * Author: Sabir Abdul Gafoor
 * Author URI: http://themefantasy.com
 
/*---------------------------------------------------------------------------------*/


add_action( 'widgets_init', 'sab_twitter_widgets' );

function sab_twitter_widgets() {
	register_widget( 'Sabby_Twitter' );
}



class Sabby_Twitter extends WP_Widget {



   function Sabby_Twitter() {

	   $widget_ops = array( 'description' => 'Add your Twitter feed to your sidebar with this widget.' );

       parent::WP_Widget(false, __( ' Sabby - Display The Tweets', 'sabby' ),$widget_ops);      

   }

   

   function widget($args, $instance) {  

    extract( $args );

   	$title = $instance['title'];

    $limit = $instance['limit']; if (!$limit) $limit = 5;

	$username = $instance['username'];

	$unique_id = $args['widget_id'];
	
	 $twitter_id=  $instance['twitter_id'];
$twitter_width=  $instance['twitter_width'];

	?>
 <?php
		 $url = plugins_url(); 
		 ?>
		<?php echo $before_widget; ?>

        <?php if ($title) echo $before_title.'<a href="http://twitter.com/'.$username.'">'.$title.'</a>'. $after_title; ?>

 <script>
      
  		
		  var config3 = {
				"id": '<?php echo $twitter_id; ?>',
				"domId": 'tweets',
				"maxTweets": <?php echo $limit; ?>,
				"dataOnly": true,
				"dateFunction": dateFormatter, 
				"customCallback": populateTpl,
				"lang": 'en',
				"enableLinks": true,
				"showUser": false,
				"showTime": true,
			};
			twitterFetcher.fetch(config3);


			
      
    </script>
   
        
        <div id="tweets" style="width: <?php echo $twitter_width;?>;float:left;overflow:hidden"></div>
   
	
		 

        <?php echo $after_widget; ?>

        
	

	<?php

   }



   function update($new_instance, $old_instance) {                

       return $new_instance;

   }



   function form($instance) {        

   

       $title = esc_attr($instance['title']);

       $limit = esc_attr($instance['limit']);

	   $username = esc_attr($instance['username']);
	   
	   $twitter_id=  esc_attr($instance['twitter_id']);
$twitter_width=  esc_attr($instance['twitter_width']);

       ?>

       <p>

	   	   <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'sabby' ); ?></label>

	       <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />

       </p>

       <p>

	   	   <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:', 'sabby' ); ?></label>

	       <input type="text" name="<?php echo $this->get_field_name( 'username' ); ?>"  value="<?php echo $username; ?>" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" />

       </p>

       <p>

	   	   <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'sabby' ); ?></label>

	       <input type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>"  value="<?php echo $limit; ?>" class="" size="3" id="<?php echo $this->get_field_id( 'limit' ); ?>" />



       </p>
       
        <p>

	   	   <label for="<?php echo $this->get_field_id( 'twitter_id' ); ?>"><?php _e( 'ID:', 'sabby' ); ?></label>

	       <input type="text" name="<?php echo $this->get_field_name( 'twitter_id' ); ?>"  value="<?php echo $twitter_id; ?>" class="" id="<?php echo $this->get_field_id( 'twitter_id' ); ?>" />



       </p>

 <p>

	   	   <label for="<?php echo $this->get_field_id( 'twitter_width' ); ?>"><?php _e( 'Width: (eg:200px)', 'sabby' ); ?></label>

	       <input type="text" name="<?php echo $this->get_field_name( 'twitter_width' ); ?>"  value="<?php echo $twitter_width; ?>" class="" id="<?php echo $this->get_field_id( 'twitter_width' ); ?>" />



       </p>

      <?php

   }

   

} 
function mytwitter_widget_init(){
	
	add_action('wp_enqueue_scripts', 'mytwitter_widget_load_css',20);
					
}


add_action( 'plugins_loaded', 'mytwitter_widget_init');

function mytwitter_widget_load_css(){
	
	
	wp_register_script( 'twitter-widget-js', plugins_url( 'includes/twitter.js', __FILE__ ), '', '', false );
	wp_enqueue_script('twitter-widget-js');
	wp_register_script( 'twitter-moment-js', plugins_url( 'includes/moment.js', __FILE__ ), '', '', false );
	wp_enqueue_script('twitter-moment-js');

	wp_register_style( 'twitter-widget-css', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_style('twitter-widget-css');

	
}
	
?>