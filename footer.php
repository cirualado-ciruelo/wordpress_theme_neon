<?php
/**
 * The template for displaying the footer
 *
 * </div>
 * <!-- /.PrimaryContainer -->
 * までを全ページ共通で表示します。
 *
 * サイドバーが無いページは、
 *     </article>
 * <!-- /.ContainerTree -->
 * </main>
 * <!-- /.PrimaryContainer__Torso -->
 * までを全ページ共通で表示します。
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
					<section class="ContainerTree__Branch">
						<div class="_Container">
							<div class="nn_banner_1">
								<ul class="nn_banner_1__List">
									<li class="nn_banner_1__Item">
										<a class="__Inner _Block"
										   target="_blank" 
										   href="<?php echo neon_link( 'anime_shirobako' ); ?>">
											<img class="__Src"
											     src="<?php echo THEME_IMG_URL; ?>/banners_1.jpg"
											     alt="">
										</a>
									</li>
									<li class="nn_banner_1__Item">
										<a class="__Inner _Block"
										   target="_blank" 
										   href="<?php echo neon_link( 'anime_shirobako' ); ?>">
											<img class="__Src"
											     src="<?php echo THEME_IMG_URL; ?>/banners_2.jpg"
											     alt="">
										</a>
									</li>
									<li class="nn_banner_1__Item">
										<a class="__Inner _Block"
										   target="_blank" 
										   href="<?php echo neon_link( 'anime_shirobako' ); ?>">
											<img class="__Src" 
											     src="<?php echo THEME_IMG_URL; ?>/banners_3.jpg"
											     alt="">
										</a>
									</li>
								</ul>
							</div>
							<!-- /.nn_banner_1 -->
						</div>
						<!-- /._Container -->
					</section>
					<!-- /.ContainerTree__Branch -->
					<?php

					if ( ! neon_is_sidebar() ) :

						?>
				</article>
				<!-- /.ContainerTree -->
			</main>
			<!-- /.PrimaryContainer__Torso -->
			<?php

					// ! neon_is_sidebar()
					endif;

	?>
	</div>
	<!-- /.PrimaryContainer__Body -->

	<button class="button_PageTop"
	        type="button"
	        title="ページのトップへ戻る" 
	        data-click="scrolToPageTop"
	        data-scroll="anyTimingToggle"></button>
</div>
<!-- /.PrimaryContainer -->

<footer class="Footer">
	<div class="Footer__Ladder _Container">
		<div class="Footer__group_1">
			<div class="Footer__group_2">
				<?php

				neon_the_menu( 'footer' );

				?>
			</div>
			<!-- /.Footer__group_2 -->
			<div class="Footer__group_3">
				<div class="_Ladder">
					<p class="Footer__Logo">
						<img class="__Src"
						     src="<?php echo THEME_IMG_URL; ?>/logo_neonWh.svg"
						     alt="">
					</p>
					<address class="Footer__Address">
						<p>
							〒939-1835 富山県南砺市立野原東1508-8<br>
							TEL|0763-62-4139
						</p>
					</address>
				</div>
				<!-- /._Ladder -->
			</div>
			<!-- /.Footer__group_3 -->
		</div>
		<!-- /.Footer__group_1 -->
		<div class="Footer__group_4">
			<div class="_Ladder">
				<?php

				/**
				 * ソーシャルリンク.
				 */
				get_template_part( 'template-parts/sns', 'link' );

				neon_the_menu( 'footer-sub' );

				?>
			</div>
			<!-- /._Ladder -->
		</div>
		<!-- /.Footer__group_4 -->

		<small class="Footer__Copyright">&copy; <?php echo date( 'Y' ); ?> SHIROBAKO 製作委員</small>
	</div>
	<!-- /._Container -->
</footer>
<!-- /.Footer -->
<?php

// HTML圧縮End（出力）
neon_the_ob_replace();

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
</div>
<!-- /._Body -->
</body>
</html>
