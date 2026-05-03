<?php
/**
 * Plugin Name: WP Text Eraser
 * Plugin URI: https://theagoliddell.com/wp-text-eraser
 * Description: Remove palavras ou textos das postagens apenas na renderização, sem alterar o banco de dados. Configure uma lista de palavras/frases que não serão exibidas aos visitantes.
 * Version: 1.0.1
 * Author: Theago Liddell 4
 * Author URI: https://theagoliddell.com
 * License: GPL v2 or later
 * Text Domain: wp-text-eraser
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WP_TEXT_ERASER_VERSION', '1.0.0' );
define( 'WP_TEXT_ERASER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_TEXT_ERASER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

require_once WP_TEXT_ERASER_PLUGIN_DIR . 'wp-text-eraser-utils.php';
require_once WP_TEXT_ERASER_PLUGIN_DIR . 'wp-text-eraser-options.php';
require_once WP_TEXT_ERASER_PLUGIN_DIR . 'wp-text-eraser-filter.php';
require_once WP_TEXT_ERASER_PLUGIN_DIR . 'wp-text-eraser-admin.php';

add_action( 'init', 'wp_text_eraser_init' );

function wp_text_eraser_init() {
	wp_text_eraser_register_options();
	wp_text_eraser_add_content_filter();
	if ( is_admin() ) {
		wp_text_eraser_admin_init();
	}
}
