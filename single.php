<?php
/**
 * The template for displaying all single posts
 *
 * 全ての詳細ページはここから始まります。
 *
 * @package WordPress
 * @since 1.0.0
 */

get_header();

while ( have_posts() ) :
	the_post();

	?>
	<div class="containerTree__branch _bg_color_gray_1">
		<div class="_container">
			<div class="hasSideContainer">

				<main class="hasSideContainer__main">
					<div class="article_container_1 _ladder -gapSize_XL">
						<header class="article_container_1__head">
							<div class="article_head_1">
								<h1 class="article_title_1"><?php the_title(); ?></h1>

								<div class="_ladder">
									<?php

									if ( has_post_thumbnail() ) :

										?>
										<div class="article_eyeCatch_1">
											<img class="__src _full_inline"
											     src="<?php echo neon_get_img_data( 'thumb', 'major_full_content' ); ?>"
											     srcset="<?php echo neon_get_img_data( 'thumb', 'major_full_content@2x' ); ?> 2x,
											             <?php echo neon_get_img_data( 'thumb', 'major_full_content' ); ?> 1x"
											     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
											<img class="__src _lite_inline"
											     src="<?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?>"
											     srcset="<?php echo neon_get_img_data( 'thumb', 'template_lite_S@2x' ); ?> 2x,
											             <?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?> 1x"
											     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
										</div>
										<?php

									endif;

									?>
									<div class="article_head_1__meta _ladder -gapSize_XS">
										<?php

										echo neon_the_time_tag( 'article_date_1', 'Y/m/d' );

										echo neon_the_has_term_list(
											neon_get_template_post_data( 'category' ),
											'term_1',
											'term_1__list',
											1
										);

										echo neon_the_has_term_list(
											neon_get_template_post_data( 'post_tag' ),
											'term_2',
											'term_2__list',
											1
										);

										?>
									</div>
								</div><!-- /._ladder -->
							</div><!-- /.article_head_1 -->
						</header>
						<section class="article_container_1__torso _ladder -gapSize_L">
							<article class="foundation_article_1">
								<div class="wp_theContent">
									<?php the_content(); ?>
								</div>
								<?php

								$args = array(
									'before' => '<div class="nn_wp_articlePager_1">',
									'after'  => '</div>',
								);

								wp_link_pages( $args );

								?>
							</article>
						</section>
						<footer class="article_container_1__footer _ladder">
							<?php

							/**
							 * SNSシェアボタン
							 */
							get_template_part( 'template-parts/sns', 'share' );

							/**
							 * ページャー
							 */
							get_template_part( 'template-parts/pager', 'single' );

							?>
						</footer>
					</div><!-- /.article_container_1 -->
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

endwhile;

get_footer();
