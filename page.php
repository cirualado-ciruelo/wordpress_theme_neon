<?php
/**
 * The template for displaying all single posts
 *
 * 固定ページのテンプレートはここから始まります。
 *
 * @package WordPress
 * @since 1.0.0
 */

// 固定ページのファイルパス取得
$page_file = locate_template( 'pages/' . neon_get_data_from_system_page_id( '', 'get' ) . '.php' );

// 使用するライブラリのリスト
$use_library = array();

// 使用するライブラリのリスト作成
foreach ( file( $page_file ) as $page_file_line ) {
	if ( strstr( $page_file_line, ' * is_' ) ) {
		$page_file_line = str_replace( ["\n", ' * '], '', $page_file_line );
		$use_library[ $page_file_line ] = 1;
	}

	if ( strstr( $page_file_line, 'end;' ) ) {
		break;
	}
}

get_header();

// formテンプレートを使用するフォームを指定
if ( preg_match( '/f/', neon_get_data_from_system_page_id( '', 'get_anc' ) ) ) {
	$form_template = neon_locate_tmp( 'form' );
}

// 固定ページのビジュアルエディタにソースがある場合
if ( $post->post_content ) :
	while ( have_posts() ) {
		the_post();

		$neon_post_origin = $post;

		// formテンプレートを使用するフォームの場合
		if ( $form_template ) {
			get_template_part( 'template-parts/form' );
		} else {
			the_content();
		}
	}
else :

	// ソースファイルがある場合
	if ( $page_file ) :
		get_template_part( 'pages/' . neon_get_data_from_system_page_id( '', 'get' ) );
	else :

		?>
		<div class="containerTree__branch">
			<div class="_container">
				<p class="_nn_text_1 _tac">このページは現在準備中です。</p>
			</div><!-- /._container -->
		</div><!-- /.containerTree__branch -->
		<?php

	// if $page_file
	endif;

// if $post->post_content
endif;

get_footer();
