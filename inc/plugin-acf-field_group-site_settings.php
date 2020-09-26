<?php
/**
 * ACF フィールドグループ：サイト設定
 *
 * @package WordPress
 * @since 1.0.0
 * @subpackage Advanced Custom Fields
 */

/**
 * フィールドグループの設定
 *
 * @since 1.0.0
 */
function neon_acf_set_field_group_site_settings() {
	global $args_all_post_type;

	$post_type_all = get_post_types( $args_all_post_type );
	$post_type_all = $post_type_all + ['post', 'page'];
	$post_type_all = array_reverse( $post_type_all );
	$taxonomy_all  = get_taxonomies();

	/*
	 * システムID
	 */
	$system_page_id = array(
		'key' => 'group_5ee885e5cc494',
		'title' => 'システムID',
		'fields' => array(
			neon_acf_fieldset(
				'acf_page_system_id',
				'',
				'id',
				'text'
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	);

	/*
	 * トップページスライダー
	 */
	// $slider_front_page = array(
	// 	'key' => 'group_slider_front_page',
	// 	'title' => 'トップページスライダー',
	// 	'fields' => array(
	// 		neon_acf_fieldset(
	// 			'field_slider_front_page',
	// 			'スライダー',
	// 			'acf_slider_front_page',
	// 			'repeater',
	// 			array(
	// 				'button_label' => 'スライドを追加',
	// 				'sub_fields' => array(
	// 					neon_acf_fieldset(
	// 						'field_slider_front_page__image',
	// 						'画像',
	// 						'acf_slider_front_page__image',
	// 						'image',
	// 						array(
	// 							'return_format' => 'id',
	// 							'preview_size' => 'slider_front_page'
	// 						)
	// 					),
	// 					neon_acf_fieldset(
	// 						'field_slider_front_page__image_sp',
	// 						'画像スマホ',
	// 						'acf_slider_front_page__image_sp',
	// 						'image',
	// 						array(
	// 							'return_format' => 'id',
	// 							'preview_size' => 'slider_front_page_sp_S'
	// 						)
	// 					),
	// 					neon_acf_fieldset(
	// 						'field_slider_front_page__link',
	// 						'リンク',
	// 						'acf_slider_front_page__link',
	// 						'url',
	// 						array( 'return_format' => 'id' )
	// 					),
	// 					neon_acf_fieldset(
	// 						'field_slider_front_page__target',
	// 						'ウィンドウ',
	// 						'acf_slider_front_page__target',
	// 						'true_false',
	// 						array( 'message' => '新しいタブで開く' )
	// 					),
	// 				)
	// 			)
	// 		),
	// 	),
	// 	'location' => array(
	// 		array(
	// 			array(
	// 				'param' => 'options_page',
	// 				'operator' => '==',
	// 				'value' => 'acf_slider_front_page',
	// 			),
	// 		),
	// 	),
	// 	'menu_order' => 0,
	// 	'position' => 'normal',
	// 	'style' => 'default',
	// 	'label_placement' => 'top',
	// 	'instruction_placement' => 'label',
	// 	'hide_on_screen' => '',
	// 	'active' => true,
	// 	'description' => '',
	// );

	/*
	 * 投稿タイプメタ
	 */
	$post_type_settings = array(
		'key' => 'group_post_type_settings',
		'title' => '投稿タイプメタ',
		'fields' => array(),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf_post_type_settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	);

	/*
	 * サイト設定
	 */
	$site_settings = array(
		'key' => 'group_site_settings',
		'title' => 'サイト設定',
		'fields' => array(
			neon_acf_fieldset(
				'field_tab_site_meta',
				'サイト共通メタ',
				'acf_tab_site_meta',
				'tab'
			),
			neon_acf_fieldset(
				'field_site_meta_keywords',
				'キーワード',
				'acf_site_meta_keywords',
				'text',
				array( 'instructions' => 'カンマ（,）で区切る' )
			),
			neon_acf_fieldset(
				'field_site_meta_og_image',
				'OGイメージ',
				'acf_site_meta_og_image',
				'image',
				array( 'return_format' => 'id' )
			),

			neon_acf_fieldset(
				'field_tab_site_settings',
				'サイト共通タグ',
				'acf_tab_site_settings',
				'tab'
			),
			neon_acf_fieldset(
				'field_site_tag_head',
				'head',
				'acf_site_tag_head',
				'textarea',
				array( 'new_lines' => '' )
			),
			neon_acf_fieldset(
				'field_site_tag_body',
				'body',
				'acf_site_tag_body',
				'textarea',
				array(
					'instructions' => esc_html( '<body>タグ開始直後に挿入されます' ),
					'new_lines' => '',
				)
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf_site_settings',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	);

	// 各投稿タイプにフィールドをセットする
	foreach ( $post_type_all as $post_type ) {
		$post_type_object = get_post_type_object( $post_type );

		if ( 'page' !== $post_type ) {
			$tab = neon_acf_fieldset(
				'field_post_type_tab_' . $post_type,
				$post_type_object->label,
				'',
				'tab'
			);
			$post_type_settings['fields'][] = $tab;

			$title = neon_acf_fieldset(
				'field_post_type_meta_title_' . $post_type,
				$post_type_object->label . '_タイトル',
				'acf_post_type_meta_title_' . $post_type,
				'text',
				array( 'instructions' => '[入力されたタイトル]｜'. get_bloginfo( 'name' ) )
			);
			$post_type_settings['fields'][] = $title;

			$description = neon_acf_fieldset(
				'field_post_type_meta_description_' . $post_type,
				$post_type_object->label . '_ディスクリプション',
				'acf_post_type_meta_description_' . $post_type,
				'textarea',
				array( 'rows' => 2 )
			);
			$post_type_settings['fields'][] = $description;

			$keywords = neon_acf_fieldset(
				'field_post_type_meta_keywords_' . $post_type,
				$post_type_object->label . '_キーワード',
				'acf_post_type_meta_keywords_' . $post_type,
				'text',
				array( 'instructions' => 'カンマ（,）で区切る' )
			);
			$post_type_settings['fields'][] = $keywords;

			$og_description = neon_acf_fieldset(
				'field_post_type_meta_og_description_' . $post_type,
				$post_type_object->label . '_OGディスクリプション',
				'acf_post_type_meta_og_description_' . $post_type,
				'textarea',
				array( 'rows' => 2 )
			);
			$post_type_settings['fields'][] = $og_description;

			$og_image = neon_acf_fieldset(
				'field_post_type_meta_og_image_' . $post_type,
				$post_type_object->label . '_OGイメージ',
				'acf_post_type_meta_og_image_' . $post_type,
				'image',
				array( 'return_format' => 'id' )
			);
			$post_type_settings['fields'][] = $og_image;
		}

		/*
		 * ページメタ（投稿・固定ページ）
		 */
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			acf_add_local_field_group(
				array(
					'key' => 'group_page_meta_' . $post_type,
					'title' => 'ページメタ',
					'fields' => array(
						neon_acf_fieldset(
							'field_page_meta_title',
							'ページメタタイトル',
							'acf_page_meta_title',
							'textarea',
							array(
								'new_lines' => '',
								'rows' => 4,
								'instructions' => '※タイトルが全て書き変わります',
							)
						),
						neon_acf_fieldset(
							'field_page_meta_description',
							'ページメタディスクリプション',
							'acf_page_meta_description',
							'textarea',
							array(
								'new_lines' => '',
								'rows' => 4,
								'placeholder' => 'このページのディスクリプションです。'."\n".'200〜300文字程度でページの説明を入力してください。入力した内容はgoogleの検索結果に反映されます。',
							)
						),
						neon_acf_fieldset(
							'field_page_meta_og_description',
							'ページメタOGディスクリプション',
							'acf_page_meta_og_description',
							'textarea',
							array(
								'new_lines' => '',
								'rows' => 4,
								'placeholder' => 'このページのOGディスクリプションです。'."\n".'できるだけ一文で簡潔な内容にしましょう。例：「サイト名」の会社概要です。',
							)
						),
						neon_acf_fieldset(
							'field_page_meta_keywords',
							'ページメタキーワード',
							'acf_page_meta_keywords',
							'textarea',
							array(
								'new_lines' => '',
								'rows' => 4,
								'placeholder' => '昨今のSEOでは設定を強く推奨はされていないので厳密に考える必要はありません。',
							)
						),
					),
					'location' => array(
						array(
							array(
								'param' => 'post_type',
								'operator' => '==',
								'value' => $post_type,
							),
						),
					),
					'menu_order' => 99,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => true,
					'description' => '',
				)
			);
		}
	}

	/*
	 * ページメタ（ターム編集ページ）
	 */
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group(
			array(
				'key' => 'group_page_meta_term',
				'title' => 'ページメタ',
				'fields' => array(
					neon_acf_fieldset(
						'field_page_meta_index_term',
						'インデックス設定',
						'acf_page_meta_index_term',
						'true_false',
						array( 'message' => '検索結果に表示する' )
					),
					neon_acf_fieldset(
						'field_page_meta_description_term',
						'ディスクリプション',
						'acf_page_meta_description_term',
						'textarea',
						array(
							'new_lines' => '',
							'rows' => 4,
							'placeholder' => 'このページのディスクリプションです。'."\n".'200〜300文字程度でページの説明を入力してください。入力した内容はgoogleの検索結果に反映されます。',
						)
					),
					neon_acf_fieldset(
						'field_page_meta_og_description_term',
						'OGディスクリプション',
						'acf_page_meta_og_description_term',
						'textarea',
						array(
							'new_lines' => '',
							'rows' => 4,
							'placeholder' => 'このページのOGディスクリプションです。'."\n".'できるだけ一文で簡潔な内容にしましょう。例：「サイト名」の会社概要です。',
						)
					),
					neon_acf_fieldset(
						'field_page_meta_keywords_term',
						'キーワード',
						'acf_page_meta_keywords_term',
						'textarea',
						array(
							'new_lines' => '',
							'rows' => 4,
							'placeholder' => '昨今のSEOでは設定を強く推奨はされていないので厳密に考える必要はありません。',
						)
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'taxonomy',
							'operator' => '==',
							'value' => 'all',
						),
					),
				),
				'menu_order' => 99,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			)
		);
	}

	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group( $system_page_id );
		acf_add_local_field_group( $slider_front_page );
		acf_add_local_field_group( $post_type_settings );
		acf_add_local_field_group( $site_settings );
	}
}

add_action( 'init', 'neon_acf_set_field_group_site_settings', 9999 );
