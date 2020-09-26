<?php
/**
 * 下層ページのページヘッダー
 *
 * @package WordPress
 * @since 1.0.0
 */

if ( ! is_front_page() ) :
	$page_header_image_src = get_template_directory() . '/assets/images/pageHeader_';
	$page_header_title_ja  = get_the_title();
	$page_header_title_en  = $post->post_name;
	$page_header_title_tag = 'h1';

	if ( is_page() && neon_get_data_from_system_page_id( '', 'get' ) ) {
		$page_header_image_src .= neon_get_data_from_system_page_id( '', 'get' );
	}

	if ( 'post' === neon_get_current_post_type() ) {
		$page_header_title_ja = get_post( get_option( 'page_for_posts' ) )->post_title;
		$page_header_title_en = get_post( get_option( 'page_for_posts' ) )->post_name;
	}

	if ( is_404() ) {
		$page_header_title_ja   = 'お探しのページが見つかりませんでした';
		$page_header_title_en   = '404 Not found.';
		$page_header_image_src .= '404';
	}

	if ( is_archive() ) {
		$page_header_title_ja = neon_the_post_data( 'label' );
		$page_header_title_en = neon_the_post_data( 'name' );
	}

	if ( is_single() ) {
		$page_header_title_ja  = neon_the_post_data( 'label' );
		$page_header_title_en  = neon_the_post_data( 'name' );
		$page_header_title_tag = 'h2';
	}

	if ( is_search() && 'any' === $wp_query->query_vars['post_type'] ) {
		$page_header_title_ja = '検索結果';
		$page_header_title_en = 'Search';
	}

	if (
		 is_search() || is_date() || is_tax() || is_category()|| is_tag()
		 || ( 'any' !== is_home() && $wp_query->query_vars['post_type'] )
	) {
		$page_header_title_tag = 'h2';
	}

	$page_header_image_src .= '_.jpg';

	if ( file_exists( $page_header_image_src ) ) {
		$page_header_image_src = str_replace(
			get_template_directory() . '/assets/images',
			THEME_IMG_URL,
			$page_header_image_src
		);
		$page_header_style = 'style="background-image: url(' . $page_header_image_src . ');"';
	} else {
		$page_header_style = '';
	}

	?>
	<header class="primaryContainer__head">
		<div class="_container">
			<div class="pageHeader">
				<div class="pageHeader__group_1">
					<div class="pageHeader__title">
						<<?php echo $page_header_title_tag; ?> class="pageHeader__mainTitle">
							<?php echo $page_header_title_ja; ?>
						</<?php echo $page_header_title_tag; ?>>

						<small class="pageHeader__subTitle">
							<?php echo ucwords( $page_header_title_en ); ?>
						</small>
					</div><!-- /.pageHeader__title -->
				</div><!-- /.pageHeader__group_1 -->

				<div class="pageHeader__group_2">
					<div class="pageHeader__image" <?php echo $page_header_style; ?>></div>
				</div><!-- /.pageHeader__group_2 -->
			</div><!-- /.pageHeader -->
		</div><!-- /._container -->
	</header>
	<?php

endif;

// パンくずリスト
if ( ! is_front_page() ) {
	get_template_part( 'template-parts/breadcrumb' );
}
