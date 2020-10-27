<?php
/**
 * Config file
 *
 * @package WordPress
 * @since 1.0.0
 */

/**
 * 各種設定
 *
 * @param string $key
 * @since 1.0.0
 */
function neon_config( $key ) {
	$page_simple_data = array();

	foreach ( get_posts( 'post_type=page&posts_per_page=-1' ) as $page_data ) {
		$system_page_id = get_field( 'acf_page_system_id', $page_data->ID );

		if ( $system_page_id ) {
			if ( get_post_ancestors( $page_data->ID ) ) {
				$post_name = '';

				foreach ( array_reverse( get_post_ancestors( $page_data->ID ) ) as $post_parent_id ) {
					$post_name .= get_post( $post_parent_id )->post_name . '_' . $page_data->post_name;
				}
			} else {
				$post_name = $page_data->post_name;
			}

			$page_simple_data[ $post_name ] = array(
				'label' => array(
					'ja' => get_the_title( $page_data->ID ),
					'en' => $post_name,
				),
				'link' => get_the_permalink( $page_data->ID ),
				'pid' => $system_page_id,
			);
		}
	}

	$menu = array(

		// page
		'access' => array(
			'label' => array(
				'ja' => "アクセスマップ",
				'en' => "access",
			),
			'link'  => neon_get_data_from_system_page_id( 'p1', 'link' ) . '#access',
		),

		// post
		'information' => array(
			'label' => array(
				'ja' => "お知らせ",
				'en' => "news",
			),
			'link'  => get_post_type_archive_link( 'post' ),
		),

		// taxonomy
		'blog_c_voice' => array(
			'label' => array(
				'ja' => "お客様の声",
				'en' => "voice",
			),
			'link'  => '',
		),

		// _blank
		'facebook' => array(
			'label' => "facebook",
			'link'  => ''
		),
		'instagram' => array(
			'label' => "instagram",
			'link'  => ''
		),
	);

	$menu = array_merge( $menu, $page_simple_data );

	$global_menu = array(
		$menu['about'],
		$menu['contact'],
		$menu['access'],
	);

	$args = array(
		'global_menu' => $global_menu,
		'menu' => $menu,
		'info_mail_address' => "info@example.com",
		'debug_mail_address' => "cirualado.ciruelo@gmail.com",
	);

	return $args[ $key ];
}

/**
 * wp_head()で読み込まれるファイルをカスタマイズ
 *
 * @since 1.0.0
 */
function neon_wp_head() {
	global $use_library;

	$time_stamp = time();

	// style
	wp_enqueue_style( 'lib', THEME_LIB_URL . '/lib.css', '', $time_stamp );
	// wp_enqueue_style( 'gfonts', '//fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,500,700&amp;display=swap', array(), null );
	wp_enqueue_style( 'main', THEME_CSS_URL . '/main.css', '', $time_stamp );

	// script
	// WP default jQury
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'lib', THEME_LIB_URL . '/lib.js', '', $time_stamp );
	wp_enqueue_script( 'main', THEME_JS_URL . '/main.js', '', $time_stamp, true );

	// ブロックコンテンツエディタのCSSを無効化
	if ( ! is_single() ) {
		wp_dequeue_style( 'wp-block-library' );
	}
}

add_action( 'wp_enqueue_scripts', 'neon_wp_head' );

/**
 * 表示件数変更
 *
 * @since 1.0.0
 */
function neon_change_posts_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	// if ( $query->is_archive() || $query->is_home() ) {
	// 	$query->set( 'posts_per_page', 1 );
	// }

	/*
	 * 検索結果
	 */
	if ( $query->is_search() ) {
		$ignore_post_list = array();
		$post_data        = get_posts( 'post_type=page&posts_per_page=-1' );

		// MW WP Formは除外
		foreach ( $post_data as $post ) {
			if ( '確認画面' === $post->post_title || '完了画面' === $post->post_title ) {
				$ignore_post_list[] = $post->ID;
			}
		}

		wp_reset_postdata();

		// 除外したい投稿タイプ指定
		$args_ignore_postType = get_posts(
			array(
				'post_type' => array(
					'hoge'
				),
				'posts_per_page' => -1
			)
		);

		foreach ( $args_ignore_postType as $post ) {
			$ignore_post_list[] = $post->ID;
		}

		wp_reset_postdata();

		$query->set( 'posts_per_page', 8 );
		$query->set( 'post__not_in', $ignore_post_list );
	}
}

add_action( 'pre_get_posts', 'neon_change_posts_query' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function neon_theme_support() {
	global $is_custom_seo;

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 630 );

	// Add custom image size used in Cover Template.
	// false
	add_image_size( 'Retina_15inch', 2880, 9999, false );
	add_image_size( 'Retina_13inch', 2560, 9999, false );
	add_image_size( 'Full_HD', 1920, 9999, false );
	add_image_size( 'Laptop', 1440, 9999, false );
	add_image_size( 'major_full_content', 1080, 9999, false );
	add_image_size( 'major_full_content@2x', 1080 * 2, 9999, false );

	$template_thumb_full           = 336;
	$template_thumb_fullx2         = 336 * 2;
	$template_thumb_size_01_full   = 258;
	$template_thumb_size_01_fullx2 = 258 * 2;

	$template_lite_S = 575 * 2;
	$template_lite_M = 767 * 2;
	$template_lite_L = 991 * 2;

	add_image_size( 'template_thumb_full', $template_thumb_full, 9999, false );
	add_image_size( 'template_thumb_full@2x', $template_thumb_fullx2, 9999, false );
	add_image_size( 'template_lite_S', $template_lite_S, 9999, false );
	add_image_size( 'template_lite_M', $template_lite_M, 9999, false );
	add_image_size( 'template_lite_L', $template_lite_L, 9999, false );

	// true
	// add_image_size( '000-111', 000, 111, true );

	// og
	add_image_size( 'og', 1200, 630, true );
	add_image_size( 'og@.5', 600, 315, true );
	add_image_size( 'og@.25', 300, 157, true );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );

	if ( ! neon_is_custom_meta() ) {

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	}
}

add_action( 'after_setup_theme', 'neon_theme_support' );

/**
 * プラグインのCSSをテンプレートで読み込まないようにする.
 *
 * @since 1.0.0
 */
function neon_deregister_styles() {
	// wp_deregister_style( 'mw-wp-form' );
}

add_action( 'wp_print_styles', 'neon_deregister_styles' );

/**
 * 特別なクラスの出し分け
 *
 * @since 1.0.0
 */
function neon_option_class( $class ) {
	global $post;

	$option_class = $class;

	if ( 'nn_posts_1__list' === $class ) {
		if ( get_option( 'show_on_front' ) && $post->ID == get_option( 'page_on_front' ) ) {
			$option_class .= ' -scroll_column';
		}
	}

	return $option_class;
}

/**
 * サイドバーを使用する箇所の条件分岐文
 *
 * @since 1.0.0
 */
function neon_is_sidebar() {

	// return if( $return ) :
	$return = 'blog' === neon_the_post_data( 'name' );

	return $return;
}

/**
 * コンテンツのHTMLを圧縮するかどうか
 *
 * @since 1.0.0
 */
function neon_is_content_compressed() {
	return true;
}

/**
 * metaタグのカスタマイズを使用するかどうか
 *
 * @since 1.0.0
 */
function neon_is_custom_meta() {
	return true;
}

/**
 * bodyタグに任意のクラスを付与
 *
 * @since 1.0.0
 */
function neon_add_class_body( $classes, $class = '' ) {
	global $post;

	// $classes[] = '-liquid';

	if ( ! is_front_page() ) {
		$classes[] = 'lower';
	}

	if ( 'post' === neon_get_current_post_type() ) {
		$classes[] = 'pt-' . get_post( get_option( 'page_for_posts' ) )->post_name;
	}

	if ( is_page() ) {
		if ( is_front_page() ) {
			$classes[] = 'p-home';
		} else {
			$classes[] = 'p-' . $post->post_name;
			$classes[] = 'par-' . get_page( $post->post_parent, 'page' )->post_name;
			$classes[] = 'anc-' . get_page( end( get_ancestors( $post->ID, 'page' ) ), 'page' )->post_name;
		}

		$system_page_id = get_field( 'acf_page_system_id', $post->ID );

		if ( $system_page_id ) {
			$classes[] = 'systemid-' . $system_page_id;
		}

		$anc_system_page_id = get_field( 'acf_page_system_id', get_page( end( get_ancestors( $post->ID, 'page' ) ), 'page' )->ID );

		if ( $anc_system_page_id ) {
			$classes[] = 'anc-systemid-' . $anc_system_page_id;
		}
	}

	if ( preg_match( '/f/', $system_page_id ) ) {
		$classes[] = 'pt-mw-wp-form';
	}

	if ( is_search() || is_archive() ) {
		$classes[] = 'acv';
	}

	if ( is_preview() ) {
		$classes[] = 'prv';
	}

	if ( is_archive() || is_single() ) {
		$classes[] = 'pt-' . neon_the_post_data( 'name' );
	}

	if ( is_single() ) {
		$taxonomy_all = get_post_taxonomies();
		$current_term_data_list = array();

		if ( $taxonomy_all ) {
			foreach ( $taxonomy_all as $taxonomoy ) {
				$term_object = get_the_terms( $post->ID, $taxonomoy );

				if ( $term_object ) {
					foreach ( $term_object as $term_data ) {
						$current_term_data_list[] = $term_data;
					}
				}
			}
		}

		foreach ( $current_term_data_list as $current_term_data ) {
			if ( false === strpos( $current_term_data->slug, '%' ) ) {
				$classes[] = 'term-' . $current_term_data->slug;
			}
		}
	}

	if ( true === strpos( $post->post_content, 'mwform_formkey' ) ) {
		$classes[] = 'pt-mw-wp-form';
	}

	return $classes;
}

add_filter( 'body_class', 'neon_add_class_body' );
