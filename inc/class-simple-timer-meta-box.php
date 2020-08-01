<?php
if( !class_exists('SimpleTimerMetaBox')) {
    /**
     * Simple Timer Meta Box Class
     *
     * @version    1.0.0
     */
    class SimpleTimerMetaBox
    {
        /**
         * Class constructor
         *
         * @method  __construct
         *
         * @since   1.0.0
         */
        public function __construct() {
            /**
             * Specify action hooks
             */
            add_action( 'add_meta_boxes', array( $this, 'add_plugin_meta_box' ) );
            add_action( 'save_post', array( $this, 'save_meta_box_values') );
        }

        /**
         * Add meta box
         *
         * @method  add_plugin_meta_box
         *
         * @since   1.0.0
         */
        public function add_plugin_meta_box()
        {
            add_meta_box(
                'simple-timer-options',
                __( 'Simple Timer' ),
                array( $this, 'render_plugin_meta_box' ),
                'post',
                'side',
                'high'
            );
        }

        /**
         * Render Meta Box
         *
         * @method  render_plugin_meta_box
         *
         * @param   Object                  $post
         *
         * @since   1.0.0
         */
        public function render_plugin_meta_box( $post )
        {
            $title = get_post_meta($post->ID, '_simple_timer_title', true);
            $hours = get_post_meta($post->ID, '_simple_timer_hours', true);
            ?>
            <table>
                <tr>
                    <td>
                        <label for="_simple_timer_title"><?php _e('Title'); ?></label>
                    </td>
                    <td>
                        <input type="text" name="_simple_timer_title" id="_simple_timer_title" placeholder="<?php _e('Please enter a title'); ?>" value="<?php esc_attr_e($title); ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="_simple_timer_hours"><?php _e('Number of Hours'); ?></label>
                    </td>
                    <td>
                        <input type="number" name="_simple_timer_hours" id="_simple_timer_hours" min="0" step="1" placeholder="<?php _e('Please enter the number hours'); ?>" value="<?php echo absint($hours); ?>">
                    </td>
                </tr>
            </table>
            <?php
        }

        /**
         * Callback to save the post meta value
         *
         * @method  save_meta_box_values
         *
         * @param   Int                   $post_id
         *
         * @since   1.0.0
         */
        public function save_meta_box_values( Int $post_id )
        {
            /**
             * Update meta post values for the title field
             */
            if( array_key_exists('_simple_timer_title', $_POST) ) {
                update_post_meta(
                    $post_id,
                    '_simple_timer_title',
                    sanitize_text_field( $_POST['_simple_timer_title'] )
                );
            }

            /**
             * Update meta post values for the hours field
             */
            if( array_key_exists('_simple_timer_hours', $_POST) ) {
                $oldHours = (int) get_post_meta($post_id, '_simple_timer_hours', true);
                $newHours = absint( $_POST['_simple_timer_hours'] );
                $newTime  = date("c", strtotime('+' . $newHours . ' hours'));
 
                /**
                 * Don't change the value of hours
                 * if only title is changed
                 */
                if( $oldHours !== $newHours ) {
                    update_post_meta(
                        $post_id,
                        '_simple_timer_hours',
                        absint($newHours)
                    );

                    update_post_meta(
                        $post_id,
                        '_simple_timer_scheduled_time',
                        sanitize_text_field($newTime)
                    );
                }
            }
        }
    }
}
