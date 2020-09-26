<?php
/**
 * 検索結果の投稿リスト
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
<div class="nn_posts_2">
	<?php

	while ( have_posts() ) :
		the_post();

		?>
		<article class="nn_posts_2__item">
			<a class="__inner _block"
			   href="<?php the_permalink(); ?>"
			   title="<?php the_title(); ?>">
				<h2 class="nn_posts_2__title"><?php echo the_title(); ?></h2>
				<?php

				if ( get_the_content() ) :

					?>
					<p class="nn_posts_2__exerpt"><?php echo neon_hyper_trim( get_the_content(), 200 ); ?></p>
					<?php

				endif;

				?>
			</a>
		</article>
		<?php

	endwhile;

	?>
</div><!-- /.nn_posts_2 -->
