<?php

	$topBannerQuery = new WP_Query(array(
			'post_type' => 'top-banner',
			'posts_per_page' => 1,
			'meta_key' => '_cmsp_banner_active',
		));

	while($topBannerQuery->have_posts()): $topBannerQuery->the_post();

		$bannerCustom = get_post_custom($post->ID);
		if($bannerCustom['_cmsp_banner_type'][0] == 'whatsapp-ouvidoria'):
?>
<div class="top-banner whatsapp-ouvidoria">
<?php
	if($bannerCustom['_cmsp_banner_link'][0]){
?>
	<a href="<?php echo $bannerCustom['_cmsp_banner_link'][0]; ?>" target="<?php echo $bannerCustom['_cmsp_banner_target'][0]; ?>"><div class="inner-top-banner wrap"></div></a>
<?php } else { ?>
	<div class="inner-top-banner wrap"></div>
<?php } ?>
</div>
<?php
		endif;
	endwhile;

?>