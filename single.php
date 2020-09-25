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
	<div class="ContainerTree__Branch _bg_color_gray_1">
		<div class="_Container">
			<div class="HasSideContainer">

				<main class="HasSideContainer__Main">
					<div class="article_container_1 _Ladder -size_XL">
						<header class="article_container_1__Head">
							<div class="article_head_1">
								<h1 class="article_title_1"><?php the_title(); ?></h1>

								<div class="_Ladder">
									<?php

									if ( has_post_thumbnail() ) :

										?>
										<div class="article_eyeCatch_1">
											<img class="__Src _Full_inline"
											     src="<?php echo neon_get_img_data( 'thumb', 'major_full_content' ); ?>"
											     srcset="<?php echo neon_get_img_data( 'thumb', 'major_full_content@2x' ); ?> 2x,
											             <?php echo neon_get_img_data( 'thumb', 'major_full_content' ); ?> 1x"
											     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
											<img class="__Src _Lite_inline"
											     src="<?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?>"
											     srcset="<?php echo neon_get_img_data( 'thumb', 'template_lite_S@2x' ); ?> 2x,
											             <?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?> 1x"
											     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
										</div>
										<?php

									endif;

									?>
									<div class="article_head_1__Meta _Ladder -size_XS">
										<?php

										echo neon_the_time_tag( 'article_date_1', 'Y/m/d' );

										echo neon_the_has_term_list(
											neon_get_template_post_data( 'category' ),
											'term_1',
											'term_1__List',
											1
										);

										echo neon_the_has_term_list(
											neon_get_template_post_data( 'post_tag' ),
											'term_2',
											'term_2__List',
											1
										);

										?>
									</div>
								</div><!-- /._Ladder -->
							</div><!-- /.article_head_1 -->
						</header>
						<section class="article_container_1__Torso _Ladder -size_L">
							<article class="foundation_article_1">
								<div class="wp_TheContent">
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
						<footer class="article_container_1__Footer _Ladder">
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
				</main><!-- /.HasSideContainer__Main -->

				<aside class="HasSideContainer__Side">
					<?php

					/**
					 * 投稿サイドバー
					 */
					get_template_part( 'template-parts/sidebar', 'post' );

					?>
				</aside>

			</div><!-- /.HasSideContainer -->
		</div><!-- /._Container -->
	</div><!-- /.ContainerTree__Branch -->
	<?php

endwhile;

get_footer();
