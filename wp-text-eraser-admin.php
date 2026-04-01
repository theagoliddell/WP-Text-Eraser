<?php
/**
 * WP Text Eraser - Adm panel and congifuration page
 *
 * @package WP_Text_Eraser
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inicializa o admin: menu e página de opções.
 */
function wp_text_eraser_admin_init() {
	add_action( 'admin_menu', 'wp_text_eraser_add_admin_menu' );
	add_filter( 'plugin_action_links_' . WP_TEXT_ERASER_PLUGIN_BASENAME, 'wp_text_eraser_plugin_links' );
}

/**
 * Add item in the menu config.
 */
function wp_text_eraser_add_admin_menu() {
	add_options_page(
		__( 'WP Text Eraser', 'wp-text-eraser' ),
		__( 'Text Eraser', 'wp-text-eraser' ),
		'manage_options',
		'wp-text-eraser',
		'wp_text_eraser_render_settings_page'
	);
}

/**
 * Add link "Configurações" na lista de plugins.
 *
 * @param array $links Links atuais.
 * @return array Links modificados.
 */
function wp_text_eraser_plugin_links( $links ) {
	$url = admin_url( 'options-general.php?page=wp-text-eraser' );
	$links[] = '<a href="' . esc_url( $url ) . '">' . __( 'Configurações', 'wp-text-eraser' ) . '</a>';
	return $links;
}

/**
 * Renderiza a página de configuração.
 */
function wp_text_eraser_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$raw = wp_text_eraser_get_phrases_raw();
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p><?php esc_html_e( 'Digite abaixo as palavras ou frases que não devem ser exibidas nas postagens. Uma por linha. O conteúdo no banco de dados não é alterado; apenas a exibição para o visitante é filtrada.', 'wp-text-eraser' ); ?></p>

		<form action="options.php" method="post">
			<?php
			settings_fields( 'wp_text_eraser_settings' );
			?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="wp_text_eraser_phrases"><?php esc_html_e( 'Palavras ou frases a ocultar', 'wp-text-eraser' ); ?></label>
					</th>
					<td>
						<textarea name="<?php echo esc_attr( WP_TEXT_ERASER_OPTION_KEY ); ?>" id="wp_text_eraser_phrases" class="large-text" rows="15" placeholder="<?php esc_attr_e( 'Uma palavra ou frase por linha...', 'wp-text-eraser' ); ?>"><?php echo esc_textarea( $raw ); ?></textarea>
						<p class="description"><?php esc_html_e( 'Cada linha será removida do conteúdo exibido. Linhas em branco são ignoradas.', 'wp-text-eraser' ); ?></p>
					</td>
				</tr>
			</table>
			<?php submit_button( __( 'Salvar alterações', 'wp-text-eraser' ) ); ?>
		</form>
	</div>
	<?php
}
