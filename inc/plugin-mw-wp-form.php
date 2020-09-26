<?php
/**
 * MW WP Form functions
 *
 * =====================================
 *   QUICK ACCESS
 * =====================================
 *     管理者宛メールの内容をカスタマイズ
 *     自動返信メールの内容をカスタマイズ
 *     バリデーション設定
 * =====================================
 *
 * @package WordPress
 * @since 1.0.0
 * @subpackage Mw WP Form
 */

$is_mw_debug_mode = true;
$mw_mail_footer = '

-----------------------

' . home_url() . '

-----------------------';

/**
 * MW WP Form
 * フォーム内容をテンプレートファイル管理化
 *
 * @since 1.0.0
 */
function neon_mw_change_form_content( $content ) {
	$post    = neon_get_post_origin();
	$page_id = end( get_ancestors( $post->ID, 'page' ) );

	if ( ! $page_id ) {
		$page_id = $post->ID;
	}

	$page_src_file      = locate_template( 'pages/' . get_field( 'acf_page_system_id', get_page( $page_id, 'page' )->ID ) . '.php' );
	$page_src_line_list = file( $page_src_file );
	$page_src           = implode( "\n", $page_src_line_list );
	$page_src           = str_replace( ['<?php', '?>'], ['<!--', '-->'], $page_src );
	$content            = $page_src;

	return $content;
}

// 全てのフォームに設定
foreach ( get_posts( 'post_type=mw-wp-form' ) as $mw_wp_form_post ) {
	add_filter( 'mwform_post_content_mw-wp-form-' . $mw_wp_form_post->ID, 'neon_mw_change_form_content', 10, 2 );
}

/**
 * フォーム作成時の各設定項目の初期値を設定できるフィルターフック
 *
 * @param empty  $value
 * @param string $key
 * @return mixed
 */
function neon_mw_default_settings( $value, $key ) {

	// 入力画面URL
	if ( 'input_url' === $key ) {
		return '/form/';
	}

	// 確認画面URL
	if ( 'confirmation_url' === $key ) {
		return '/form/confirm/';
	}

	// 完了画面URL
	if ( 'complete_url' === $key ) {
		return '/form/thanks/';
	}

	// [管理者] Reply-to（メールアドレス）
	if ( 'admin_mail_reply_to' === $key ) {
		return '{メールアドレス}';
	}

	// [自動返信] Reply-to（メールアドレス）
	if ( 'mail_reply_to' === $key ) {
		return 'noreply@example.com';
	}

	// 自動返信メール
	if ( 'automatic_reply_email' === $key ) {
		return 'メールアドレス';
	}

	// 初期値を空にする項目
	if ( preg_match( '/mail_to|admin_mail_sender|admin_mail_reply_to|mail_sender/', $key ) ) {
		return '';
	}
}

add_filter( 'mwform_default_settings', 'neon_mw_default_settings', 10, 2 );

/**
 * フォーム設定：/contact.
 */
require_once neon_locate_inc( 'plugin-mw-wp-form-9' );
