<?php
/*
Plugin Name: MNA API
Plugin URI: www.mnakhtar.com
Author: Nur Akhtar
Description: AIt is a private plugin to work as api.
Version: 1.0

*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

// Include the custom API file
require_once plugin_dir_path( __FILE__ ) . 'includes/api-endpoints.php';
