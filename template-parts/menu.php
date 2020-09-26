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
			   href="<?php echo neon_link( 'about' ); ?>">
			   <?php  echo neon_link( 'about', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_company"
			   href="<?php echo neon_link( 'company' ); ?>">
			   <?php  echo neon_link( 'company', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_blog"
			   href="<?php echo neon_link( 'blog' ); ?>">
			   <?php  echo neon_link( 'blog', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_staff"
			   href="<?php echo neon_link( 'staff' ); ?>">
			   <?php  echo neon_link( 'staff', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_info"
			   href="<?php echo neon_link( 'information' ); ?>">
			   <?php  echo neon_link( 'information', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_contact"
			   href="<?php echo neon_link( 'contact' ); ?>">
			   <?php  echo neon_link( 'contact', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -current_contact"
			   href="<?php echo neon_link( 'blog_c_voice' ); ?>">
			   <?php  echo neon_link( 'blog_c_voice', 'label' ); ?>
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
			   href="<?php echo neon_link( 'about' ); ?>">
			   <?php  echo neon_link( 'about', 'label' ); ?>
			</a>
		</li>
		<li class="menu_2__item -current_about">
			<a class="__inner"
			   href="<?php echo neon_link( 'company' ); ?>">
			   <?php  echo neon_link( 'company', 'label' ); ?>
			</a>
		</li>
		<li class="menu_2__item -current_staff">
			<a class="__inner"
			   href="<?php echo neon_link( 'staff' ); ?>">
			   <?php  echo neon_link( 'staff', 'label' ); ?>
			</a>
		</li>
		<li class="menu_2__item -current_contact">
			<a class="__inner"
			   href="<?php echo neon_link( 'contact' ); ?>">
			   <?php  echo neon_link( 'contact', 'label' ); ?>
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
			   href="<?php echo neon_link( 'about' ); ?>">
			   <?php  echo neon_link( 'about', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_company"
			   href="<?php echo neon_link( 'company' ); ?>">
			   <?php  echo neon_link( 'company', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_blog"
			   href="<?php echo neon_link( 'blog' ); ?>">
			   <?php  echo neon_link( 'blog', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_staff"
			   href="<?php echo neon_link( 'staff' ); ?>">
			   <?php  echo neon_link( 'staff', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_info"
			   href="<?php echo neon_link( 'information' ); ?>">
			   <?php  echo neon_link( 'information', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_contact"
			   href="<?php echo neon_link( 'contact' ); ?>">
			   <?php  echo neon_link( 'contact', 'label' ); ?>
			</a>
		</li>
		<li class="menu_1__item">
			<a class="__inner -name_contact"
			   href="<?php echo neon_link( 'blog_c_voice' ); ?>">
			   <?php  echo neon_link( 'blog_c_voice', 'label' ); ?>
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
				   href="<?php echo neon_link( 'company' ); ?>">
				   <?php  echo neon_link( 'company', 'label' ); ?>
				</a>
			</li>
			<li class="nn_list_link_1__item">
				<a class="__inner"
				   href="<?php echo neon_link( 'privacy' ); ?>">
				   <?php  echo neon_link( 'privacy', 'label' ); ?>
				</a>
			</li>
		</ul>
	</div><!-- /.nn_list_link_1 -->
	<?php

endif;

$args_site_menu = array();
