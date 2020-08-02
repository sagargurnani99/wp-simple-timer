<?php
/**
 * Plugin Name:       Simple Timer
 * Description:       This lets you embedd a simple countdown timer
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Sagar Gurnani
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       simple-timer
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

/**
 * Main class for SimpleTimer
 */
if( !class_exists('SimpleTimer') ) {
	class SimpleTimer {
		/**
		 * Class variable for the plugin path
		 *
		 * @var  String
		 */
		public $plugin_path;

		/**
		 * Class variable for the plugin url
		 *
		 * @var  String
		 */
		public $plugin_url;

		/**
		 * Class constructor
		 *
		 * @method  __construct
		 *
		 * @since   1.0.0
		 */
		public function __construct() {
			/**
			 * Assign values to the class members
			 */
			$this->plugin_path = plugin_dir_path( __FILE__ );
			$this->plugin_url  = plugins_url( null, __FILE__ );

			/**
			 * Plugin filter hooks
			 */
			add_filter( 'the_content', array( $this, 'append_timer_post_meta_data' ) );

			/**
			 * Plugin action hooks
			 */
			add_action( 'wp_enqueue_scripts', array( $this, 'plugin_enqueue' ) );
		}

		/**
		 * Callback to enqueue styles and/or scripts
		 *
		 * @method  enqueue_styles
		 *
		 * @since   1.0.0
		 */
		public function plugin_enqueue() {
			/**
			 * Enqueue the plugin style(s)
			 */
		    wp_enqueue_style( 'simple-timer', $this->plugin_url . '/inc/css/style.css', array(), time() );

		    /**
		     * Enqueue the plugin script(s)
		     */
		    wp_enqueue_script( 'simple-timer', $this->plugin_url . '/inc/js/script.js', array(), time(), true );
		}

		/**
		 * Append the simple timer HTML to the post content
		 *
		 * @method  append_timer_post_meta_data
		 *
		 * @param   String                       $content
		 *
		 * @return  String
		 *
		 * @since   1.0.0
		 */
		public function append_timer_post_meta_data( $content ) {
			$pluginPath = $this->plugin_path;

			/**
			 * Get the current post ID
			 *
			 * @var  Int
			 */
            $postId = get_the_ID();

            /**
             * Prepare the variables to pass in the view
             */
            $title = get_post_meta( $postId, '_simple_timer_title', true );
            $hours = get_post_meta( $postId, '_simple_timer_hours', true );
            $scheduledTime = get_post_meta( $postId, '_simple_timer_scheduled_time', true );

            /**
             * Get the content from the HTML view file
             */
            ob_start();
            include $pluginPath . 'template_parts/timer.php';
			$timer_html = ob_get_contents();
			ob_end_clean();

			/**
			 * Concatenate the file content to the post content
			 */
			$content .= $timer_html;

			/**
			 * Send the output back to the browser
			 */
	        echo $content;
		}
	}

	/**
	 * Instantiate Class object
	 *
	 * @var  Object
	 */
	$simpleTimer = new SimpleTimer;
}

/**
 * Include class for meta box related code
 */
if( is_admin() ) {
	include 'inc/class-simple-timer-meta-box.php';

	/**
	 * Instantiate Class object
	 *
	 * @var  Object
	 */
	$simpleTimerMetaBox = new SimpleTimerMetaBox;
}
