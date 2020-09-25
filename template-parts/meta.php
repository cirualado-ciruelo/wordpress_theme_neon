<?php
/**
 * タイトル・ディスクリプション設定
 *
 * プラグインなどを使用する場合はインクルードを無効化してください。
 * その際は、
 *
 *    add_theme_support( 'title-tag' );
 *
 * をfunctions.phpに記述してください。
 *
 * @package WordPress
 * @since 1.0.0
 */

$default_page_title  = get_the_title();
$general_site_name   = get_bloginfo( 'name' );
$general_catchphrase = get_bloginfo( 'description' );
$post_type_label     = neon_the_post_data();
$post_type           = neon_get_current_post_type();
$gqo                 = get_queried_object();

$common_page_keyword  = get_field( 'acf_site_meta_keywords', 'option' );
$common_page_og_image = get_field( 'acf_site_meta_og_image', 'option' );

$page_title          = get_field( 'acf_page_meta_title', $post->ID );
$page_description    = get_field( 'acf_page_meta_description', $post->ID );
$page_og_description = get_field( 'acf_page_meta_og_description', $post->ID );
$page_keyword        = get_field( 'acf_page_meta_keywords', $post->ID );

if ( is_tax() || is_category() || is_tag() ) {
	$term_description    = get_field( 'acf_page_meta_description_term', $gqo );
	$term_og_description = get_field( 'acf_page_meta_og_description_term', $gqo );
	$term_keyword        = get_field( 'acf_page_meta_keywords_term', $gqo );
	$is_term_index       = get_field( 'acf_page_meta_index_term', $gqo );
}

$post_type_keyword        = get_field( 'acf_post_type_meta_keywords_' . $post_type, 'option' );
$post_type_description    = get_field( 'acf_post_type_meta_description_' . $post_type, 'option' );
$post_type_og_description = get_field( 'acf_post_type_meta_og_description_' . $post_type, 'option' );
$post_type_og_image_id    = get_field( 'acf_post_type_meta_og_image_' . $post_type, 'option' );

// 独自投稿名が設定されていたらそれを使用
if ( get_field( 'acf_post_type_meta_title_' . $post_type, 'option' ) ) {
	$post_type_label = get_field( 'acf_post_type_meta_title_' . $post_type, 'option' );
}

/*
 * タイトル / OGタイトル
 */

// GET
if ( ! $default_page_title ) {
	$default_page_title = 'NO TITLE';
}

if ( is_404() ) {
	$meta_title = 'お探しのページが見つかりませんでした';
}

if ( is_page() ) {
	$post_ancestor_id_list = get_post_ancestors( $post->ID );
	$meta_title            = $default_page_title;
	$meta_og_title         = $meta_title;
	$parent_page_title     = '';

	// 親ページがあったらタイトルを右に追加していく
	foreach ( $post_ancestor_id_list as $post_ancestorid ) {
		$parent_page_title .= '｜' . get_page( $post_ancestorid )->post_title;
	}

	$meta_title .= $parent_page_title;
}

if ( is_archive() || is_home() ) {

	// 先頭に投稿名を出力
	$meta_title    = $post_type_label;
	$meta_og_title = $meta_title;

	if ( $paged ) {
		$meta_title = $meta_title . '：ページ' . $paged;
	}

	if ( is_tax() || is_category() || is_tag() ) {

		// 先頭にターム名を、右に投稿名を出力
		$meta_title    = $gqo->name . '｜' . $post_type_label;
		$meta_og_title = $gqo->name;
	}

	if ( is_date() ) {
		$query_var_year  = get_query_var( 'year' );
		$query_var_month = get_query_var( 'monthnum' );
		$query_var_day   = get_query_var( 'day' );

		// 先頭に（日付）の記事を出力
		if ( is_year() ) {
			$meta_title = $query_var_year . '年の記事';
		} elseif ( is_month() ) {
			$meta_title = $query_var_year . '年' . $query_var_month . '月の記事';
		} elseif ( is_day() ) {
			$meta_title = $query_var_year . '年' . $query_var_month . '月' . $query_var_day . '日の記事';
		}

		$meta_og_title = $meta_title;
		$meta_title    = $meta_title . '｜' . $post_type_label;
	}
}

if ( is_single() ) {
	if ( get_query_var( 'page' ) ) {
		$meta_title = $default_page_title . '：ページ' . get_query_var( 'page' ) . '｜' . $post_type_label;
	} else {
		$meta_title = $default_page_title . '｜' . $post_type_label;
	}

	$meta_og_title = $default_page_title;
}

if ( is_search() || ( is_home() && $_GET['s'] ) ) {

	// 先頭に検索結果を出力
	$meta_title = '[' . $_GET['s'] . ']の検索結果';

	if ( $wp_query->query_vars['post_type'] !== 'any' ) {

		// 先頭に検索結果、（）で投稿名を出力
		$meta_title = '[' . $_GET['s'] . ']の検索結果（' . $post_type_label . '）';
	}

	$meta_og_title = $meta_title;

	if ( $paged ) {
		$meta_title = $meta_title . '：ページ' . $paged;
	}
}

$meta_title    .= '｜' . $general_site_name;
$meta_og_title .= '｜' . $general_site_name;

if ( is_front_page() ) {
	$meta_title    = $general_site_name;
	$meta_og_title = $general_site_name;

	if ( $general_catchphrase ) {
		$meta_title .= '｜' . $general_catchphrase;
	}
}

// 固定・投稿ページに独自でタイトルを設定した場合、それを出力
if ( $page_title && ( is_single() || is_page() ) ) {
	$meta_title     = $page_title;
	$meta_og_title  = $meta_title;

	if ( get_query_var( 'page' ) ) {
		$meta_title = $meta_title . '：ページ' . get_query_var( 'page' );
	}
}

/*
 * ディスクリプション / OGディスクリプション
 */
if ( is_page() ) {
	$meta_description = $general_site_name . 'の' . get_the_title() . '。';
}

if ( is_single() ) {

	// 管理画面エディタに内容がある場合
	if ( $post->post_content ) {
		$meta_description = $post->post_content;
	}
}

if ( is_archive() || is_home() ) {

	// サイト名、投稿名を出力
	$meta_description = $general_site_name . 'の' . $post_type_label . '。';

	// 投稿詳細情報に独自でディスクリプションを設定した場合、それを出力
	if ( $post_type_description ) {
		$meta_description = $post_type_description;
	}

	// 投稿詳細情報に独自でOGディスクリプションを設定した場合、それを出力
	if ( $post_type_og_description ) {
		$meta_og_description = $post_type_og_description;
	} else {
		$meta_og_description = $meta_description;
	}

	if ( is_tax() || is_category() || is_tag() ) {
		if ( $term_description ) {
			$meta_description = $term_description;
		} else {
			$meta_description = $general_site_name . 'の' . $gqo->name . '。';
		}
	}

	if ( is_date() ) {
		$query_var_year  = get_query_var( 'year' );
		$query_var_month = get_query_var( 'monthnum' );
		$query_var_day   = get_query_var( 'day' );

		// 先頭に（日付）の記事を出力
		if ( is_year() ) {
			$page_date = $query_var_year . '年';
		} elseif ( is_month() ) {
			$page_date = $query_var_year . '年' . $query_var_month . '月';
		} elseif ( is_day() ) {
			$page_date = $query_var_year . '年' . $query_var_month . '月' . $query_var_day . '日';
		}

		$meta_description    = $general_site_name . 'の' . $page_date . 'の' . $post_type_label . 'アーカイブ。';
		$meta_og_description = $meta_description;
	}
}

if ( $_GET['s'] ) {

	// 検索結果を出力
	$meta_description = $general_site_name . ' 検索結果 [' . $_GET['s'] . ']';

	if ( 'any' !== $wp_query->query_vars['post_type'] ) {

		// 投稿ページなら投稿名も出力
		$meta_description = $general_site_name . ' 検索結果 [' . $_GET['s'] . ']（' . $post_type_label . '）';
	}

	$meta_og_description = $meta_description;
}

if ( is_single() || is_page() ) {

	// 固定・投稿ページに独自でディスクリプションを設定した場合、それを出力
	if ( $page_description ) {
		$meta_description = $page_description;
	}

	// 固定・投稿ページに独自でOGディスクリプションを設定した場合、それを出力
	if ( $page_og_description ) {
		$meta_og_description = $page_og_description;
	} else {
		$meta_og_description = $meta_description;
	}
}

// タームに独自でOGディスクリプションを設定した場合、それを出力
if ( ( is_tax() || is_category() || is_tag() ) ) {
	if ( $term_og_description ) {
		$meta_og_description = $term_og_description;
	} else {
		$meta_og_description = $meta_description;
	}
}

// 余分な文字列を除去
$replace_str_list = array(
	"\r\n",
	"\r",
	"\n",
	"	",
	'"',
);
$meta_description    = str_replace( $replace_str_list, '', strip_tags( $meta_description ) );
$meta_og_description = str_replace( $replace_str_list, '', strip_tags( $meta_og_description ) );

// 200文字以上ならカット:STEP3
if ( mb_strlen( $meta_description, 'utf-8' ) > 300 ) {
	$meta_description = mb_substr( $meta_description, 0, 300 ) . '...';
}

// OGディスクリプションが50文字以上なら50文字にカット
if ( mb_strlen( $meta_og_description, 'utf-8' ) > 100 ) {
	$meta_og_description = mb_substr( $meta_og_description, 0, 100 ) . '...';
}

/*
 * キーワード
 */
$meta_keyword = '';

// 共通キーワードがあればそれを使用
if ( $common_page_keyword ) {
	$meta_keyword = $common_page_keyword . ',';
}

// タイトルを追加
if ( is_page() && ! is_front_page() ) {
	$meta_keyword .= $post->post_title . ',';
}

// 親ページのタイトルを追加
if ( is_page() ) {
	$post_ancestor_id_list = get_post_ancestors( $post->ID );

	foreach ( $post_ancestor_id_list as $post_ancestorid ) {
		$meta_keyword .= get_page( $post_ancestorid )->post_title . ',';
	}
}

if ( is_archive() || is_home() ) {
	// 投稿名を追加
	$meta_keyword .= $post_type_label . ',';

	if ( $post_type_keyword ) {
		$meta_keyword .= $post_type_keyword . ',';
	}

	if ( is_tax() || is_category() || is_tag() ) {

		// ターム名を追加
		// デフォルトキーワードを入れたくない場合は'.='の'.'を外す
		$meta_keyword .= $gqo->name . ',';

		if ( $term_keyword ) {
			$meta_keyword .= $term_keyword . ',';
		}
	}

	if ( is_date() ) {

		// 日付を追加
		$query_var_year  = get_query_var( 'year' );
		$query_var_month = get_query_var( 'monthnum' );
		$query_var_day   = get_query_var( 'day' );

		if ( is_year() ) {
			$meta_keyword = $query_var_year . '年の記事';
		} elseif ( is_month() ) {
			$meta_keyword = $query_var_year . '年' . $query_var_month . '月の記事';
		} elseif ( is_day() ) {
			$meta_keyword = $query_var_year . '年' . $query_var_month . '月' . $query_var_day.'日の記事';
		}
	}
}

if ( is_single() ) {

	// ターム名を追加
	$meta_keyword .= $post_type_label . ',';
	$taxonomy_all  = get_post_taxonomies();

	if ( $taxonomy_all ) {
		foreach ( $taxonomy_all as $taxonomy ) {
			$term_object = get_the_terms( $post->ID, $taxonomy );

			if ( $term_object ) {
				foreach ( $term_object as $term_data ) {

					// デフォルトキーワードを入れたくない場合は'.='の'.'を外す
					$meta_keyword .= $term_data->name . ',';
				}
			}
		}
	}
}

// 固定・投稿ページに独自でキーワードを設定した場合、それを出力
if ( $page_keyword ) {
	$meta_keyword .= $page_keyword . ',';
}

/*
 * OG画像
 */
$meta_og_img_url = '';

// 共通OG画像があればそれを画像idに使用
if ( $common_page_og_image ) {
	$page_og_img_id = $common_page_og_image;
}

if ( $post_type_og_image_id ) {
	if ( is_home() || is_archive() || is_single() ) {
		if ( 'any' !== $wp_query->query_vars['post_type'] || is_single() ) {
			$page_og_img_id = $post_type_og_image_id;
		}
	}
}

if ( is_single() || is_page() ) {

	// アイキャッチがあればそれを画像idに使用
	if ( has_post_thumbnail() ) {
		$page_og_img_id = get_post_thumbnail_id( $post->ID );
	}
}

$page_og_img_size = 'og';
$page_og_img_src  = wp_get_attachment_image_src( $page_og_img_id, $page_og_img_size );

if ( 1200 === $page_og_img_src[1] && 630 === $page_og_img_src[2] ) {
	$meta_og_img_url = $page_og_img_src[0];
} else {
	$page_og_img_size = 'og@.5';
	$page_og_img_src  = wp_get_attachment_image_src( $page_og_img_id, $page_og_img_size );

	if ( 600 === $page_og_img_src[1] && 315 === $page_og_img_src[2] ) {
		$meta_og_img_url = $page_og_img_src[0];
	} else {
		$page_og_img_size = 'og@.25';
		$page_og_img_src  = wp_get_attachment_image_src( $page_og_img_id, $page_og_img_size );

		if ( 300 === $page_og_img_src[1] && 157 === $page_og_img_src[2] ) {
			$meta_og_img_url = $page_og_img_src[0];
		} else {
			$meta_og_img_url = wp_get_attachment_image_src( $page_og_img_id, 'full' )[0];
		}
	}
}

/*
 * URL
 */
$server_url = ( empty( $_SERVER['HTTPS']) ? 'http://' : 'https://' ) . $_SERVER['HTTP_HOST'];

// 検索結果ページならパラメータ付きでURLを返す
if ( $_GET['s'] ) {
	$meta_url = $server_url . $_SERVER['REQUEST_URI'];

// パラメーターを使用してページを作る場合は個別に指定する必要がある
// } elseif ( is_singular( 'hoge' ) ) {
// 	$meta_url = '';
} else {

	// 検索結果ページ以外ならパラメータ付きのURLはパラメータを除外してURLを返す
	$meta_url = $server_url . parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
}

/*
 * NOINDEX設定
 */

// NOINDEXに追加するページのタイトル
$ignore_index_list = array(
	'確認画面',
	'完了画面',
);
$noindex_tag = '	<meta name="robots" content="noindex,follow">
	
	';

if (
	 is_404()
	 || ( isset( $_GET['s'] ) && empty( $_GET['s'] ) )
	 || ! (
	        ! ( isset( $_GET['s'] ) && empty( $_GET['s'] ) )
	          && have_posts()
	      )
	 || is_date() || is_singular( 'hoge' )
) :
	echo $noindex_tag;
elseif ( in_array( $default_page_title, $ignore_index_list ) ) :
	echo $noindex_tag;
elseif ( ( is_tax() || is_category() || is_tag() ) && ! $is_term_index ) :
	echo $noindex_tag;
else :

	?>
	<meta name="description" content="<?php echo $meta_description; ?>">
	<meta name="keywords" content="<?php echo $meta_keyword; ?>">
	<?php

	echo "\n";

endif;

	?>
	<title><?php echo $meta_title; ?></title>

	<meta property="og:title" content="<?php echo $meta_og_title; ?>">
	<meta property="og:type" content="<?php echo neon_is_og_type(); ?>">
	<meta property="og:description" content="<?php echo $meta_og_description; ?>">
	<meta property="og:url" content="<?php echo $meta_url; ?>">
	<meta property="og:image" content="<?php echo $meta_og_img_url; ?>">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:image:src" content="<?php echo $meta_og_img_url; ?>">
	<meta name="twitter:domain" content="<?php echo $_SERVER['HTTP_HOST']; ?>">
