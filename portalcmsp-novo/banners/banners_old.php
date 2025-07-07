<?php

	$topBannerQuery = new WP_Query(array(
			'post_type' => 'top-banner',
			'posts_per_page' => 1,
			'meta_key' => '_cmsp_banner_active',
		));

	while($topBannerQuery->have_posts()): $topBannerQuery->the_post();

		$bannerCustom = get_post_custom($post->ID);
		if($bannerCustom['_cmsp_banner_type'][0] == 'zoneamento-banner'):
?>

		<div class="top-banner zoneamento-banner cf">
			<div class="inner-top-banner wrap cf">
				<p class="banner-text">
					<a href="<?php echo $bannerCustom['_cmsp_banner_link'][0]; ?>" target="<?php echo $bannerCustom['_cmsp_banner_target'][0]; ?>"><?php echo $bannerCustom['_cmsp_banner_text'][0]; ?></a>
					<a class="btn" href="<?php echo $bannerCustom['_cmsp_banner_link'][0]; ?>" target="<?php echo $bannerCustom['_cmsp_banner_target'][0]; ?>">Clique aqui</a>
				</p>

				<div class="animated-elements">
					<div class="element bike-1"></div>
					<div class="element bike-2"></div>
					<div class="element cloud"></div>
					<div class="element plane"></div>
				</div>
			</div>
		</div>

<?php
		elseif($bannerCustom['_cmsp_banner_type'][0] == 'obrigado-banner'):
?>

		<div id="obrigado_banner" class="top-banner obrigado-banner cf">
			<a href="<?php echo $bannerCustom['_cmsp_banner_link'][0]; ?>" target="<?php echo $bannerCustom['_cmsp_banner_target'][0]; ?>">
				Hotsite Obrigado a você - Clique aqui e saiba mais
				<span class="obrigado-banner__overlay"></span>
			</a>
		</div>

		<script>
		(function () {

			window.setTimeout(function () {
				document.getElementById('obrigado_banner').className += ' active';
			}, 5000);
		})();
		</script>
<?php
		endif;
	endwhile;

?>
