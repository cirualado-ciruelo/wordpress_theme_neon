<?php
/**
 * The template for displaying search results pages
 *
 * カスタム投稿内検索結果一覧ページの場合は別ソースを参照します。
 *
 * @package WordPress
 * @since 1.0.0
 */

// カスタム投稿内検索結果一覧ページの場合
if ( 'any' !== $wp_query->query_vars['post_type'] ) :

	/**
	 * 全ての始まり
	 */
	get_template_part( 'index' );
else :
	$is_search_pager = false;

	get_header();

	if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		$result_title = '検索条件が入力されていません。';
	} else {
		if ( have_posts() ) {
			$result_title = '<b>' . $wp_query->found_posts . '</b> <small>件見つかりました</small>';
		} else {
			$result_title = '検索条件に一致しませんでした。';
		}
	}

	?>
	<section class="ContainerTree__Branch">
		<div class="_Container">
			<h2 class="nn_title_lv2_1"><?php echo $result_title; ?></h2>

			<div class="_Ladder">
				<?php

				// 検索条件が空だったら
				if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) :

					?>
					<p class="_nn_text_1">
						<a class="_nn_link_left_1"
						   href="javascript:history.back();">前のページに戻る</a>
					</p>
					<?php

				// if isset($_GET['s']) && empty($_GET['s']) )
				else :
					if ( have_posts() ) :
						$is_search_pager = true;

						/**
						 * 検索結果の投稿リスト
						 */
						get_template_part( 'template-parts/posts', 'search' );

					// if have_posts()
					else :

						?>
						<p class="_nn_text_1">
							<a class="_nn_link_left_1"
							   href="<?php echo esc_url( home_url() ); ?>">トップページへ戻る</a>
						</p>
						<?php

					endif;

				// if isset($_GET['s']) && empty($_GET['s']) )
				endif;

				// ページャー
				if ( $is_search_pager ) :

					/**
					 * ページャー
					 */
					get_template_part( 'template-parts/pager', 'archive' );

					wp_reset_query();

				endif;

				?>
			</div><!-- /._Ladder -->
		</div><!-- /._Container -->
	</section><!-- /.ContainerTree__Branch -->
	<?php

	get_footer();

// 'any' !== $wp_query->query_vars['post_type']
endif;
