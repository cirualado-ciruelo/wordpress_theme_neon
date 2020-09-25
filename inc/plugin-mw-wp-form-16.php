<?php
/**
 * MW WP Form settings
 *
 * ID    16
 * label contact
 *
 * =====================================
 *   QUICK ACCESS
 * =====================================
 *     管理者宛メールの内容をカスタマイズ
 *     自動返信メールの内容をカスタマイズ
 *     バリデーション設定
 * =====================================
 *
 * @package WordPress
 * @since 1.0.0
 */

/**
 * MW WP Form
 * 管理者宛メールの内容をカスタマイズ
 * 末尾に'_{form_id}'をセット
 *
 * @since 1.0.0
 */
function neon_mw_admin_mail_raw_setting_16( $mailRaw, $values, $data ) {
	// to, cc, bcc では {キー} は使用できません。
	// $data->get( 'hoge' ) で送信されたデータが取得できます。

	global $is_mw_debug_mode;

	$browser   = $_SERVER["HTTP_USER_AGENT"];
	$server_ip = $_SERVER["REMOTE_ADDR"];
	$host      = gethostbyaddr( $server_ip );

	// 宛先
	if ( ! $mailRaw->to ) {
		$mailRaw->to = 'devdavdidida@rakuten.jp';
	}

	if ( $is_mw_debug_mode ) {
		$mailRaw->to = 'tesu.matsumura.work@gmail.com';
	}

	// // cc
	// if ( ! $mailRaw->cc ) {
		// $mailRaw->cc = 'XXX@XXXXX.jp';
	// }

	// // bcc
	// if ( ! $mailRaw->bcc ) {
		// $mailRaw->bcc = 'XXX@XXXXX.jp';
	// }

	// 送信元
	if ( ! $mailRaw->from ) {
		$mailRaw->from = 'devdavdidida@rakuten.jp';
	}

	// Return-Path
	if ( ! $mailRaw->return_path ) {
		$mailRaw->return_path = 'devdavdidida@rakuten.jp';
	}

	// 送信者
	if ( ! $mailRaw->sender ) {
		$mailRaw->sender = get_bloginfo( 'name' );
	}

	// 件名
	if ( ! $mailRaw->subject ) {
		$mailRaw->subject = 'お問合せフォームより問い合わせがありました';
	}

	if ( $is_mw_debug_mode ) {
		$mailRaw->subject .= '（テスト送信）';
	}

	// Reply-to（メールアドレス）
	if ( ! $mailRaw->reply_to ) {
		$mailRaw->reply_to = '{メールアドレス}';
	}

	// 本文
	if ( ! $mailRaw->body ) {
		$mailRaw->body = '

お問い合わせ内容  ： {お問い合わせ内容}
お名前 　　　　　 ： {お名前}
メールアドレス 　 ： {メールアドレス}
備考 　　　　　　 ：
{備考}';
	}

	// 本文に送信者情報追加
	$mailRaw->body .= '


--------------------
【送信者情報】
・ブラウザー：' . $browser
. '
・送信元IPアドレス：' . $server_ip
. '
・送信元ホスト名：' . $host;

	return $mailRaw;
}

add_filter( 'mwform_admin_mail_raw_mw-wp-form-16', 'neon_mw_admin_mail_raw_setting_16', 10, 3 );

/**
 * MW WP Form
 * 自動返信メールの内容をカスタマイズ
 * 末尾に'_{form_id}'をセット
 *
 * @since 1.0.0
 */
function neon_mw_auto_mail_raw_setting_16( $mailRaw, $values, $data ) {
	// to, cc, bcc では {キー} は使用できません。
	// $data->get( 'hoge' ) で送信されたデータが取得できます。

	global $is_mw_debug_mode, $mw_mail_footer;

	// 送信元
	if ( ! $mailRaw->from ) {
		$mailRaw->from = 'devdavdidida@rakuten.jp';
	}

	// 送信者
	if ( ! $mailRaw->sender ) {
		$mailRaw->sender = get_bloginfo( 'name' );
	}

	// 件名
	if ( ! $mailRaw->subject ) {
		$mailRaw->subject = '【' . get_bloginfo( 'name' ) . '】お問い合わせありがとうございます';
	}

	if ( $is_mw_debug_mode ) {
		$mailRaw->subject .= '（テスト送信）';
	}

	// 本文
	if ( ! $mailRaw->body ) {
		$mailRaw->body = '{お名前} 様

この度はお問い合わせいただき、ありがとうございます。

担当よりお電話もしくはメールにてご連絡いたします。

しばらくお待ちくださいませ。
'
. $mw_mail_footer;
	}

	return $mailRaw;
}

add_filter( 'mwform_auto_mail_raw_mw-wp-form-16', 'neon_mw_auto_mail_raw_setting_16', 10, 3 );

/**
 * MW WP Form バリデーション設定
 * 参照｜https://plugins.2inc.org/mw-wp-form/manual/validation-rule/
 *
 * @since 1.0.0
 */
function neon_mw_validation_16( $validation ) {
	$validation->set_rule( 'お名前', 'noEmpty' );
	$validation->set_rule( '性別', 'required' );
	$validation->set_rule( 'お住い', 'noEmpty' );
	$validation->set_rule( 'メールアドレス', 'noEmpty' );
	$validation->set_rule( 'メールアドレス', 'mail' );
	$validation->set_rule( '電話番号', 'noEmpty' );
	$validation->set_rule( '電話番号', 'tel' );
	$validation->set_rule( '予定', 'noEmpty' );
	$validation->set_rule( 'お問い合わせ内容', 'noEmpty' );
	$validation->set_rule( 'お問い合わせ種別', 'required' );
	$validation->set_rule( '利用規約への同意', 'required' );

	return $validation;
}

add_filter( 'mwform_validation_mw-wp-form-16', 'neon_mw_validation_16', 10, 3 );
