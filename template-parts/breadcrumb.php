<?php
/**
 * パンくず
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

$bread_crumb_class      = ' class="Breadcrumb__Item"';
$bread_crumb_body_class = ' class="Breadcrumb__Link"';
$bread_crumb_itemprop_position = 1;

$bread_crumb_micro_data = array(
	'url'  => 'https://schema.org/',
	'list' => 'BreadcrumbList',
	'item' => 'ListItem',
);
$bread_crumb_micro_data_item = ' itemprop="itemListElement" 
itemscope 
itemtype="' . $bread_crumb_micro_data['url'] . $bread_crumb_micro_data['item'] . '"';
// $bread_crumb_micro_data_item

// パンくず：投稿
$bread_crumb_post_item = '<li'
. $bread_crumb_class
. $bread_crumb_micro_data_item . '>
	<a ' . $bread_crumb_body_class . ' href="' . esc_url( neon_the_post_data( 'link' ) ) . '" itemprop="item">
		<span itemprop="name">'
			. neon_the_post_data( 'label' )
		. '</span>
		<meta itemprop="position" content="2">
	</a>
</li>';

if ( is_tax() || is_category() || is_tag() ) {
	$bread_crumb_itemprop_position++;

	$bread_crumb_last_item_name = get_queried_object()->name;
	$bread_crumb_next_item      = $bread_crumb_post_item. '<li' . $bread_crumb_class . $bread_crumb_micro_data_item . '>
		<span itemprop="name">' . $bread_crumb_last_item_name . '</span>
		<meta itemprop="position" 
		      content="' . $bread_crumb_itemprop_position . '">
	</li>';
} elseif ( is_archive() || is_home() ) {
	$bread_crumb_itemprop_position = 2;
	$bread_crumb_last_item_name    = neon_the_post_data( 'label' );
	$query_var_year                = get_query_var( 'year' ) . '年';
	$query_var_month               = get_query_var( 'monthnum' ) . '月';
	$query_var_day                 = get_query_var( 'day' ) . '日';

	if ( is_date() ) {
		$bread_crumb_itemprop_position++;

		$bread_crumb_next_item = $bread_crumb_post_item;

		if ( is_year() ) {
			$bread_crumb_last_item_var = $query_var_year;
		} elseif ( is_month() ) {
			$bread_crumb_last_item_var = $query_var_year . $query_var_month;
		} elseif ( is_day() ) {
			$bread_crumb_last_item_var = $query_var_year . $query_var_month . $query_var_day;
		}

		$bread_crumb_last_item_name = $bread_crumb_last_item_var . 'の記事';
	}

	$bread_crumb_next_item .= '<li' . $bread_crumb_class . $bread_crumb_micro_data_item . '>
		<span itemprop="name">' . $bread_crumb_last_item_name . '</span>
		<meta itemprop="position" 
		      content="' . $bread_crumb_itemprop_position . '">
	</li>';
} elseif ( is_page() ) {
	$bread_crumb_next_item         = '';
	$bread_crumb_itemprop_position = 2;

	foreach ( array_reverse( get_post_ancestors( $post->ID ) ) as $post_parent_id ) {
		$bread_crumb_next_item .= '
			<li'
			. $bread_crumb_class
			. $bread_crumb_micro_data_item . '>
				<a ' . $bread_crumb_body_class . 'href="' . esc_url( get_page_link( $post_parent_id ) ) . '" 
				itemprop="item">
					<span itemprop="name">'
						. get_page( $post_parent_id )->post_title
					. '</span>
					<meta itemprop="position" content="' . $bread_crumb_itemprop_position++ . '">
				</a>
			</li>
		';
	}

	$bread_crumb_last_item_name  = get_the_title();
	$bread_crumb_next_item      .= '<li' . $bread_crumb_class . $bread_crumb_micro_data_item . '>
		<span itemprop="name">' . $bread_crumb_last_item_name . '</span>
		<meta itemprop="position" 
		      content="' . $bread_crumb_itemprop_position++ . '">
	</li>';
} elseif ( is_single() ) {
	$bread_crumb_itemprop_position++;

	$bread_crumb_next_item = '<li' . $bread_crumb_class . $bread_crumb_micro_data_item . '>
		<span itemprop="name">' . get_the_title() . '</span>
		<meta itemprop="position" 
		      content="' . $bread_crumb_itemprop_position . '">
	</li>';
} elseif ( is_404() ) {
	$bread_crumb_itemprop_position++;

	$bread_crumb_last_item_name = '404 Not found.';
	$bread_crumb_next_item     .= '<li' . $bread_crumb_class . $bread_crumb_micro_data_item . '>
		<span itemprop="name">' . $bread_crumb_last_item_name . '</span>
		<meta itemprop="position" 
		      content="' . $bread_crumb_itemprop_position . '">
	</li>';
}

if ( $_GET['s'] ) {
	$bread_crumb_itemprop_position++;

	$bread_crumb_last_item_name = '"' . $_GET['s'] . '"の検索結果';

	if ( 'any' !== $wp_query->query_vars['post_type'] ) {

		// 投稿ページなら投稿名も出力
		$bread_crumb_last_item_name .= '<small>（' . neon_the_post_data( 'label' ) . '）</small>';
	}

	$bread_crumb_next_item = '<li' . $bread_crumb_class . $bread_crumb_micro_data_item . '>
		<span itemprop="name">' . $bread_crumb_last_item_name . '</span>
		<meta itemprop="position" 
		      content="' . $bread_crumb_itemprop_position . '">
	</li>';
}

?>
<div class="Breadcrumb">
	<div class="_Container -larger_03">
		<ol class="Breadcrumb__List" 
		    itemscope 
		    itemtype="<?php echo $bread_crumb_micro_data['url'] . $bread_crumb_micro_data['list']; ?>">
			<li <?php echo $bread_crumb_class; ?> 
			    itemprop="itemListElement"
			    itemscope
			    itemtype="<?php echo $bread_crumb_micro_data['url'] . $bread_crumb_micro_data['item']; ?>">
				<a <?php echo $bread_crumb_body_class; ?> 
				   href="<?php echo esc_url( home_url() ); ?>"
				   itemprop="item">
					<span itemprop="name">HOME</span>
					<meta itemprop="position"
					      content="1">
				</a>
			</li>
			<?php echo $bread_crumb_next_item; ?>
		</ol>
	</div>
	<!-- /._Container -->
</div>
<!-- /.Breadcrumb -->
