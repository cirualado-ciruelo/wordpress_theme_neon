<?php
/**
 * The template for displaying the top page
 *
 * 固定ページ：トップページの内容を表示します。
 *
 * @package WordPress
 * @since 1.0.0
 */

get_header();

?>
<section class="containerTree__branch -noPad">
	<div class="nn_hero_visual_1">
		<div class="nn_hero_visual_1__image">
			<img class="__src _full_inline"
			     src="<?php echo THEME_IMG_URL; ?>/hero_.jpg"
			     alt="">
			<img class="__src _lite_inline"
			     src="<?php echo THEME_IMG_URL; ?>/hero_lite.jpg"
			     alt="">
		</div><!-- /.nn_hero_visual_1__image -->
	</div><!-- /.nn_hero_visual_1 -->
</section><!-- /.containerTree__branch -->

<section class="containerTree__branch">
	<div class="_container">
		<h2 class="nn_title_lv1_1">SHIROBAKOについて</h2>

		<div class="_ladder">
			<p class="_text_1">
				上山高校アニメーション同好会の宮森あおい、安原絵麻、坂木しずか、<br class="_minL_inline">
				藤堂美沙、今井みどりの5人は、学園祭で自主制作アニメーションを発表し、<br class="_minL_inline">
				卒業後いつかもう一度、共に商業アニメーションを作ろうと<br class="_minL_inline">
				「ドーナツの誓い」を立てた。
			</p>

			<p class="_ladder__link _tac">
				<a class="nn_link_right_1"
				   href="<?php echo neon_link( 'about' ); ?>">詳しく見る</a>
			</p>
		</div><!-- /._ladder -->
	</div><!-- /._container -->
</section><!-- /.containerTree__branch -->

<section class="containerTree__branch">
	<div class="_container">
		<h2 class="nn_title_lv1_1">スタッフブログ</h2>

		<div class="_ladder">
			<?php

			$args_post = array(
				'post_type'      => 'post',
				'posts_per_page' => 3
			);
			$wp_query = new WP_Query( $args_post );

			if ( have_posts() ) :

				/**
				 * 投稿リスト
				 */
				get_template_part( 'template-parts/posts-post' );

				?>
				<p class="_ladder__link _tac">
					<a class="nn_link_right_1"
					   href="<?php echo neon_link( 'blog' ); ?>">詳しく見る</a>
				</p><!-- /._ladder__link -->
				<?php

			else :

				?>
				<p class="_nn_text_1">記事がありません。</p>
				<?php

			endif;

			wp_reset_query();

			?>
		</div><!-- /._ladder -->
	</div><!-- /._container -->
</section><!-- /.containerTree__branch -->

<section class="containerTree__branch _bg_color_gray_1">
	<div class="_container">
		<h2 class="nn_title_lv1_1">ご依頼お待ちしてます！</h2>

		<div class="_ladder">
			<p class="_nn_text_1">
				武蔵野アニメーションでは、アニメの制作、CM撮影、Web制作などのクリエイティブ実績がたくさんあります。<br>
				共に切磋琢磨して作品を造っていただける仲間や、制作依頼など随時募集中です！<br>
				下記お問い合わせフォームよりご連絡お待ちしております！
			</p>

			<p class="_ladder__link _tac">
				<a class="nn_link_plane_1"
				   href="<?php echo neon_link( 'contact' ); ?>">
					<?php echo neon_link( 'contact', 'label' ); ?>
				</a>
			</p>
		</div><!-- /._ladder -->
	</div><!-- /._container -->
</section><!-- /.containerTree__branch -->
<?php

get_footer();
