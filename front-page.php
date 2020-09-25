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
<section class="ContainerTree__Branch -noPad">
	<div class="nn_hero_visual_1">
		<div class="nn_hero_visual_1__Image">
			<img class="__Src _Full_inline"
			     src="<?php echo THEME_IMG_URL; ?>/hero_.jpg"
			     alt="">
			<img class="__Src _Lite_inline"
			     src="<?php echo THEME_IMG_URL; ?>/hero_lite.jpg"
			     alt="">
		</div>
		<!-- /.nn_hero_visual_1__Image -->
	</div>
	<!-- /.nn_hero_visual_1 -->
</section>
<!-- /.ContainerTree__Branch -->

<section class="ContainerTree__Branch">
	<div class="_Container">
		<h2 class="nn_title_lv1_1">SHIROBAKOについて</h2>

		<div class="_Ladder">
			<p class="nn_card_1__Text">
				上山高校アニメーション同好会の宮森あおい、安原絵麻、坂木しずか、<br class="_MinL_inline">
				藤堂美沙、今井みどりの5人は、学園祭で自主制作アニメーションを発表し、<br class="_MinL_inline">
				卒業後いつかもう一度、共に商業アニメーションを作ろうと<br class="_MinL_inline">
				「ドーナツの誓い」を立てた。
			</p>

			<p class="_Ladder__Link _Tac">
				<a class="nn_link_right_1"
				   href="<?php echo neon_link( 'about' ); ?>">詳しく見る</a>
			</p>
		</div>
		<!-- /._Ladder -->
	</div>
	<!-- /._Container -->
</section>
<!-- /.ContainerTree__Branch -->

<section class="ContainerTree__Branch">
	<div class="_Container">
		<h2 class="nn_title_lv1_1">スタッフブログ</h2>

		<div class="_Ladder">
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
				<p class="_Ladder__Link _Tac">
					<a class="nn_link_right_1"
					   href="<?php echo neon_link( 'blog' ); ?>">詳しく見る</a>
				</p>
				<!-- /._Ladder__Link -->
				<?php

			else :

				?>
				<p class="_nn_text_1">記事がありません。</p>
				<?php

			endif;

			wp_reset_query();

			?>
		</div>
		<!-- /._Ladder -->
	</div>
	<!-- /._Container -->
</section>
<!-- /.ContainerTree__Branch -->

<section class="ContainerTree__Branch _bg_color_gray_1">
	<div class="_Container">
		<h2 class="nn_title_lv1_1">ご依頼お待ちしてます！</h2>

		<div class="_Ladder">
			<p class="_nn_text_1">
				武蔵野アニメーションでは、アニメの制作、CM撮影、Web制作などのクリエイティブ実績がたくさんあります。<br>
				共に切磋琢磨して作品を造っていただける仲間や、制作依頼など随時募集中です！<br>
				下記お問い合わせフォームよりご連絡お待ちしております！
			</p>

			<p class="_Ladder__Link _Tac">
				<a class="nn_link_plane_1"
				   href="<?php echo neon_link( 'contact' ); ?>">
					<?php echo neon_link( 'contact', 'label' ); ?>
				</a>
			</p>
		</div>
		<!-- /._Ladder -->
	</div>
	<!-- /._Container -->
</section>
<!-- /.ContainerTree__Branch -->
<?php

get_footer();
