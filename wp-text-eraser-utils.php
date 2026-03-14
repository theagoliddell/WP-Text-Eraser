<?php
/**
 * WP Text Eraser - Funções utilitárias
 *
 * @package WP_Text_Eraser
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Converte texto de configuração (uma palavra/frase por linha) em array.
 *
 * @param string $text Texto com uma entrada por linha.
 * @return array Lista de strings não vazias, trimadas.
 */
function wp_text_eraser_lines_to_array( $text ) {
	if ( ! is_string( $text ) ) {
		return array();
	}
	$lines = preg_split( '/\r\n|\r|\n/', $text );
	$out   = array();
	foreach ( $lines as $line ) {
		$line = wp_text_eraser_sanitize_phrase( $line );
		if ( $line !== '' ) {
			$out[] = $line;
		}
	}
	return array_values( array_unique( $out ) );
}

/**
 * Sanitiza uma frase para uso na lista de exclusão.
 *
 * @param string $phrase Frase ou palavra.
 * @return string Frase sanitizada.
 */
function wp_text_eraser_sanitize_phrase( $phrase ) {
	$phrase = trim( (string) $phrase );
	return $phrase;
}

/**
 * Escapa para uso em padrão regex (delimitadores e caracteres especiais).
 *
 * @param string $str String a escapar.
 * @return string String segura para preg.
 */
function wp_text_eraser_escape_regex( $str ) {
	return preg_quote( $str, '/' );
}
