<?php
/**
 * functions and definitions
 *
 * 用途に応じてファイルを分割しています。
 *
 * @package WordPress
 * @since 1.0.0
 */

// THEME_PATH設定
define( 'THEME_URL', get_template_directory_uri() );
define( 'THEME_IMG_URL', THEME_URL . '/assets/images' );
define( 'THEME_CSS_URL', THEME_URL . '/assets/css' );
define( 'THEME_JS_URL', THEME_URL . '/assets/js' );
define( 'THEME_LIB_URL', THEME_URL . '/assets/lib' );
define( 'HEADER', locate_template( 'header.php' ) );
define( 'FOOTER', locate_template( 'footer.php' ) );

// THEME_COLOR設定
define( 'THEME_COLOR', '#4083cd' );

/**
 * locate_templateの簡略化
 *
 * @param string  $dir inc/以下のディレクトリ名
 * @return string 読み込み先のパス
 * @since 1.0.0
 */
function neon_locate_inc( $dir = null ) {
	return locate_template( 'inc/' . $dir . '.php' );
}

/**
 * locate_templateの簡略化
 *
 * @param string $dir template-parts/以下のディレクトリ名
 * @return string 読み込み先のパス
 * @since 1.0.0
 */
function neon_locate_tmp( $dir = null ) {
	return locate_template( 'template-parts/' . $dir . '.php' );
}

/**
 * 余分なスペース削除
 *
 * @param  string $text
 * @return string
 * @since 1.0.0
 */
function neon_xtrim( $text ) {
	return preg_replace( '/(\t|\r\n|\r|\n)/s', '', $text );
}

/*
 * Require
 */

/**
 * Main functions.
 */
require_once neon_locate_inc( 'neon-main' );

/**
 * カスタム投稿定義.
 */
require_once neon_locate_inc( 'register-post' );

/**
 * 設定ファイル.
 */
require_once neon_locate_inc( 'config' );
