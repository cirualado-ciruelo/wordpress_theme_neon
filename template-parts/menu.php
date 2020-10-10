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
		<li class="menu_1__item">
			<a class="__inner -current_about"
			   href="<?php echo neon_config( 'menu' )['about']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['about']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_company"
			   href="<?php echo neon_config( 'menu' )['company']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['company']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_blog"
			   href="<?php echo neon_config( 'menu' )['blog']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['blog']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_staff"
			   href="<?php echo neon_config( 'menu' )['staff']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['staff']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_info"
			   href="<?php echo neon_config( 'menu' )['information']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['information']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_contact"
			   href="<?php echo neon_config( 'menu' )['contact']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['contact']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_contact"
			   href="<?php echo neon_config( 'menu' )['blog_c_voice']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['blog_c_voice']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner"
			   href="<?php echo home_url( '/aaa' ); ?>">404</a>
		</li>
	</ul>
	<?php

endif;

if ( 'hamburger' === $place ) :

	?>
	<ul class="menu_2">
		<li class="menu_2__item -current_about">
			<a class="__inner"
			   href="<?php echo neon_config( 'menu' )['about']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['about']['label']; ?>
			</a>
		</li>
		<li class="menu_2__item -current_about">
			<a class="__inner"
			   href="<?php echo neon_config( 'menu' )['company']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['company']['label']; ?>
			</a>
		</li>
		<li class="menu_2__item -current_staff">
			<a class="__inner"
			   href="<?php echo neon_config( 'menu' )['staff']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['staff']['label']; ?>
			</a>
		</li>
		<li class="menu_2__item -current_contact">
			<a class="__inner"
			   href="<?php echo neon_config( 'menu' )['contact']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['contact']['label']; ?>
			</a>
		</li>
		<li class="menu_2__item">
			<a class="__inner"
			   href="<?php echo home_url( '/aaa' ); ?>">404</a>
		</li>
	</ul>
	<?php

endif;

if ( 'footer' === $place ) :

	?>
	<ul class="menu_1">
		<li class="menu_1__item">
			<a class="__inner -name_about"
			   href="<?php echo neon_config( 'menu' )['about']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['about']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_company"
			   href="<?php echo neon_config( 'menu' )['company']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['company']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_blog"
			   href="<?php echo neon_config( 'menu' )['blog']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['blog']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_staff"
			   href="<?php echo neon_config( 'menu' )['staff']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['staff']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_info"
			   href="<?php echo neon_config( 'menu' )['information']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['information']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_contact"
			   href="<?php echo neon_config( 'menu' )['contact']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['contact']['label']; ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_contact"
			   href="<?php echo neon_config( 'menu' )['blog_c_voice']['link']; ?>">
			   <?php  echo neon_config( 'menu' )['blog_c_voice']['label']; ?>
			</a>
		</li>
	</ul>
	<?php

endif;

if ( 'footer-sub' === $place ) :

	?>
	<div class="nn_list_link_1">
		<ul class="nn_list_link_1__list">
			<li class="nn_list_link_1__item">
				<a class="__inner"
				   href="<?php echo neon_config( 'menu' )['company']['link']; ?>">
				   <?php  echo neon_config( 'menu' )['company']['label']; ?>
				</a>
			</li>
			<li class="nn_list_link_1__item">
				<a class="__inner"
				   href="<?php echo neon_config( 'menu' )['privacy']['link']; ?>">
				   <?php  echo neon_config( 'menu' )['privacy']['label']; ?>
				</a>
			</li>
		</ul>
	</div><!-- /.nn_list_link_1 -->
	<?php

endif;

$args_site_menu = array();
