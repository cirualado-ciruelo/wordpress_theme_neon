<?php
/**
 * メニュー
 *
 * @package WordPress
 * @since 1.0.0
 */

if ( 'global' === $place ) :

	?>
	<ul class="menu_1">
		<?php

		$anc_system_page_id = neon_get_data_from_system_page_id( '', 'get_anc' );

		foreach ( neon_config( 'global_menu' ) as $menu ) :

			?>
			<li class="menu_1__item">
				<a class="__inner <?php
					echo '-icon_' . $menu['label']['en'];
					echo $menu['pid'] === $anc_system_page_id ? ' -current' : ''; ?>"
				   href="<?php echo $menu['link']; ?>">
					<?php echo $menu['label']['ja']; ?>
				</a>
			</li>
			<?php

		endforeach;

		?>
	</ul>
	<?php

endif;

$args_site_menu = array();
