<?php
/**
 * The template for displaying the footer
 *
 * </div>
 * <!-- /.primaryContainer -->
 * までを全ページ共通で表示します。
 *
 * サイドバーが無いページは、
 *     </article>
 * <!-- /.containerTree -->
 * </main>
 * <!-- /.primaryContainer__torso -->
 * までを全ページ共通で表示します。
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
					<section class="containerTree__branch">
						<div class="_container">
							<div class="nn_banner_1">
								<ul class="nn_banner_1__list">
									<li class="nn_banner_1__item">
										<a class="__inner _block"
										   target="_blank"
										   href="<?php echo neon_config( 'menu' )['anime_shirobako']['link']; ?>">
											<img class="__src"
											     src="<?php echo THEME_IMG_URL; ?>/banners_1.jpg"
											     alt="">
										</a>
									</li>
									<li class="nn_banner_1__item">
										<a class="__inner _block"
										   target="_blank"
										   href="<?php echo neon_config( 'menu' )['anime_shirobako']['link']; ?>">
											<img class="__src"
											     src="<?php echo THEME_IMG_URL; ?>/banners_2.jpg"
											     alt="">
										</a>
									</li>
									<li class="nn_banner_1__item">
										<a class="__inner _block"
										   target="_blank"
										   href="<?php echo neon_config( 'menu' )['anime_shirobako']['link']; ?>">
											<img class="__src"
											     src="<?php echo THEME_IMG_URL; ?>/banners_3.jpg"
											     alt="">
										</a>
									</li>
								</ul>
							</div><!-- /.nn_banner_1 -->
						</div><!-- /._container -->
					</section><!-- /.containerTree__branch -->
					<?php

					if ( ! neon_is_sidebar() ) :

						?>
				</article><!-- /.containerTree -->
			</main><!-- /.primaryContainer__torso -->
			<?php

					// ! neon_is_sidebar()
					endif;

	?>
	</div><!-- /.primaryContainer__body -->

	<button class="button_ageTop"
	        type="button"
	        title="ページのトップへ戻る"
	        data-click="scrolToPageTop"
	        data-scroll="anyTimingToggle"></button>
</div><!-- /.primaryContainer -->

<footer class="site_footer">
	<div class="site_footer__ladder _container">
		<div class="site_footer__group_1">
			<div class="site_footer__group_2">
				<?php

				neon_the_menu( 'footer' );

				?>
			</div><!-- /.site_footer__group_2 -->
			<div class="site_footer__group_3">
				<div class="_ladder">
					<p class="site_footer__logo">
						<img class="__src"
						     src="<?php echo THEME_IMG_URL; ?>/logo_neonWh.svg"
						     alt="">
					</p>
					<address class="site_footer__address">
						<p>
							〒939-1835 富山県南砺市立野原東1508-8<br>
							TEL|0763-62-4139
						</p>
					</address>
				</div><!-- /._ladder -->
			</div><!-- /.site_footer__group_3 -->
		</div><!-- /.site_footer__group_1 -->
		<div class="site_footer__group_4">
			<div class="_ladder">
				<?php

				/**
				 * ソーシャルリンク.
				 */
				get_template_part( 'template-parts/sns', 'link' );

				neon_the_menu( 'footer-sub' );

				?>
			</div><!-- /._ladder -->
		</div><!-- /.site_footer__group_4 -->

		<small class="site_footer__copyright">&copy; <?php echo date( 'Y' ); ?> SHIROBAKO 製作委員</small>
	</div><!-- /._container -->
</footer><!-- /.site_footer -->
<?php

// HTML圧縮End（出力）
if ( neon_is_content_compressed() ) {
	neon_the_ob_replace();
}

?>
<script>
	const WP_CONFIG = {
		'url': {
			'home': '<?php echo esc_url( home_url() ); ?>',
			'theme': '<?php echo THEME_URL; ?>',
			'themeImg': '<?php echo THEME_IMG_URL; ?>',
			'permaLink': '<?php echo get_the_permalink(); ?>'
		}
	};
</script>
<?php wp_footer(); ?>
</body>
</html>
