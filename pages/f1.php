<?php
/**
 * MW WP Form ページソース
 *
 * Page_Name: Contact
 *
 * mwform_formkey key="16"
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
<div class="nn_form_table_1">
	<dl class="__inner">
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title"
				       for="name">お名前</label>
			</dt>
			<dd class="nn_form_table_1__data">
				[mwform_text class="nn_form_parts_text_1 _sanitize_text"
				             id="name"
				             name="お名前"]
				<div class="nn_form_table_1__toggle -hiddenError -hiddenConfirm">
					<div class="nn_form_table_1__anno">
						<p class="_nn_text_anno_1">フルネームでお願いします</p>
					</div>
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title">性別</label>
			</dt>
			<dd class="nn_form_table_1__data">
				<div class="nn_form_parts_radio_1">
					<div class="__inner">
						[mwform_radio class="nn_form_parts_radio_1__input _sanitize_hiddenInput"
						              name="性別"
						              children="男性,女性"]
					</div><!-- /.__inner -->
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title"
				       for="place">お住い</label>
			</dt>
			<dd class="nn_form_table_1__data">
				<div class="nn_form_table_1__grid">
					<div class="nn_form_table_1__group -size_full">
						<label class="nn_form_table_1__tiny"
						       for="yubin">〒</label>
						<div class="nn_form_table_1__item -size_1">
							[mwform_text class="nn_form_parts_text_1 _sanitize_text"
							             id="yubin"
							             name="郵便番号"]
						</div><!-- /.nn_form_table_1__item -->
					</div><!-- ./nn_form_table_1__group -->
					<div class="nn_form_table_1__group">
						<label class="nn_form_table_1__tiny"
						       for="area">都道府県</label>
						<div class="nn_form_parts_select_1">
							<div class="nn_form_parts_select_1__body">
								[mwform_select class="nn_form_parts_select_1__select _sanitize_select"
								               id="area" name="都道府県"
								               children=":選択してください,東京都,北海道"
								               post_raw="true"]
								<div class="nn_form_parts_select_1__appearance"></div>
							</div>
						</div>
					</div><!-- ./nn_form_table_1__group -->
					<div class="nn_form_table_1__group">
						<label class="nn_form_table_1__tiny"
						       for="city">市区町村</label>
						<div class="nn_form_parts_select_1">
							<div class="nn_form_parts_select_1__body">
								[mwform_select class="nn_form_parts_select_1__select _sanitize_select"
								               id="city" name="市区町村"
								               children=":選択してください,墨田区"
								               post_raw="true"]
								<div class="nn_form_parts_select_1__appearance"></div>
							</div>
						</div>
					</div><!-- ./nn_form_table_1__group -->
				</div><!-- ./nn_form_table_1__grid -->
			</dd>
		</div>
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title"
				       for="mail">メールアドレス</label>
			</dt>
			<dd class="nn_form_table_1__data">
				[mwform_email class="nn_form_parts_text_1 _sanitize_text"
				              id="mail"
				              name="メールアドレス"]
			</dd>
		</div>
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title"
				       for="tel">電話番号</label>
			</dt>
			<dd class="nn_form_table_1__data">
				[mwform_number class="nn_form_parts_text_1 _sanitize_text _sanitize_number"
				               id="tel"
				               name="電話番号"]
			</dd>
		</div>
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title"
				       for="plan">予定</label>
			</dt>
			<dd class="nn_form_table_1__data">
				<div class="_Relative">
					[mwform_datepicker class="nn_form_parts_text_1 _sanitize_text wp_MwCalendar"
					                   id="plan"
					                   name="予定"]
					<div class="nn_form_table_1__toggle -hiddenConfirm">
						<button class="nn_form_parts_button_resetVal_1"
						        type="button"
						        data-click="resetVal"
						        data-reset-target="予定"></button>
					</div>
				</div><!-- ./_Relative -->
			</dd>
		</div>
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title">お問い合わせ種別</label>
			</dt>
			<dd class="nn_form_table_1__data">
				<div class="nn_form_parts_check_1">
					<div class="__inner">
						[mwform_checkbox class="nn_form_parts_check_1__Input _sanitize_hiddenInput"
						                 name="お問い合わせ種別"
						                 children="種別1,種別2,種別3,種別4,種別5,種別6,種別7,種別8,種別9,種別10,種別11"
						                 separator=","]
					</div><!-- /.__inner -->
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__row -alignTop">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title"
				       for="content">お問い合わせ内容</label>
			</dt>
			<dd class="nn_form_table_1__data">
				[mwform_textarea class="nn_form_parts_textarea_1 _sanitize_textarea"
				                 id="content"
				                 name="お問い合わせ内容"]
			</dd>
		</div>
		<div class="nn_form_table_1__row">
			<dt class="nn_form_table_1__head -required">
				<label class="nn_form_table_1__title">利用規約への同意</label>
			</dt>
			<dd class="nn_form_table_1__data">
				<div class="nn_form_parts_check_1">
					<div class="__inner">
						[mwform_checkbox class="nn_form_parts_check_1__Input _sanitize_hiddenInput"
						                 name="利用規約への同意"
						                 children="同意します"
						                 separator=","]
					</div><!-- /.__inner -->
				</div>
				<div class="nn_form_table_1__toggle -hiddenConfirm">
					<p class="_nn_text_anno_1">
						<a class="link_plane -blank"
						   href="#">利用規約</a>
					</p>
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__row -submitItems">
			<div class="nn_form_table_1__submitItems">
				[mwform_backButton class="nn_form_parts_submit_1 -back _sanitize_submitInput"
				                   value="入力画面に戻る"]
				[mwform_bconfirm class="nn_form_parts_submit_1 -confirm"
				                 value="confirm"]確認画面へ[/mwform_bconfirm]
				[mwform_bsubmit class="nn_form_parts_submit_1 -send"
				                name="send"
				                value="send"]送信する[/mwform_bsubmit]
			</div>
		</div>
	</dl><!-- /.__inner -->
</div>
