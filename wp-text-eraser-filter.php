<?php
/**
 * WP Text Eraser - Content filters (remove word in the render)
 *
 * @package WP_Text_Eraser
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add the filter to the_content.
 */
function wp_text_eraser_add_content_filter() {
	add_filter( 'the_content', 'wp_text_eraser_filter_content', 10, 1 );
}

/**
 * Remove da string as palavras/frases configuradas.
 * Só altera a saída; the database is not modified.
 *
 * @param string $content post contents.
 * @return string Content with removed phrases.
 */
function wp_text_eraser_filter_content( $content ) {
	$phrases = wp_text_eraser_get_phrases();
	if ( empty( $phrases ) || ! is_string( $content ) ) {
		return $content;
	}

	foreach ( $phrases as $phrase ) {
		if ( $phrase === '' ) {
			continue;
		}
		$escaped = wp_text_eraser_escape_regex( $phrase );
		$content = preg_replace( '/' . $escaped . '/u', '', $content );
	}

	return $content;
}
