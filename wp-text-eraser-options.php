<?php
/**
 * WP Text Eraser - Opções e configuração
 *
 * @package WP_Text_Eraser
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const WP_TEXT_ERASER_OPTION_KEY = 'wp_text_eraser_phrases';

/**
 * Registra a opção no WordPress.
 */
function wp_text_eraser_register_options() {
	register_setting(
		'wp_text_eraser_settings',
		WP_TEXT_ERASER_OPTION_KEY,
		array(
			'type'              => 'string',
			'sanitize_callback' => 'wp_text_eraser_sanitize_option',
		)
	);
}

/**
 * Sanitiza o valor salvo (texto com uma frase por linha).
 *
 * @param string $value Valor enviado pelo formulário.
 * @return string Texto sanitizado (uma frase por linha).
 */
function wp_text_eraser_sanitize_option( $value ) {
	$lines = wp_text_eraser_lines_to_array( $value );
	return implode( "\n", $lines );
}

/**
 * Retorna o texto bruto da opção (uma frase por linha).
 *
 * @return string
 */
function wp_text_eraser_get_phrases_raw() {
	return (string) get_option( WP_TEXT_ERASER_OPTION_KEY, '' );
}

/**
 * Retorna array de frases/palavras a serem removidas na renderização.
 *
 * @return array Lista de strings.
 */
function wp_text_eraser_get_phrases() {
	$raw = wp_text_eraser_get_phrases_raw();
	return wp_text_eraser_lines_to_array( $raw );
}
