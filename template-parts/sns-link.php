<?php
/**
 * SNSのリンク
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

?>
<div class="nn_sns_link_1">
	<ul class="nn_sns_link_1__list">
		<li class="nn_sns_link_1__item">
			<a class="__inner -facebook" title="facebookの投稿を見る"
			target="_blank" href="<?php echo neon_link( 'facebook' ); ?>"></a>
		</li>
		<li class="nn_sns_link_1__item">
			<a class="__inner -instagram" title="instagramの投稿を見る"
			target="_blank" href="<?php echo neon_link( 'instagram' ); ?>"></a>
		</li>
		<li class="nn_sns_link_1__item">
			<a class="__inner -twitter" title="twitterの投稿を見る"
			target="_blank" href="<?php echo neon_link( 'twitter' ); ?>"></a>
		</li>
	</ul>
</div><!-- /.nn_sns_link_1 -->
