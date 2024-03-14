<?php
/*
Plugin Name: WP Event Manager - Course Catalogue
Description: Course Catalogue Plugin from WP Event Manager.
Version: 1.0.0
Since: 1.0.0
Requires WordPress Version at least: 4.1
Author: WP Event Manager
Author URI: https://www.wp-eventmanager.com
Text Domain: wpem-course-catalogue
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

// Plugin Activation Hook
register_activation_hook( __FILE__,  'wpem_pluginslug_create_custom_table' );

function wpem_pluginslug_create_custom_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table1_name = $wpdb->prefix . 'wpem_custom_data';
    $sql1 = "CREATE TABLE $table1_name (
        id INT NOT NULL AUTO_INCREMENT,
        candidate_name VARCHAR(255) NOT NULL,
        location_country VARCHAR(255) NOT NULL,
        location_city VARCHAR(255) NOT NULL,
        age INT NOT NULL,
        gender VARCHAR(10) NOT NULL,
        years_of_experience INT NOT NULL,
        education VARCHAR(255) NOT NULL,
        industry VARCHAR(255) NOT NULL,
        job_title VARCHAR(255) NOT NULL,
        currency VARCHAR(10) NOT NULL,
        salary_no_bonus DECIMAL(10, 2) NOT NULL,
        yearly_bonus DECIMAL(10, 2) NOT NULL,
        user_ip VARCHAR(100) NOT NULL,
        date_time_entry DATETIME NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql1 );
	
}

// Define deactivation hook
register_deactivation_hook( __FILE__, 'wpem_pluginslug_deactivate' );

// Deactivation function
function wpem_pluginslug_deactivate() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'wpem_custom_data';

    $sql = "DROP TABLE IF EXISTS $table_name;";

    $wpdb->query( $sql );
}