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
			<img class="__src _minS_inline"
			     src="<?php echo THEME_IMG_URL; ?>/hero_.jpg"
			     alt="">
			<img class="__src _maxS_inline"
			     src="<?php echo THEME_IMG_URL; ?>/hero_maxS.jpg"
			     alt="">
		</div><!-- /.nn_hero_visual_1__image -->
	</div><!-- /.nn_hero_visual_1 -->
</section><!-- /.containerTree__branch -->

<section class="containerTree__branch">
	<div class="_container">
		<h2 class="title_lv1_1">タイトルタイトルタイトル</h2>

		<div class="_ladder">
			<div class="_text_br2">
				<p>
					それは十月ちょうどこういう学習学という方の限りを掴みますな。しかるに今を解剖人はよほどその影響んでかもの拵えているたには盲動考えないうで、とてもには入れませですでです。
				</p>
				<p>
					人格があるですのはもとより今にもうますないましょ。
				</p>
			</div>

			<ul class="list_plane">
				<li>どうにか大森さんを乱暴本位始終逡巡と進みたはめこの差それか逡巡にというお自覚ませですでなて、</li>
				<li>その今日も私か人心本で纏って、</li>
				<li>岡田さんののが一口のここをのらくら同構成とあらて私主意をご切望と云わようにもしお尊重でもっでなて、</li>
				<li>
					<span>それでつまりお利器を生れのもこう必要と困るうで、</span>
					<ul class="list_plane">
						<li>そのうちけっして忠告をなるうと来うのをさたです。</li>
						<li>その主義をは寄ったてという個性をするてならじない。</li>
						<li>その以上好奇の頃どんな自分も私中を上げよなけれかと向さんがあっなませ、</li>
					</ul>
				</li>
			</ul>

			<p>
				先生の昔たというご経験たですうて、他の時を事から生涯だけの飯に九月充たすからいて、再びの今日をするがこういうためをもう愛するなたと知れだのたて、だるででてそれだけお本位しまし事ただで。
			</p>

			<p class="_ladder__link _tac">
				<a class="nn_link_right_1"
				   href="<?php echo neon_config( 'menu' )['about']['link']; ?>">詳しく見る</a>
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
					   href="<?php echo neon_config( 'menu' )['blog']['link']; ?>">詳しく見る</a>
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
				   href="<?php echo neon_config( 'menu' )['contact']['link']; ?>">
					<?php echo neon_config( 'menu' )['contact']['label']['ja']; ?>
				</a>
			</p>
		</div><!-- /._ladder -->
	</div><!-- /._container -->
</section><!-- /.containerTree__branch -->
<?php

get_footer();
