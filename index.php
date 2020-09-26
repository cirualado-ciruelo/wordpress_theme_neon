<?php
/**
 * The main template file
 *
 * 全てのテンプレートはここから始まります。
 *
 * @package WordPress
 * @since 1.0.0
 */

get_header();

?>
<div class="containerTree__branch">
	<div class="_container">
		<div class="hasSideContainer">
			<main class="hasSideContainer__main">
				<article class="_ladder -gapSize_M">
					<?php

					if ( have_posts() ) :
						if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) :

							?>
							<p class="_nn_text_1">検索条件が入力されていません。</p>
							<?php

						else :
							if ( $_GET['s'] ) :

								?>
								<h1 class="nn_title_lv2_1">[<?php echo $_GET['s']; ?>]の検索結果</h1>
								<?php

							elseif ( is_tax() || is_category() || is_tag() ) : ?>

								<h1 class="nn_title_lv2_1">#<?php echo get_queried_object()->name; ?></h1>
								<?php

							elseif ( is_date() ) :
								$query_var_year  = get_query_var( 'year' );
								$query_var_month = get_query_var( 'monthnum' );
								$query_var_day   = get_query_var( 'day' );

								if ( is_year() ) :
									$date_title = $query_var_year
									. '<small>年の記事</small>';
								elseif ( is_month() ) :
									$date_title = $query_var_year
										. '<small>年</small>'
									. $query_var_month . '<small>月の記事</small>';
								elseif ( is_day() ) :
									$date_title = $query_var_year
										. '<small>年</small>'
										. $query_var_month . '<small>月</small>'
									. $query_var_day . '<small>日の記事</small>';
								endif;

								?>
								<h1 class="nn_title_lv2_1"><?php echo $date_title; ?></h1>
								<?php

							// $_GET['s']
							endif;

							?>
							<div class="nn_posts_1">
								<?php

								/**
								 * 投稿リスト
								 */
								get_template_part( 'template-parts/posts', 'post' );

								?>
							</div><!-- /.nn_posts_1 -->
							<?php

						// isset($_GET['s']) && empty($_GET['s'])
						endif;

					// 投稿がないとき
					else :
						if ( ! isset( $_GET['s'] ) ) :
							$not_found_message = '記事が登録されていません。';
						else :
							$not_found_message = '検索条件に一致しませんでした。';
						endif;

						?>
						<p class="_nn_text_1">
							<?php echo $not_found_message; ?>
						</p>
						<?php

					// have_posts()
					endif;

					/**
					 * ページャー
					 */
					get_template_part( 'template-parts/pager', 'archive' );

					wp_reset_query();

					?>
				</article>
			</main><!-- /.hasSideContainer__main -->

			<aside class="hasSideContainer__side">
				<?php

				/**
				 * 投稿サイドバー
				 */
				get_template_part( 'template-parts/sidebar', 'post' );

				?>
			</aside>
		</div><!-- /.hasSideContainer -->
	</div><!-- /._container -->
</div><!-- /.containerTree__branch -->
<?php

get_footer();
