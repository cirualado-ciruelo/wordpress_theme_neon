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
	<div class="_container">
		<small class="site_footer__copyright">&copy; <?php echo date( 'Y' ); ?> copyright</small>
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
