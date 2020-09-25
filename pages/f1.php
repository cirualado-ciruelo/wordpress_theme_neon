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
	<dl class="__Inner">
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title"
				       for="name">お名前</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				[mwform_text class="nn_form_parts_text_1 _Sanitize_Text"
				             id="name"
				             name="お名前"]
				<div class="nn_form_table_1__Toggle -hiddenError -hiddenConfirm">
					<div class="nn_form_table_1__Anno">
						<p class="_nn_text_anno_1">フルネームでお願いします</p>
					</div>
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title">性別</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				<div class="nn_form_parts_radio_1">
					<div class="__Inner">
						[mwform_radio class="nn_form_parts_radio_1__Input _Sanitize_HiddenInput"
						              name="性別"
						              children="男性,女性"]
					</div>
					<!-- /.__Inner -->
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title"
				       for="place">お住い</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				<div class="nn_form_table_1__Grid">
					<div class="nn_form_table_1__Group -size_full">
						<label class="nn_form_table_1__Tiny"
						       for="yubin">〒</label>
						<div class="nn_form_table_1__Item -size_1">
							[mwform_text class="nn_form_parts_text_1 _Sanitize_Text"
							             id="yubin"
							             name="郵便番号"]
						</div>
						<!-- /.nn_form_table_1__Item -->
					</div>
					<!-- ./nn_form_table_1__Group -->
					<div class="nn_form_table_1__Group">
						<label class="nn_form_table_1__Tiny"
						       for="area">都道府県</label>
						<div class="nn_form_parts_select_1">
							<div class="nn_form_parts_select_1__Body">
								[mwform_select class="nn_form_parts_select_1__Select _Sanitize_Select"
								               id="area" name="都道府県"
								               children=":選択してください,東京都,北海道"
								               post_raw="true"]
								<div class="nn_form_parts_select_1__Appearance"></div>
							</div>
						</div>
					</div>
					<!-- ./nn_form_table_1__Group -->
					<div class="nn_form_table_1__Group">
						<label class="nn_form_table_1__Tiny"
						       for="city">市区町村</label>
						<div class="nn_form_parts_select_1">
							<div class="nn_form_parts_select_1__Body">
								[mwform_select class="nn_form_parts_select_1__Select _Sanitize_Select"
								               id="city" name="市区町村"
								               children=":選択してください,墨田区"
								               post_raw="true"]
								<div class="nn_form_parts_select_1__Appearance"></div>
							</div>
						</div>
					</div>
					<!-- ./nn_form_table_1__Group -->
				</div>
				<!-- ./nn_form_table_1__Grid -->
			</dd>
		</div>
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title"
				       for="mail">メールアドレス</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				[mwform_email class="nn_form_parts_text_1 _Sanitize_Text"
				              id="mail"
				              name="メールアドレス"]
			</dd>
		</div>
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title"
				       for="tel">電話番号</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				[mwform_number class="nn_form_parts_text_1 _Sanitize_Text _Sanitize_Number"
				               id="tel"
				               name="電話番号"]
			</dd>
		</div>
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title"
				       for="plan">予定</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				<div class="_Relative">
					[mwform_datepicker class="nn_form_parts_text_1 _Sanitize_Text wp_MwCalendar"
					                   id="plan"
					                   name="予定"]
					<div class="nn_form_table_1__Toggle -hiddenConfirm">
						<button class="nn_form_parts_button_resetVal_1"
						        type="button"
						        data-click="resetVal"
						        data-reset-target="予定"></button>
					</div>
				</div>
				<!-- ./_Relative -->
			</dd>
		</div>
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title">お問い合わせ種別</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				<div class="nn_form_parts_check_1">
					<div class="__Inner">
						[mwform_checkbox class="nn_form_parts_check_1__Input _Sanitize_HiddenInput"
						                 name="お問い合わせ種別"
						                 children="種別1,種別2,種別3,種別4,種別5,種別6,種別7,種別8,種別9,種別10,種別11"
						                 separator=","]
					</div>
					<!-- /.__Inner -->
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__Row -alignTop">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title"
				       for="content">お問い合わせ内容</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				[mwform_textarea class="nn_form_parts_textarea_1 _Sanitize_Textarea"
				                 id="content"
				                 name="お問い合わせ内容"]
			</dd>
		</div>
		<div class="nn_form_table_1__Row">
			<dt class="nn_form_table_1__Head -required">
				<label class="nn_form_table_1__Title">利用規約への同意</label>
			</dt>
			<dd class="nn_form_table_1__Data">
				<div class="nn_form_parts_check_1">
					<div class="__Inner">
						[mwform_checkbox class="nn_form_parts_check_1__Input _Sanitize_HiddenInput"
						                 name="利用規約への同意"
						                 children="同意します"
						                 separator=","]
					</div>
					<!-- /.__Inner -->
				</div>
				<div class="nn_form_table_1__Toggle -hiddenConfirm">
					<p class="_nn_text_anno_1">
						<a class="link_plane -blank"
						   href="#">利用規約</a>
					</p>
				</div>
			</dd>
		</div>
		<div class="nn_form_table_1__Row -submitItems">
			<div class="nn_form_table_1__SubmitItems">
				[mwform_backButton class="nn_form_parts_submit_1 -back _Sanitize_SubmitInput"
				                   value="入力画面に戻る"]
				[mwform_bconfirm class="nn_form_parts_submit_1 -confirm"
				                 value="confirm"]確認画面へ[/mwform_bconfirm]
				[mwform_bsubmit class="nn_form_parts_submit_1 -send"
				                name="send"
				                value="send"]送信する[/mwform_bsubmit]
			</div>
		</div>
	</dl>
	<!-- /.__Inner -->
</div>
