<?php
/**
 * 詳細ページのページャー
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

// 前の or 次の投稿があったら
if ( get_previous_post() || get_next_post() ) :
	$previous_post_data = get_previous_post();
	$next_post_data     = get_next_post();

	?>
	<div class="nn_article_navigation_1">
		<ul class="nn_article_navigation_1__List">
			<li class="nn_article_navigation_1__Item -prev">
				<?php

				if ( $previous_post_data ) :

					?>
					<a class="__Inner"
					   href="<?php echo esc_url( get_permalink( $previous_post_data->ID ) ); ?>">
						<span class="nn_article_navigation_1__Text">前の記事</span>
					</a>
					<?php

				endif ;

				?>
			</li>
			<li class="nn_article_navigation_1__Item -back">
				<a class="__Inner"
				   href="<?php echo esc_url( neon_the_post_data( 'link' ) ); ?>">
					<span class="nn_article_navigation_1__Text">一覧へ戻る</span>
				</a>
			</li>
			<li class="nn_article_navigation_1__Item -next">
			<?php

			if ( $next_post_data ) :

				?>
				<a class="__Inner"
				   href="<?php echo esc_url( get_permalink( $next_post_data->ID ) ); ?>">
					<span class="nn_article_navigation_1__Text">次の記事</span>
				</a>
				<?php

			endif ;

			?>
			</li>
		</ul>
	</div><!-- /.nn_article_navigation_1 -->
	<?php

endif ;
