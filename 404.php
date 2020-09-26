<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @since 1.0.0
 */

get_header();

?>
<div class="containerTree__branch">
	<div class="_container">
		<p class="_nn_text_1">
			ご指定いただいたページが見つかりませんでした。<br>
			お探しのページは一時的にアクセスできない状況にあるか、<br class="_full_inline">
			移動もしくは削除された可能性があります。
		</p>
	</div><!-- /._container -->
</div><!-- /.containerTree__branch -->

<div class="containerTree__branch">
	<div class="_container">
		<h2 class="nn_title_lv1_1">サイト内検索</h2>

		<div class="_ladder">
			<form class="nn_form_searchBox_1 -size_1"
			      method="get"
			      action="<?php echo esc_url( home_url() ); ?>"
			      role="search">
				<div class="nn_form_searchBox_1__input">
					<input class="nn_form_parts_text_2 _sanitize_text"
					       type="text"
					       name="s"
					       value="<?php echo $_GET['s']; ?>"
					       placeholder="フリーワード検索">
				</div>
				<div class="nn_form_searchBox_1__submit">
					<button class="nn_form_parts_submit_2"
					        type="submit"></button>
				</div>
			</form>
			<p class="_nn_text_1">
				<a class="nn_link_left_1"
				   href="<?php echo esc_url( home_url() ); ?>">トップページへ戻る</a>
			</p>
		</div><!-- /._ladder -->
	</div><!-- /._container -->
</div><!-- /.containerTree__branch -->
<?php

get_footer();
