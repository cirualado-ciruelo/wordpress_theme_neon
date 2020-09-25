<?php
/**
 * Theme functions
 *
 * =====================================
 *   INDEX
 * =====================================
 *     ○Admin
 *         ■
 *     ○Template
 *         ■
 *
 * @package WordPress
 * @since 1.0.0
 */

function hoge_hidden_contents( $content ) {
	$args = array(
		'hoge' => true,
	);

	return $args[ $content ];
}
