<?php
/**
 * 投稿ループのテンプレート
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
<div class="nn_posts_1">
	<div class="<?php echo neon_option_class( 'nn_posts_1__list' ); ?>">
		<?php

		while ( have_posts() ) : the_post();

			?>
			<article class="nn_posts_1__item">
				<a class="__inner _block"
				   href="<?php the_permalink(); ?>"
				   title="<?php the_title(); ?>">
					<div class="nn_posts_1__ladder">
						<header class="nn_posts_1__head">
							<div class="nn_posts_1__thumbnail _maskFit">
								<img class="__src _minL_inline _maskFit__src _ofi"
								     src="<?php echo neon_get_img_data( 'thumb', 'template_thumb_full' ); ?>"
								     srcset="<?php echo neon_get_img_data( 'thumb', 'template_thumb_full@2x' ); ?> 2x,
								             <?php echo neon_get_img_data( 'thumb', 'template_thumb_full' ); ?> 1x"
								     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
								<img class="__src _maxL_inline _maskFit__src _ofi"
								     src="<?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?>"
								     srcset="<?php echo neon_get_img_data( 'thumb', 'template_lite_S@2x' ); ?> 2x,
								             <?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?> 1x"
								     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
							</div>
						</header>
						<div class="nn_posts_1__torso">
							<?php

							echo neon_the_time_tag( 'nn_posts_1__date', 'Y/m/d' );

							?>
							<h3 class="nn_posts_1__title"><?php the_title(); ?></h3>
							<?php

							echo neon_the_has_term_list(
								neon_get_template_post_data( 'category' ),
								'term_1',
								'term_1__list',
								'',
								'nn_posts_1__term'
							);

							echo neon_the_has_term_list(
								neon_get_template_post_data( 'post_tag' ),
								'term_2',
								'term_2__list',
								'',
								'nn_posts_1__term'
							);

							?>
						</div><!-- /.nn_posts_1__torso -->
					</div><!-- /.nn_posts_1__ladder -->
				</a>
			</article>
			<?php

		endwhile;

		?>
		<div class="nn_posts_1__item -empty"></div>
	</div><!-- /.nn_posts_1__list -->
</div><!-- /.nn_posts_1 -->
