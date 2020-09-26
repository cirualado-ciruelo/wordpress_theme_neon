<?php
/**
 * フォームのテンプレート
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
<div class="containerTree__branch">
	<div class="_container -smaller_1">
		<div class="nn_form_base_1">
			<div class="_ladder">
				<?php

				// 確認画面
				if ( is_page( 'confirm' ) ) :
					if ( 'f0' === neon_get_data_from_system_page_id( '', 'get_anc' ) ) :

						?>

						<?php

					else :

						?>
						<p class="_nn_text_1">
							入力内容にお間違いがなければ「送信する」をクリックし、次の画面へお進みください。
						</p>
						<?php

					endif;

				// 完了画面
				elseif ( is_page( 'thanks' ) ) :
					if ( 'f0' === neon_get_data_from_system_page_id( '', 'get_anc' ) ) :

						?>

						<?php

					else :

						?>
						<div class="form_thanksContent">
							<h3 class="nn_title_lv1_1">お問い合わせ<br class="_lite_inline">ありがとうございます。</h3>

							<div class="_ladder">
								<p class="_nn_text_1">
									この度はお問い合わせいただきありがとうございます。<br>
									改めて担当よりご返信させていただきます。
								</p>
								<p class="_nn_text_1">
									<a class="nn_link_left_1"
									   href="<?php echo esc_url( home_url() ); ?>">TOPにもどる</a>
								</p>
							</div><!-- /._ladder -->
						</div><!-- /.form_thanksContent -->
						<?php

					endif;

				// 入力画面
				else :
					if ( 'f0' === neon_get_data_from_system_page_id( '', 'get_anc' ) ) :

						?>

						<?php

					else :

						?>
						<p class="_nn_text_1">
							<span class="_color_red_1">*</span>の項目は必須です。
						</p>
						<?php

					endif;
				endif ;

				/*
				 * MW WP Formの内容の改行が消えてしまうため
				 * ここでHTMLの圧縮解除
				 */
				neon_the_ob_replace();

				the_content();

				// 圧縮再開
				ob_start();

				?>
			</div><!-- /._ladder -->
	</div><!-- /._container -->
</div><!-- /.containerTree__branch -->
