<?php
/**
 * サイドバーのテンプレート
 *
 * 投稿アーカイブ、詳細ページに使用します。
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
<div class="sidebar_1">
	<section class="sidebar_1__Item">
		<h2 class="title_lv3_1">カテゴリ</h2>

		<?php

		echo neon_the_term_list(
			neon_get_template_post_data( 'category' ),
			'term_1',
			'term_1__List',
			'sidebar_1__Term'
		);

		?>
	</section>
	<section class="sidebar_1__Item">
		<h2 class="title_lv3_1">タグ</h2>

		<?php

		echo neon_the_term_list(
			neon_get_template_post_data( 'post_tag' ),
			'term_2',
			'term_2__List',
			'sidebar_1__Term'
		);

		?>
	</section>
	<section class="sidebar_1__Item">
		<h2 class="title_lv3_1">アーカイブ</h2>

		<button class="nn_button_toggle_1"
		        data-click="toggleDisplay">
			月間アーカイブ
		</button>

		<div class="_Hidden"
		     data-action="toggleDisplay">
			<ul class="nn_wp_archiveList_1">
				<?php

				$args = array(
					'type'            => 'monthly',
					'format'          => 'html',
					'show_post_count' => true,
					'post_type'       => 'post',
					'echo'            => 0,
				);
				$month_item_archive = wp_get_archives( $args );

				echo preg_replace(
					'/<\/a>&nbsp;(\([0-9]*\))/',
					' <span class="nn_wp_archiveList_1__count">$1</span></a>',
					$month_item_archive
				);

				?>
			</ul>
		</div>
	</section>
	<section class="sidebar_1__Item">
		<h2 class="title_lv3_1">記事を検索</h2>

		<form class="nn_form_searchBox_1"
		      method="get"
		      action="<?php echo esc_url( home_url( '/' . neon_the_post_data( 'name' ) . '/' ) ); ?>"
		      role="search">
			<div class="nn_form_searchBox_1__Input">
				<input class="nn_form_parts_text_2 _Sanitize_Text"
				       type="text"
				       name="s"
				       value="<?php echo $_GET['s']; ?>"
				       placeholder="<?php echo neon_the_post_data(); ?>を検索">
			</div>
			<div class="nn_form_searchBox_1__Submit">
				<button class="nn_form_parts_submit_2"
				        type="submit"></button>
			</div>
		</form>
	</section>
</div><!-- sidebar_1 -->
