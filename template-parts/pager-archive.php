<?php
/**
 * アーカイブページのページャー
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

$is_pager_debug = 1;

?>
<div class="_ladder__pager">
	<div class="nn_wp_archivePager_1">
		<?php

		if ( ! $is_pager_debug ) :

			if ( get_next_posts_link() || get_previous_posts_link() ) {
				$archive_pager = paginate_links( array(
					'total'     => $wp_query->max_num_pages,
					'mid_size'  => 3,
					'prev_text' => '',
					'next_text' => '',
					'current'   => ( $paged ? $paged : 1 ),
				) );

				echo $archive_pager;

			// if have not posts next prev
			} else {

				?>
				<span class="page-numbers current">1</span>
				<?php

			}

		else :

			?>
			<a class="prev page-numbers" href="#"></a>
			<a class="page-numbers" href="#">1</a>
			<span class="page-numbers dots">…</span>
			<a class="page-numbers" href="#">6</a>
			<a class="page-numbers" href="#">7</a>
			<span class="page-numbers current" aria-current="page">8</span>
			<a class="page-numbers" href="#">9</a>
			<a class="page-numbers" href="#">10</a>
			<span class="page-numbers dots">…</span>
			<a class="page-numbers" href="#">42</a>
			<a class="next page-numbers" href="#"></a>
			<?php

		endif ;

		?>
	</div><!-- /.nn_wp_archivePager_1 -->
</div><!-- /._ladder__pager -->
