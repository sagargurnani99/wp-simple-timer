<?php
// Exit if accessed directly.
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
global $wpdb;

/**
 * Delete all simple timer related entries in the postmeta table
 */
$wpdb->query('DELETE FROM ' . $wpdb->prefix . 'postmeta WHERE meta_key="_simple_timer_title" OR meta_key="_simple_timer_hours" OR meta_key="_simple_timer_scheduled_time"');
