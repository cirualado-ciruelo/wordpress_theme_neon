<?php
/**
 * パンくず
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

$item_class      = 'breadcrumb__item';
$item_body_class = 'breadcrumb__body';
$micro_data = array(
	'url'  => 'https://schema.org/',
	'list' => 'breadcrumbList',
	'item' => 'ListItem',
);

$itemtype = $micro_data['url'] . $micro_data['item'];

$item_data = array(
	'トップ' => array(
		'prop' => 'itemListElement',
		'type' => $itemtype,
		'body' => array(
			'href' => esc_url( home_url() ),
			'prop' => 'item',
		),
	),
);
$nolink_item_data = array(
	'prop' => 'item',
	'type' => $itemtype,
	'body' => array(
		'href' => '',
		'prop' => 'item',
	),
);
$posts_item_data = array(
	'prop' => 'item',
	'type' => $itemtype,
	'body' => array(
		'href' => neon_the_post_data( 'link' ),
		'prop' => 'item',
	),
);

if ( is_archive() || is_home() ) {
	$query_var_year  = get_query_var( 'year' ) . '年';
	$query_var_month = get_query_var( 'monthnum' ) . '月';
	$query_var_day   = get_query_var( 'day' ) . '日';

	$item_data[ get_post_type_object( neon_get_current_post_type() )->label ] = $nolink_item_data;

	if ( is_tax() || is_category() || is_tag() ) {
		$item_data[ get_post_type_object( neon_get_current_post_type() )->label ] = $posts_item_data;
		$item_data[ get_queried_object()->name ] = $nolink_item_data;
	} elseif ( is_date() ) {
		$item_data[ get_post_type_object( neon_get_current_post_type() )->label ] = $posts_item_data;

		if ( is_year() ) {
			$item_data[ $query_var_year . 'の記事' ] = $nolink_item_data;
		} elseif ( is_month() ) {
			$item_data[ $query_var_year . $query_var_month . 'の記事' ] = $nolink_item_data;
		} elseif ( is_day() ) {
			$item_data[ $query_var_year . $query_var_month . $query_var_day . 'の記事' ] = $nolink_item_data;
		}
	}
} elseif ( is_page() ) {
	foreach ( array_reverse( get_post_ancestors( $post->ID ) ) as $post_parent_id ) {
		$item_data[ get_page( $post_parent_id )->post_title ] = array(
			'prop' => 'item',
			'type' => $itemtype,
			'body' => array(
				'href' => esc_url( get_page_link( $post_parent_id ) ),
				'prop' => 'item',
			),
		);
	}

	$item_data[ get_the_title() ] = $nolink_item_data;
} elseif ( is_single() ) {
	$item_data[ get_post_type_object( neon_get_current_post_type() )->label ] = $posts_item_data;
	$item_data[ get_the_title() ] = $nolink_item_data;
} elseif ( is_404() ) {
	$item_data['404'] = $nolink_item_data;
}

if ( $_GET['s'] ) {
	$result_item_name = '"' . $_GET['s'] . '"の検索結果';

	if ( 'any' !== $wp_query->query_vars['post_type'] ) {

		// 投稿ページなら投稿名も出力
		$result_item_name .= '<small>（' . get_post_type_object( neon_get_current_post_type() )->label . '）</small>';
	}

	$item_data[ $result_item_name ] = $nolink_item_data;
}

?>
<div class="breadcrumb">
	<div class="_container">
		<ol class="breadcrumb__list"
		    itemscope
		    itemtype="<?php echo $micro_data['url'] . $micro_data['list']; ?>">

			<?php
			$item_count = 1;

			foreach ( $item_data as $item => $data ) :
				if ( $data['body']['href'] ) {
					$body_tag = 'a';
				} else {
					$body_tag = 'span';
				}

				?>
				<li class="<?php echo $item_class; ?>"
				    itemprop="<?php echo $data['prop'] ?>"
				    itemscope
				    itemtype="<?php echo $data['type'] ?>">
					<<?php echo $body_tag; ?>
					  class="<?php echo $item_body_class; ?>"
					  <?php if ( $data['body']['href'] ) : ?>
					  	href="<?php echo $data['body']['href']; ?>"
					  <?php endif; ?>
					  itemprop="<?php echo $data['body']['prop'] ?>">
						<span itemprop="name"><?php echo $item; ?></span>
						<meta itemprop="position"
						      content="<?php echo $item_count++; ?>">
					</<?php echo $body_tag; ?>>
				</li>
				<?php

			endforeach;

			?>
		</ol>
	</div>
	<!-- /._Container -->
</div>
<!-- /.breadcrumb -->
