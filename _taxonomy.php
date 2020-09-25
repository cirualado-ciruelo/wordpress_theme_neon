<?php
/**
 * タクソノミー一覧ページを分岐します。
 *
 * 投稿タイプを判定し、投稿タイプごとにテンプレートを選択します。
 *
 * @package WordPress
 * @since 1.0.0
 */

if ( 'staff' === neon_the_post_data( 'name' ) ) {
	get_template_part( 'archive', 'staff' );
} else {
	get_template_part( 'index' );
}
