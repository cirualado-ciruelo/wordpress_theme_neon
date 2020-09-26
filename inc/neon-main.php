<?php
/**
 * Admin functions
 *
 * 管理画面に関するメソッドを管理するファイルです。
 * 呼び出す箇所は一箇所です。[/Neon/functions.php]
 *
 * =====================================
 *   INDEX
 * =====================================
 *     ○Admin
 *         ■マイナー設定
 *         ■装飾
 *         ■カスタマイズ
 *         ■余計な機能を除外
 *         ■CSS / JS
 *         ■プラグイン
 *     ○Template
 *         ■Get
 *         ■Is
 *         ■Sanitize
 *         ■The
 *         ■Remove
 *         ■Add
 *         ■Wp
 *
 * @package WordPress
 * @since 1.0.0
 */

/*
 * ○Globals
 */
$args_all_post_type = array(
	'public'   => true,
	'_builtin' => false,
);

/*
 * ○Admin
 */

/*
 * ■マイナー設定
 */

/**
 * 管理画面にファビコン表示（ルート指定できない場合）
 *
 * @since 1.0.0
 */
function neon_set_favicon_admin() {
	echo '<link rel="shortcut icon" href="' . THEME_IMG_URL . '/favicon.ico">';
}

// add_action('admin_head', 'set_favicon_admin');

/**
 * ダッシュボードに投稿数表示
 *
 * @since 1.0.0
 */
function neon_show_custom_post_num_dashboard( $items ) {
	global $args_all_post_type;

	$post_type_all = get_post_types( $args_all_post_type );

	foreach ( $post_type_all as $post_type ) {
		$post_count = wp_count_posts( $post_type );

		if (
			 $post_count &&
			 $post_count->publish &&
			 ! (
			 	 'post' === $post_type ||
			 	 'attachment' === $post_type
			 )
		) {
			$post_count = number_format_i18n( $post_count->publish ) . ' 件';
			$post_label = get_post_type_object( $post_type )->label;
			$items[]    = sprintf(
				'<a href="edit.php?post_type=%1$s" class="%1$s-count"><b>%3$s</b>：%2$s</a>',
				$post_type,
				$post_count,
				$post_label
			);
		}
	}

	return $items;
}

add_filter( 'dashboard_glance_items', 'neon_show_custom_post_num_dashboard' );

/**
 * ダッシュボードに投稿アイコン表示
 *
 * @since 1.0.0
 */
function neon_show_custom_post_icon_dashboard() {
	global $args_all_post_type;

	$post_type_all = get_post_types( $args_all_post_type );
	$dashicon      = '';

	foreach ( $post_type_all as $post_type ) {
		$dashicon .= '#dashboard_right_now .' . get_post_type_object( $post_type )->name . '-count:before {
			content: "\f109";
		}';
	}

	echo '<style>' . neon_xtrim( $dashicon ) . '</style>';
}

add_action( 'admin_print_styles', 'neon_show_custom_post_icon_dashboard' );

/**
 * ダッシュボードのアクティビティににカスタム投稿を追加
 *
 * @since 1.0.0
 */
function neon_add_custom_posts_column_dashactivity( $args ) {
	global $args_all_post_type;

	$post_type_all = get_post_types( $args_all_post_type );

	foreach ( $post_type_all as $post_type ) {
		$args['post_type'] = $post_type;
	}

	$args['post_type'] = ['page'];

	if ( 'publish' === $args['post_status'] ) {
		$args['posts_per_page'] = 20;
	}

	return $args;
}

add_filter( 'dashboard_recent_posts_query_args', 'neon_add_custom_posts_column_dashactivity', 10, 1 );

/*
 * ■装飾
 */

/**
 * ログイン画面装飾
 *
 * @since 1.0.0
 */
function neon_customize_login_page() {

?>
	<style>
		.login {
			background: url(<?php echo THEME_URL; ?>/inc/assets/images/bg_login.jpg) no-repeat center;
			background-size: cover;
		}
		.login #login {
			width: 100%;
			max-width: 500px;
			padding-left: 20px;
			padding-right: 20px;
		}
		.login #login h1 a {
			width: 300px;
			height: 84px;
			background: url(<?php echo THEME_URL; ?>/inc/assets/images/logo_login.svg) no-repeat center;
			background-size: contain;
		}
		#login_error,
		.login #login .message {
			border-left: 4px solid <?php echo THEME_COLOR; ?>;
		}
		.login #login form {
			box-shadow: 0 0 6px 4px rgba(0,0,0,0.15);
			background-color: #efefef;
		}
		.login #login #wp-submit {
			color: #fff;
			background-color: <?php echo THEME_COLOR; ?>;
			border-color: <?php echo THEME_COLOR; ?>;
			box-shadow: none;
			text-shadow: none;
		}
		.login #login #nav {
			display: none;
		}
		.login #login #backtoblog {
			display: none;
		}
	</style>
	<?php

}

add_action( 'login_enqueue_scripts', 'neon_customize_login_page' );

/**
 * ログイン画面ロゴ遷移先変更
 *
 * @since 1.0.0
 */
function neon_change_login_header_url() {
	return esc_url( home_url() );
}

add_filter( 'login_headerurl', 'neon_change_login_header_url' );

/*
 * ■カスタマイズ
 */

/**
 * ショートコード[home]
 *
 * ビジュアルエディタ内で[home]が使用できます。
 *
 * @since 1.0.0
 */
function neon_shortcode_home_url() {
	return esc_url( home_url() );
}

add_shortcode( 'home', 'neon_shortcode_home_url' );

/**
 * 固定ページでビジュアルエディタを非表示
 *
 * @since 1.0.0
 */
function neon_disable_visual_editor_on_page_edit() {
	global $typenow;

	if ( 'page' === $typenow || 'mw-wp-form' === $typenow ) {
		add_filter( 'use_block_editor_for_post', '__return_false' );
		add_filter( 'user_can_richedit', '__return_false' );
	}
}

add_action( 'load-post.php', 'neon_disable_visual_editor_on_page_edit' );
add_action( 'load-post-new.php', 'neon_disable_visual_editor_on_page_edit' );

/**
 * ブロックエディター無効化
 *
 * @since 1.0.0
 */
// add_filter( 'use_block_editor_for_post', '__return_false' );

/**
 * 自動保存機能の停止
 *
 * @since 1.0.0
 */
function neon_disable_autosave() {
	wp_deregister_script( 'autosave' );
}

add_action( 'wp_print_scripts', 'neon_disable_autosave' );

/**
 * ターム説明文でHTMLタグを使えるようにする
 *
 * @since 1.0.0
 */
remove_filter( 'pre_term_description', 'wp_filter_kses' );

/*
 * ■余計な機能を除外
 */

/**
 * サイドバーの機能を一部無効化
 *
 * @since 1.0.0
 */
function neon_remove_sidebar_menu() {
	global $menu, $submenu;
	// unset( $menu[5] ); // 投稿
	// var_dump( $menu );
	// var_dump( $submenu );

	if ( 1 !== wp_get_current_user()->ID ) {
		unset( $menu[25] ); // コメント
		unset( $menu['80.025'] ); // カスタムフィールド
		unset( $menu[26] ); // MW WP FORM
		unset( $menu[60] ); // 外観
		unset( $menu[65] ); // プラグイン
		unset( $menu[75] ); // ツール
		unset( $menu[80] ); // 設定
		unset( $menu[100] ); // セキュリティ
		unset( $submenu['index.php'][10] ); // ダッシュボード - 更新
	}

	// if ( wp_get_current_user()->ID !== 9999 ) {

	// }
}

add_action( 'admin_menu', 'neon_remove_sidebar_menu' );

/*
 * ■CSS / JS
 */

/**
 * ファイル読み込み
 *
 * @since 1.0.0
 */
function neon_admin_enqueues() {
	wp_enqueue_script( 'admin_js', THEME_URL . '/inc/assets/js/admin.js', '', '', true );
	wp_enqueue_style( 'admin_css', THEME_URL . '/inc/assets/css/admin.css' );

	if ( 1 !== wp_get_current_user()->ID ) {
		wp_enqueue_style( 'not_admin_css', THEME_URL . '/inc/assets/css/not_admin.css' );
	}
}

add_action( 'admin_enqueue_scripts', 'neon_admin_enqueues' );

/**
 * カスタム投稿数をユーザー一覧に表示
 *
 * @since 1.0.0
 */
function neon_show_custom_post_num_on_user_list( $column ) {
	global $args_all_post_type;

	$post_type_all = get_post_types( $args_all_post_type );

	foreach ( $post_type_all as $post_type ) {
		$column[ $post_type ] = get_post_type_object( $post_type )->label;
	}

	return $column;
}

add_filter( 'manage_users_columns', 'neon_show_custom_post_num_on_user_list' );

/**
 * カスタム投稿編集リンクをユーザー一覧に表示
 *
 * @since 1.0.0
 */
function neon_show_custom_post_edit_link_on_user_list( $column, $column_name, $user_id ) {
	global $args_all_post_type;

	$post_type_all = get_post_types( $args_all_post_type );

	foreach ( $post_type_all as $post_type ) {
		if ( $column_name === $post_type ) {
			$href   = admin_url( '/edit.php' ) . '?post_type=' . $post_type . '&author=' . $user_id;
			$column = '<a href="' . $href . '">'
				. count_user_posts( $user_id, $post_type)
			. '</a>';
		}
	}

	return $column;
}

add_filter( 'manage_users_custom_column', 'neon_show_custom_post_edit_link_on_user_list', 10, 3 );

/**
 * 投稿一覧の項目にアイキャッチ追加
 *
 * @since 1.0.0
 */
function neon_add_thumbnail_column_on_post_list( $column ) {
	$column['thumbnail'] = 'アイキャッチ';

	return $column;
}

add_filter( 'manage_posts_columns', 'neon_add_thumbnail_column_on_post_list' );

/**
 * 投稿一覧の行にアイキャッチ追加
 *
 * @since 1.0.0
 */
function neon_set_thumbnail_column( $column_name, $post_id ) {
	if ( 'thumbnail' === $column_name ) {
		$post_thumbnail = get_the_post_thumbnail(
			$post_id,
			'1200-630',
			array( 'style' => 'width:120px;height:auto;' )
		);

		if ( isset( $post_thumbnail ) && $post_thumbnail ) {
			echo $post_thumbnail;
		} else {
			echo __( 'None' );
		}
	}
}

add_action( 'manage_posts_custom_column', 'neon_set_thumbnail_column', 10, 2 );

/**
 * 投稿一覧で絞り込み項目の表示
 *
 * @since 1.0.0
 */
function neon_show_termfilter_button_on_post_list() {
	global $typenow, $args_all_post_type;

	$post_type_all = get_post_types( $args_all_post_type );

	if ( in_array( $typenow, $post_type_all ) ) {

		foreach ( get_object_taxonomies( $typenow ) as $taxonomy_object ) {
			$taxonomy_data = get_taxonomy( $taxonomy_object );

			if ( isset( $_GET[ $taxonomy_data->query_var ] ) ) {
				$selected = $_GET[ $taxonomy_data->query_var ];
			} else {
				$selected = $taxonomy_data->query_var;
			}

			wp_dropdown_categories( array(
				'show_option_all' => __( 'すべての'.$taxonomy_data->label ),
				'taxonomy'        => $taxonomy_object,
				'name'            => $taxonomy_data->name,
				'orderby'         => 'term_order',
				'selected'        => $selected,
				'hierarchical'    => $taxonomy_data->hierarchical,
				'show_count'      => true,
				'hide_empty'      => false,
			) );
		}
	}
}

add_action( 'restrict_manage_posts', 'neon_show_termfilter_button_on_post_list' );

/*
 * ■プラグイン
 */

/**
 * MW WP Form functions.
 */
require_once neon_locate_inc( 'plugin-mw-wp-form' );

/**
 * ACF functions.
 */
require_once neon_locate_inc( 'plugin-acf' );

/*
 * ○Theme
 */

/*
 * ■Get
 */

/**
 * 現在のページの投稿タイプを取得
 *
 * @since 1.0.0
 * @return string スラッグ.
 */
function neon_get_current_post_type() {
	global $wp_query;

	$post_type = get_post_type();

	if ( empty( $wp_query->found_posts ) ) {
		if ( is_category() ) {
			$category_data = get_taxonomy( 'category' );
			$post_type     = $category_data->object_type[0];
		} elseif ( is_tax() ) {
			$taxonomy_id   = get_queried_object()->taxonomy;
			$taxonomy_data = get_taxonomy( $taxonomy_id );
			$post_type     = $taxonomy_data->object_type[0];
		} elseif ( is_archive() ) {
			$post_type = get_query_var( 'post_type' );
		} elseif ( is_home() ) {
			$post_type = 'post';
		}
	}

	return $post_type;
}

/**
 * $postの内容が書き換わる前の最初の状態の内容を返す.
 *
 * @since 1.0.0
 */
function neon_get_post_origin() {
	global $neon_post_origin;

	return $neon_post_origin;
}

/**
 * 固定ページに独自に持たせるIDのデータを取得
 *
 * @since 1.0.0
 * @param integer                $id   編集画面で設定した取得したいIDを指定する.
 * @param string                 $type 取得したいページ情報タイプ null, 'get', 'link'.
 * @return object|integer|string $type 配列のデータ, ID, URL.
 */
function neon_get_data_from_system_page_id( $id = null, $type = null ) {
	global $post;

	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => -1,
		'post_status' => array(
			'publish',
			'private'
		)
	);
	$post_data      = get_posts( $args );
	$system_page_id = get_field( 'acf_page_system_id', $post->ID );

	if ( 'get' === $type ) {
		return $system_page_id . wp_reset_postdata();
	} elseif ( 'get_anc' === $type ) {
		$system_page_id = get_field(
			'acf_page_system_id',
			get_page(
				end( get_ancestors( $post->ID, 'page' ) ),
				'page'
			)->ID
		);
		return $system_page_id . wp_reset_postdata();
	} elseif ( 'link' === $type ) {
		foreach ( $post_data as $post ) {
			$system_page_id = get_field( 'acf_page_system_id', $post->ID );

			if ( $system_page_id && $id === $system_page_id ) {
				return get_the_permalink( $post ) . wp_reset_postdata();
				break;
			}
		}
	} else {
		foreach ( $post_data as $post ) {
			$system_page_id = get_field( 'acf_page_system_id', $post->ID );

			if ( $system_page_id && $id === $system_page_id ) {
				return $post . wp_reset_postdata();
				break;
			}
		}
	}

	wp_reset_postdata();
}

/**
 * よく使用する「投稿タイプ」やタクソノミー「カテゴリ」、「タグ」
 * のnameを通常投稿とカスタム投稿別に設定する.
 *
 * @param string $type nameの種類
 * @since 1.0.0
 */
function neon_get_template_post_data( $type = null ) {
	$args = array();

	if ( 'post' === neon_get_current_post_type() ) {

		// 表示設定で投稿アーカイブページに指定したページIDの取得
		$page_for_posts_id   = get_option( 'page_for_posts' );
		$page_for_posts_data = get_post( $page_for_posts_id );

		$args['category']  = 'category';
		$args['post_tag']  = 'post_tag';
		$args['post_type'] = $page_for_posts_data->post_name;
	} else {
		$args['category']  = neon_get_current_post_type() . '_cat';
		$args['post_tag']  = neon_get_current_post_type() . '_tag';
		$args['post_type'] = neon_get_current_post_type();
	}

	return $args[ $type ];
}

/**
 * 投稿サムネイルデータ出力
 *
 * @since 1.0.0
 * @param string|integer  $type  取得したいサムネイルのタイプ = 'thumb', integer.
 * @param string          $size  取得したいサムネイルのサイズ。add_image_sizeに登録されている画像サイズの情報が取得できる.
 * @param string          $noimg NO IMAGEの画像ファイル名.
 * @param integer         $num   URL, width, height.
 * @return string|integer $type  アイキャッチのURL, 指定したidから取得した画像のURL
 *                        $num   URL, width, height.
 */
function neon_get_img_data( $type = null, $size = null, $noimg = null, $num = null ) {
	if ( 'thumb' === $type ) {
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
	} else {
		$post_thumbnail_id = $type;
	}

	if ( $size ) {
		$size = $size;
	} else {
		$size = 'full';
	}

	if ( $post_thumbnail_id ) {
		$post_thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_id, $size );

		if ( $num ) {
			$return = $post_thumbnail_src[ $num ];
		} else {
			$return = $post_thumbnail_src[0];
		}
	} else {
		if ( $noimg ) {
			$return = get_template_directory_uri() . '/assets/images/' . $noimg;
		} else {
			$return = get_template_directory_uri() . '/assets/images/noimage_.svg';
		}
	}

	if ( 'alt' === $size ) {
		$return = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
	}

	return $return;
}

/*
 * ■Is
 */

/**
 * 公開されているかどうか
 *
 * @since 1.0.0
 */
function neon_is_public() {
	return get_option( 'blog_public' );
}

/**
 * og_typeの判定
 *
 * @since 1.0.0
 */
function neon_is_og_type() {
	if ( is_front_page() ) {
		$og_type = 'website';
	} else {
		$og_type = 'article';
	}

	return $og_type;
}

/**
 * ユーザーエージェント判定
 *
 * @since 1.0.0
 * @return string サイトを閲覧しているユーザーの端末.
 */
function neon_is_ua() {
	class UserAgent {
		private $ua;
		private $device;

		public function set() {
			$this->ua = mb_strtolower( $_SERVER['HTTP_USER_AGENT'] );

			if ( strpos( $this->ua, 'iphone' ) !== false ) {
				$this->device = 'mobile';
			} elseif ( strpos( $this->ua, 'ipod' ) !== false ) {
				$this->device = 'mobile';
			} elseif ( ( strpos( $this->ua, 'android' ) !== false ) && ( strpos( $this->ua, 'mobile' ) !== false ) ) {
				$this->device = 'mobile';
			} elseif ( ( strpos( $this->ua, 'windows' ) !== false ) && ( strpos( $this->ua, 'phone' ) !== false ) ) {
				$this->device = 'mobile';
			} elseif ( ( strpos( $this->ua, 'firefox' ) !== false ) && ( strpos( $this->ua, 'mobile' ) !== false ) ) {
				$this->device = 'mobile';
			} elseif ( strpos( $this->ua, 'blackberry' ) !== false ) {
				$this->device = 'mobile';
			} elseif ( strpos( $this->ua, 'ipad' ) !== false ) {
				$this->device = 'tablet';
			} elseif ( ( strpos( $this->ua, 'windows' ) !== false ) && ( strpos( $this->ua, 'touch' ) !== false && ( strpos(  $this->ua, 'tablet pc' ) === false ) ) ) {
				$this->device = 'tablet';
			} elseif ( ( strpos( $this->ua, 'android' ) !== false ) && ( strpos( $this->ua, 'mobile' ) === false ) ) {
				$this->device = 'tablet';
			} elseif ( ( strpos( $this->ua, 'firefox' ) !== false ) && ( strpos( $this->ua, 'tablet' ) !== false ) ) {
				$this->device = 'tablet';
			} elseif ( ( strpos( $this->ua, 'kindle' ) !== false ) || ( strpos( $this->ua, 'silk' ) !== false ) ) {
				$this->device = 'tablet';
			} elseif ( ( strpos( $this->ua, 'playbook' ) !== false ) ) {
				$this->device = 'tablet';
			} else {
				$this->device = 'others';
			}

			return $this->device;
		}
	}
	$return = new UserAgent();

	return $return->set();
}

/**
 * ブラウザ判定
 *
 * @since 1.0.0
 * @return string サイトを閲覧しているブラウザ.
 */
function neon_is_browser() {
	$s_browser = strtolower( $_SERVER['HTTP_USER_AGENT'] );

	if ( strstr( $s_browser , 'edge' ) || strstr( $s_browser, 'trident' ) || strstr( $s_browser, 'msie' ) ) {
		return 'IE-Edge';
	} elseif ( strstr( $s_browser, 'chrome' ) ) {
		return 'Chrome';
	} elseif ( strstr( $s_browser, 'firefox' ) ) {
		return 'Firefox';
	} elseif ( strstr( $s_browser, 'safari' ) ) {
		return 'Safari';
	} elseif ( strstr( $s_browser, 'opera' ) ) {
		return 'Opera';
	} else {
		return '';
	}
}

/*
 * ■Sanitize
 */

/**
 * 文字を任意の文字数でカット
 *
 * @since 1.0.0
 * @param string $content カットしたい要素
 * @param integer $length カットしたい文字数
 * @return string カットされた文字列.
 */
function neon_hyper_trim( $content = null, $length = null ) {
	$content = preg_replace( '/<!--more-->.+/is',"",$content );
	$content = strip_shortcodes( $content );
	$content = trim( strip_tags( $content ) );
	$content = str_replace( '&nbsp;','',$content );

	if ( mb_strlen( $content, 'utf-8' ) > $length ) {
		$content = mb_substr( $content, 0, $length, 'utf-8' ) . '...';
	}

	return $content;
}

/*
 * ■The
 */

/**
 * メニュー
 *
 * @param string $place 表示する場所
 * @since 1.0.0
 */
function neon_the_menu( $place ) {

	/**
	 * サイトメニュー.
	 */
	include neon_locate_tmp( 'menu' );
}

/**
 * 投稿情報出力
 *
 * @since 1.0.0
 * @param string $type 取得したい投稿情報のタイプを指定 = 1.null, 2.'name', 3.'link'.
 * @return string 指定した投稿情報.
 */
function neon_the_post_data( $type = null ) {
	$current_post_type = neon_get_current_post_type();

	if ( 'post' === $current_post_type ) {
		$current_post_type = get_post( get_option( 'page_for_posts' ) )->post_name;
	}

	$post_type_object = get_post_type_object( neon_get_current_post_type() );

	if ( 'name' === $type ) {
		return $current_post_type;
	} elseif ( 'link' === $type ) {
		return get_post_type_archive_link( neon_get_current_post_type() );
	} else {
		return $post_type_object->label;
	}
}

/**
 * サムネイルのaltタグ
 *
 * @since 1.0.0
 * @param string $text サムネイルがある場合に出力したいテキスト.
 * @return string サムネイルがあった場合は指定したテキスト.
 */
function neon_the_thumb_alt( $text = null ) {
	if ( has_post_thumbnail() ) {
		if ( '' === $text ) {
			return get_the_title() . 'のアイキャッチ';
		} else {
			return $text;
		}
	} else {
		return '';
	}
}

/**
 * timeタグ出力
 *
 * @since 1.0.0
 * @param  string $class 使用したいクラス名.
 * @param  string $type  日付フォーマット.
 * @return string timeタグで囲った日付テキスト.
 */
function neon_the_time_tag( $class = null, $type = null ) {
	$class_name  = '';
	$output_type = 'Y.m.d';

	if ( $class ) {
		$attr_class = 'class="' . $class . '" ';
	}

	if ( $type ) {
		$output_type = $type;
	}

	$return = '<time ' . $attr_class . ' datetime="' . get_the_time( 'Y-m-d' ) . '">'
		. get_the_time( $output_type )
	. '</time>';

	return $return;
}

/**
 * 投稿に属するタームを出力
 *
 * @since 1.0.0
 * @param string  $tax     使用するタクソノミースラッグを指定.
 * @param string  $class   使用したいクラス.
 * @param string  $wrapper 使用したいラッパークラス.
 * @param boolean $link    リンク付きのリストを表示するか否か.
 * @param string  $class2  2つ目に使用したいクラス（親要素にのみ付与される）.
 * @return string 指定したタクソノミーのリストHTML.
 */
function neon_the_has_term_list( $tax = null, $class = null, $wrapper = null, $link = null, $class2 = null ) {
	$the_terms = get_the_terms( $post->ID, $tax );

	if ( $the_terms && ! $the_terms->errors ) {
		foreach ( $the_terms as $term_data ) {
			if ( 1 !== $term_data->term_id ) {
				if ( $link ) {
					$set_tag_start = 'a href="' . esc_url( get_term_link( $term_data ) ) . '"';
					$set_tag_end   = 'a';
				} else {
					$set_tag_start = 'span';
					$set_tag_end   = 'span';
				}

				if ( $term_data->parent ) {
					$child_class = '-child';
				} else {
					$child_class = '';
				}

				$item_class = explode( ' ', $class )[0];
				$term_list .= '<li class="' . $item_class . '__item">
					<' . $set_tag_start . ' class="__inner ' . $child_class . '">'
						. $term_data->name
					. '</' . $set_tag_end . '>
				</li>';
			} else {
				$is_default_term = 1;
			}
		}

		if ( ! $is_default_term ) {
			if ( $class2 ) {
				$set_second_tag_start = '<div class="' . $class2 . '">';
				$set_second_tag_end   = '</div>';
			} else {
				$set_second_tag_start = '';
				$set_second_tag_end   = '';
			}

			$return = $set_second_tag_start
				. '<div class="' . $class . '">
					<ul class="' . $wrapper . '">'
						. $term_list
					. '</ul>
				</div>'
			. $set_second_tag_end;
		} else {
			$return = '';
		}
	} else {
		$return = '';
	}

	return $return;
}

/**
 * 登録されているタームを出力
 *
 * @since 1.0.0
 * @param string  $tax     使用するタクソノミースラッグを指定.
 * @param string  $class   使用したいクラス（子要素まで付与される）.
 * @param string  $wrapper 使用したいラッパークラス.
 * @param string  $class2  2つ目に使用したいクラス（親要素にのみ付与される）.
 * @return string 指定したタクソノミーのリストHTML.
 */
function neon_the_term_list( $tax = null, $class = null, $wrapper = null, $class2 = null ) {
	$any_term_object = get_terms( $tax );
	$any_term_list = '';

	if ( ! empty( $any_term_object ) && ! is_wp_error( $any_term_object ) ) {
		foreach ( $any_term_object as $any_term_data ) {
			if ( 1 !== $any_term_data->term_id ) {
				$item_class     = explode( ' ', $class )[0];
				$any_term_list .= '<li class="' . $item_class . '__item">
					<a class="__inner" href="' . esc_url( get_term_link( $any_term_data ) ) . '">'
						. $any_term_data->name
					. '</a>
				</li>';
			}
		}

		if ( $class2 ) {
			$set_second_tag_start = '<div class="' . $class2 . '">';
			$set_second_tag_end   = '</div>';
		} else {
			$set_second_tag_start = '';
			$set_second_tag_end   = '';
		}

		$return = $set_second_tag_start
			. '<div class="' . $class . '">
				<ul class="' . $wrapper . '">'
					. $any_term_list
				. '</ul>
			</div>'
		. $set_second_tag_end;
	} else {
		$return = '';
	}

	return $return;
}

/**
 * ファイル名からメディアリンク生成
 *
 * @since 1.0.0
 * @param  string $fileName メディアにアップしたファイルの「説明」.
 * @return stirng 指定したファイルの「説明」に該当するファイルURL.
 */
function neon_the_media_link( $fileName = null ) {
	$args = array(
		'post_type'      => 'attachment',
		'posts_per_page' => -1
	);
	$link = 'javascript:void(0);';

	foreach ( get_posts( $args ) as $post ) {
		if ( preg_match( '/' . $fileName . '/', $post->post_content ) ) {
			$link = $post->guid;

			break;
		}
	}

	wp_reset_postdata();

	return $link;
}

/**
 * コンテンツ圧縮
 *
 * @since 1.0.0
 */
function neon_the_ob_replace() {
	$content = ob_get_clean();
	$content = str_replace( "\t", '', $content );
	$content = str_replace( "\r", '', $content );
	$content = str_replace( "\n", '', $content );
	# $content = preg_replace( '/<!--[\s\S]*?-->/', '', $content );

	echo $content;
}

/*
 * ■Remove
 */

/*
 * wp_headから不要な読み込みを除外
 */
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'parent_post_rel_link' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'rel_canonical' );

// 絵文字無効化
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

/*
 * ■Add
 */

/**
 * RSS設定
 *
 * @since 1.0.0
 */
function neon_rss_post_thumbnail( $content ) {
	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		$content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . $content;
	} else {
		$content = '<p><img src="' . THEME_IMG_URL . '/noimage.png"></p>' . $content;
	}

	return $content;
}

add_filter( 'the_excerpt_rss', 'neon_rss_post_thumbnail' );
add_filter( 'the_content_feed', 'neon_rss_post_thumbnail' );

/**
 * アドミンバー項目削除
 *
 * @since 1.0.0
 */
function neon_diable_adminbar_menu( $adminbar ) {
	if ( 1 !== wp_get_current_user()->ID ) {
		$adminbar->remove_node( 'wp-logo' );
		$adminbar->remove_menu( 'updates' );
		$adminbar->remove_menu( 'customize' );
		$adminbar->remove_menu( 'search' );
		$adminbar->remove_menu( 'comments' );
	}
}

add_action( 'admin_bar_menu', 'neon_diable_adminbar_menu', 1000 );

/**
 * dns prefetch無効化
 *
 * @since 1.0.0
 */
function neon_remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}

	return $hints;
}

add_filter( 'wp_resource_hints', 'neon_remove_dns_prefetch', 10, 2 );

/**
 * the_contentカスタマイズ
 *
 * @since 1.0.0
 */
function neon_custom_the_content( $content = null ) {
	global $post;

	$args = array(
		'page'
	);
	$remove_filter = false;

	if ( in_array( neon_get_current_post_type(), $args ) ) {
		$remove_filter = true;
	}

	if ( $remove_filter ) {
		remove_filter( 'the_content', 'wpautop' );
		remove_filter( 'the_excerpt', 'wpautop' );
	}

	if ( is_singular() ) {
		$content = preg_replace( '/<p>&nbsp;<\/p>/i', '<p style="clear: both;">&nbsp;</p>', $content );
	}

	return $content;
}

add_filter( 'the_content', 'neon_custom_the_content', 9 );

/**
 * 同スラッグ・親子関係違いなどでのリダイレクト制御
 *
 * @since 1.0.0
 */
function neon_disable_force_redirect( $redirect_url ) {
	// if ( is_archive() )
	$redirect_url = false;

	return $redirect_url;
}

add_filter( 'redirect_canonical', 'neon_disable_force_redirect' );

/**
 * 投稿者アーカイブ無効化
 *
 * @since 1.0.0
 */
function neon_disable_author_archive() {
	if ( ! empty( $_GET['author'] ) || preg_match( '#/author/.+#', $_SERVER['REQUEST_URI'] ) ) {
		wp_redirect( esc_url( home_url( '/404.php' ) ) );

		exit;
	}
}

add_filter( 'author_rewrite_rules', '__return_empty_array' );
add_action( 'init', 'neon_disable_author_archive' );

/**
 * get_archives_linkの内容を書き換え
 *
 * @since 1.0.0
 */
function neon_replace_archive_link( $html ) {
	if ( preg_match( '/blog\/date\//', $html ) && 'post' !== neon_get_current_post_type() ) {
		return preg_replace( '/blog\/date\//', '', $html );
	} else {
		return $html;
	}
}

add_filter( 'get_archives_link', 'neon_replace_archive_link', 10 );

/**
 * 検索結果拡張
 *
 * @since 1.0.0
 */
function neon_custom_search_system( $search, $query ) {
	global $wpdb;

	//サーチページ以外だったら終了
	if ( ! $query->is_search || isset( $query->query_vars ) ) {
		return $search;
	}

	// ユーザー名とか、タグ名・カテゴリ名も検索対象に
	$search_words = explode( ' ', isset( $query->query_vars['s'] ) ? $query->query_vars['s'] : '' );

	if ( count( $search_words ) > 0 ) {
		$search = '';

		foreach ( $search_words as $search_word ) {
			if ( ! empty( $search_word ) ) {
				$add_words = $wpdb->escape( "%{$search_word}%" );
				$search       .= " AND (
					{$wpdb->posts}.post_title LIKE '{$add_words}'
					OR {$wpdb->posts}.post_content LIKE '{$add_words}'
					OR {$wpdb->posts}.post_name LIKE '{$add_words}'
					OR {$wpdb->posts}.ID IN (
						SELECT distinct r.object_id
						FROM {$wpdb->term_relationships} AS r
						INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
						INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
						WHERE t.name LIKE '{$add_words}'
						OR t.slug LIKE '{$add_words}'
						OR tt.description LIKE '{$add_words}'
					)
					OR {$wpdb->posts}.ID IN (
						SELECT distinct post_id
						FROM {$wpdb->postmeta}
						WHERE meta_value LIKE '{$add_words}'
					)
				) ";
			}
		}
	}

	return $search;
}

add_filter( 'posts_search', 'neon_custom_search_system', 10, 2 );

/*
 * ■Wp
 */

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
