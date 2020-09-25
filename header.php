<?php
/**
 * The header for our theme
 *
 * <head></head>内の情報を記述.
 *
 * <div class="siteContents">
 * までを全ページ共通で表示します.
 *
 * サイドバーが無いページは、
 * <main class="PrimaryContainer__Torso">
 *     <article class="ContainerTree">
 * までを全ページ共通で表示します.
 *
 * @package WordPress
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html data-ua="<?php echo neon_is_ua(); ?>"
      data-browser="<?php echo neon_is_browser(); ?>"
      <?php language_attributes(); ?> >
<head prefix="og: http://ogp.me/ns#
              fb: http://ogp.me/ns/fb#
              <?php echo neon_is_og_type(); ?>: http://ogp.me/ns/<?php echo neon_is_og_type(); ?>#">

<?php

	/*
	 * トラッキングコード設定
	 *
	 * !!! ログインしている時・検索インデックスを回避している時は計測されません。
	 */
	if ( neon_is_public()
		 && ( function_exists( 'acf_add_options_page' )
		      && get_field( 'acf_site_tag_head', 'option' ) )
		 && ! is_user_logged_in()
	) {
		the_field( 'acf_site_tag_head', 'option' );
	}

?>


	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" id="viewport" content="width=device-width,user-scalable=0">
	<meta name="format-detection" content="telephone=no">
	<meta charset="UTF-8">
<?php

if ( neon_is_custom_meta() ) {

	/**
	 * SEO設定ファイル.
	 */
	get_template_part( 'template-parts/meta' );
}

?>
<!-- wp_head -->
<?php wp_head(); ?>
<!-- /wp_head -->
<?php

// インラインスタイル
// if ( is_user_logged_in() ) :

	?>
	<!-- <style>

	</style> -->
	<?php

// endif;

?>
</head>

<body <?php body_class() ?>>

<?php

/*
 * トラッキングコード設定
 *
 * !!! ログインしている時・検索インデックスを回避している時は計測されません。
 */
if ( neon_is_public() && get_field( 'acf_site_tag_body', 'option' ) && ! is_user_logged_in() ) {
	the_field( 'acf_site_tag_body', 'option' );
}

wp_body_open();

?>
<script>
    const viewport = document.getElementsByName('viewport')[0];

    if ( innerWidth < 375 ) {
      viewport.setAttribute('content', 'width=375, user-scalable=0');
    } else {
      viewport.setAttribute('content', 'width=device-width, user-scalable=0');
    }
</script>


<div class="_Body">
<?php

// HTML圧縮Start
// ob_start();

?>
<header class="Header">
	<div class="Header__Body">
		<div class="_Container">
			<div class="Header__group_1">
				<div class="Header__group_2">
					<?php is_front_page() ? $header_logo_tag = 'h1' : $header_logo_tag = 'p'; ?>
					<<?php echo $header_logo_tag; ?> class="Header__Logo">
						<a class="__Inner _Block"
						   href="<?php echo esc_url( home_url() ); ?>">
							<img class="Header__SrcLogo"
							     src="<?php echo THEME_IMG_URL; ?>/logo_neon_.svg"
							     alt="<?php echo get_bloginfo( 'name' ); ?>">
						</a>
					</<?php echo $header_logo_tag; ?>>
				</div><!-- /.Header__group_2 -->
				<div class="Header__group_3">
					<nav class="Globalnav _MinL_block">
						<?php

						neon_the_menu( 'global' );

echo neon_get_data_from_system_page_id( 'p1', 'link' );

						?>
					</nav>
					<button class="button_HamburgerMenu _MaxL_block"
					        type="button"
					        data-click="hamburgerMenu"
					        title="全てのメニュー"></button>
				</div><!-- /.Header__group_3 -->
			</div><!-- /.Header__group_1 -->
		</div><!-- /._Container -->
	</div><!-- /.Header__Body -->
</header><!-- /.Header -->

<div class="PrimaryContainer">
	<div class="HamburgerMenu"
	     data-action="hamburgerMenu">
		<?php

		neon_the_menu( 'hamburger' );

		/**
		 * ソーシャルリンク.
		 */
		get_template_part( 'template-parts/sns', 'link' );

		?>
	</div><!-- /.HamburgerMenu -->

	<div class="PrimaryContainer__Body">
		<?php

		/**
		 * ページヘッダー.
		 */
		get_template_part( 'template-parts/page', 'header' );

		if ( ! neon_is_sidebar() ) :

			?>
			<main class="PrimaryContainer__Torso">
				<article class="ContainerTree">
			<?php

		endif;
