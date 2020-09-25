<?php
/**
 * SNSのシェアボタン
 *
 * テンプレートファイル内でインクルードされます。
 *
 * @package WordPress
 * @since 1.0.0
 */

$share_url  = get_the_permalink();
$share_text = get_the_title()

?>
<div class="nn_sns_share_1">
	<ul class="nn_sns_share_1__List">
		<li class="nn_sns_share_1__Item">
			<div id="fb-root"></div>
			<script async
			        defer
			        crossorigin="anonymous"
			        src="https://connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v7.0"></script>
			<div class="fb-like"
			     data-href="<?php echo $share_url; ?>"
			     data-layout="button_count"
			     data-action="like"
			     data-size="small"
			     data-show-faces="false"
			     data-share="true"></div>
		</li>
		<li class="nn_sns_share_1__Item">
			<a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
			   class="twitter-share-button"
			   data-text="<?php echo $share_text; ?>"
			   data-url="<?php echo $share_url; ?>"
			   data-lang="ja"
			   data-show-count="false">Tweet</a>
			<script async
			        src="//platform.twitter.com/widgets.js"
			        charset="utf-8"></script>
		</li>
		<li class="nn_sns_share_1__Item">
			<div class="line-it-button"
			     data-lang="ja"
			     data-type="like"
			     data-url="<?php echo $share_url; ?>"
			     data-share="true"
			     style="display: none;"></div>
			<script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js"
			        async="async"
			        defer="defer"></script>
		</li>
	</ul>
</div>
