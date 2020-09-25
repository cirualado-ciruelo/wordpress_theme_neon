<?php
/**
 * ACF functions
 *
 * @package WordPress
 * @since 1.0.0
 */

/**
 * フィールドグループ：サイト設定.
 */
require_once neon_locate_inc( 'plugin-acf-field_group-site_settings' );

/**
 * ACFオプションページ設置
 *
 * @since 1.0.0
 */
function neon_acf_add_options() {
	$option_page = array(
		'page_title' => 'サイト設定',
		'menu_title' => 'サイト設定',
		'menu_slug'  => 'acf_site_settings',
		'redirect'   => false,
	);

	acf_add_options_page( $option_page );

	$child_option_page = array(
		'page_title'  => '投稿タイプメタ',
		'menu_title'  => '投稿タイプメタ',
		'menu_slug'   => 'acf_post_type_settings',
		'parent_slug' => $option_page['menu_slug'],
	);

	acf_add_options_page( $child_option_page );

	// $child_option_page = array(
	// 	'page_title'  => 'トップページスライダー',
	// 	'menu_title'  => 'トップページスライダー',
	// 	'menu_slug'   => 'acf_slider_front_page',
	// 	'parent_slug' => $option_page['menu_slug'],
	// );

	// acf_add_options_page( $child_option_page );
}

add_action( 'acf/init', 'neon_acf_add_options' );

/**
 * フィールドタイプのテンプレートセット
 *
 * @since 1.0.0
 */
function neon_acf_fieldset( $key, $label, $name, $type, $option = null ) {
	$url = array(
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'url',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
	);
	$text = array(
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	);
	$textarea = array(
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'textarea',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'maxlength' => '',
		'rows' => '',
		'new_lines' => 'br',
	);
	$tab = array(
		'key' => $key,
		'label' => $label,
		'name' => '',
		'type' => 'tab',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'placement' => 'top',
		'endpoint' => 0,
	);
	$file = array(
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'file',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'return_format' => 'url',
		'library' => 'all',
		'min_size' => '',
		'max_size' => '',
		'mime_types' => '',
	);
	$image = array(
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'image',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'return_format' => 'array',
		'preview_size' => 'medium',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',
	);
	$true_false = array(
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => '',
		'default_value' => 0,
		'ui' => 0,
		'ui_on_text' => '',
		'ui_off_text' => '',
	);
	$repeater = array(
		'key' => $key,
		'label' => $label,
		'name' => $name,
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 0,
		'max' => 0,
		'layout' => 'table',
		'button_label' => '',
		'sub_fields' => array()
	);
	$sub_fields = array(
		'key' => $key,
		'label' => 'sub',
		'name' => 'sub',
		'type' => '',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
	);

	$types = array(
		'url'        => $url,
		'text'       => $text,
		'textarea'   => $textarea,
		'tab'        => $tab,
		'file'       => $file,
		'image'      => $image,
		'true_false' => $true_false,
		'repeater' => $repeater,
		'sub_fields' => $sub_fields,
	);

	$return = $types[ $type ];

	if ( $option ) {
		$return = array_replace( $return, $option );
	}

	return $return;
}
