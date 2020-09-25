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
	<div class="<?php echo neon_option_class( 'nn_posts_1__List' ); ?>">
		<?php

		while ( have_posts() ) : the_post();

			?>
			<article class="nn_posts_1__Item">
				<a class="__Inner _Block"
				   href="<?php the_permalink(); ?>"
				   title="<?php the_title(); ?>">
					<div class="nn_posts_1__Ladder">
						<header class="nn_posts_1__Head">
							<div class="nn_posts_1__Thumbnail _MaskFit">
								<img class="__Src _MinL_inline _MaskFit__Src _Ofi"
								     src="<?php echo neon_get_img_data( 'thumb', 'template_thumb_full' ); ?>" 
								     srcset="<?php echo neon_get_img_data( 'thumb', 'template_thumb_full@2x' ); ?> 2x,
								             <?php echo neon_get_img_data( 'thumb', 'template_thumb_full' ); ?> 1x"
								     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
								<img class="__Src _MaxL_inline _MaskFit__Src _Ofi"
								     src="<?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?>" 
								     srcset="<?php echo neon_get_img_data( 'thumb', 'template_lite_S@2x' ); ?> 2x,
								             <?php echo neon_get_img_data( 'thumb', 'template_lite_S' ); ?> 1x"
								     alt="<?php echo neon_get_img_data( 'thumb', 'alt' ); ?>">
							</div>
						</header>
						<div class="nn_posts_1__Torso">
							<?php

							echo neon_the_time_tag( 'nn_posts_1__Date', 'Y/m/d' );

							?>
							<h3 class="nn_posts_1__Title"><?php the_title(); ?></h3>
							<?php

							echo neon_the_has_term_list(
								neon_get_template_post_data( 'category' ),
								'term_1',
								'term_1__List',
								'',
								'nn_posts_1__Term'
							);

							echo neon_the_has_term_list(
								neon_get_template_post_data( 'post_tag' ),
								'term_2',
								'term_2__List',
								'',
								'nn_posts_1__Term'
							);

							?>
						</div>
						<!-- /.nn_posts_1__Torso -->
					</div>
					<!-- /.nn_posts_1__Ladder -->
				</a>
			</article>
			<?php

		endwhile;

		?>
		<div class="nn_posts_1__Item -empty"></div>
	</div>
	<!-- /.nn_posts_1__List -->
</div>
<!-- /.nn_posts_1 -->
