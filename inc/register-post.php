<?php
/**
 * Custom Posts functions
 *
 * デフォルトの投稿機能のカスタマイズ・カスタム投稿を定義するファイルです。
 * 呼び出す箇所は一箇所です。[/Neon/functions.php]
 *
 * @package WordPress
 * @since 1.0.0
 */

/**
 * デフォルトの投稿の情報を書き換える
 *
 * @since 1.0.0
 */
function change_post_label( $args, $post_type ) {
	if ( 'post' === $post_type ) {
		$args ['label'] = 'ブログ';

		return $args;
	} else {
		return $args;
	}
}

add_filter( 'register_post_type_args', 'change_post_label', 1, 2 );

/**
 * カスタム投稿を定義
 *
 * @since 1.0.0
 */
function custom_post_init() {

	/*
	 * スタッフ
	 */
	$post_type_name = 'スタッフ';
	$post_type_slug = 'staff';
	$add_new_text   = '新しいスタッフを追加';

	register_post_type(
		$post_type_slug,
		array(
			'labels' => array(
				'name'          => $post_type_name,
				'add_new'       => $add_new_text,
				'add_new_item'  => $add_new_text,
				'search_items'  => $post_type_name . 'を検索',
			),
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
			),
			'rewrite' => array(
				'slug'       => $post_type_slug,
				'with_front' => false,
			),
			'has_archive'              => true,
			'public'                   => true,
			'show_ui'                  => true,
			'menu_position'            => 5,
			'show_in_rest'             => true,
			'cptp_permalink_structure' => '%post_id%',
		)
	);

	/*
	 * インフォメーション
	 */
	$post_type_name = 'インフォメーション';
	$post_type_slug = 'information';
	$add_new_text   = '新しいインフォメーションを追加';

	register_post_type(
		$post_type_slug,
		array(
			'labels' => array(
				'name'          => $post_type_name,
				'add_new'       => $add_new_text,
				'add_new_item'  => $add_new_text,
				'search_items'  => $post_type_name . 'を検索',
			),
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
			),
			'rewrite' => array(
				'slug'       => $post_type_slug,
				'with_front' => false,
			),
			'has_archive'              => true,
			'public'                   => true,
			'show_ui'                  => true,
			'menu_position'            => 5,
			'show_in_rest'             => true,
			'cptp_permalink_structure' => '%post_id%',
		)
	);

	// インフォメーションカテゴリ
	$taxonomy_slug         = '_cat';
	$taxonomy_label        = 'インフォメーションカテゴリ';
	$taxonomy_rewrite_slug = 'c';

	register_taxonomy(
		$post_type_slug . $taxonomy_slug,
		$post_type_slug,
		array(
			'hierarchical'      => true,
			'label'             => $taxonomy_label,
			'show_in_rest'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'rewrite' => array(
				'slug' => $taxonomy_rewrite_slug,
			)
		)
	);

	// インフォメーションタグ
	$taxonomy_slug         = '_tag';
	$taxonomy_label        = 'インフォメーションタグ';
	$taxonomy_rewrite_slug = 't';

	register_taxonomy(
		$post_type_slug . $taxonomy_slug,
		$post_type_slug,
		array(
			'hierarchical'      => false,
			'label'             => $taxonomy_label,
			'show_in_rest'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'rewrite' => array(
				'slug' => $taxonomy_rewrite_slug,
			)
		)
	);
}

// add_action( 'init', 'custom_post_init' );

/**
 * 新規投稿時のタイトルプレースホルダー変更
 *
 * @since 1.0.0
 */
function change_edit_title_placeholder( $title ) {
	if ( 'staff' === $_GET['post_type'] ) {
		return $title = 'スタッフ名を入力';
	}
}

// add_filter( 'enter_title_here', 'change_edit_title_placeholder' );
