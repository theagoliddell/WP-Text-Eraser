<?php
/**
 * WP Text Eraser - Filtro de conteúdo (remove palavras na renderização)
 *
 * @package WP_Text_Eraser
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adiciona o filtro de conteúdo ao the_content.
 */
function wp_text_eraser_add_content_filter() {
	add_filter( 'the_content', 'wp_text_eraser_filter_content', 10, 1 );
}

/**
 * Remove da string as palavras/frases configuradas.
 * Só altera a saída; o banco de dados não é modificado.
 *
 * @param string $content Conteúdo da postagem.
 * @return string Conteúdo com as frases removidas.
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
