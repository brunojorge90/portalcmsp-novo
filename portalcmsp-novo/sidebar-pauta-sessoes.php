<!--sidebar customizada "Pauta das Sessões"-->
<div id="sidebar1" class="sidebar sidebar-page" role="complementary">

	<?php 
	// Make submenu automatically based on subpages
	$ancestors = get_post_ancestors( $post );//$post->ancestors;
	if(count($ancestors) > 1) {
		$parent = $ancestors[count($ancestors) -2];
	}
	else {
		$parent = $post->ID;		
	}
	$grandparent = get_post($parent)->post_parent;

	$hasmenu = false;
	$items;

	$items = get_pages(array('parent'=>$parent,'post_type'=>'page','sort_column'=>'menu_order'));
	if(!empty($items)) $hasmenu = true;
	$hasmenu = true;
	?>

	<!-- <?php echo $post->ID;	?>-->
	<div class="subpage-navigation clearfix">

		<?php if($hasmenu):	?>
	
			<section class="content-box box-nav-menu">
				<header class="content-box-top">
					<h2 class="content-box-title icon-doublearrow-red"><a href="<?php echo get_the_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a></h2>
				</header>

				<ul class="box-nav-menu-list">
					<?php 
					foreach($items as $item):

						$link = get_permalink($item->ID);

						$blank = false;
						if(get_post_meta($item->ID,'_cmsp_page_legacy-type',true) == 'tab') {
							$link = get_post_meta($item->ID,'_cmsp_page_legacy-url',true);
							$blank = true;
						}
					?>
						<li>
							<a href="<?php echo $link; ?>" <?php if($blank) echo 'target="_blank"'; if($item->ID == $post->ID) echo 'class="active"'; ?>><?php echo $item->post_title; ?></a>
							<?php
							// submenu
							$submenuItems = get_pages(array('parent'=>$item->ID,'post_type'=>'page','sort_column'=>'menu_order'));
							if(!empty($submenuItems)):
							?>
								<ul class="box-nav-menu-submenu">
									<?php
									foreach($submenuItems as $subItem):
										$link = get_permalink($subItem->ID);

										$blank = false;
										if(get_post_meta($subItem->ID,'_cmsp_page_legacy-type',true) == 'tab') {
											$link = get_post_meta($subItem->ID,'_cmsp_page_legacy-url',true);
											$blank = true;
										}
									?>
										<li>
											<a href="<?php echo $link; ?>" <?php if($blank) echo 'target="_blank"'; if($subItem->ID == $post->ID) echo 'class="active"'; ?>><?php echo $subItem->post_title; ?></a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

						</li>
					<?php endforeach; ?>
				</ul>

			</section><!-- end box-nav-menu -->

		<?php endif; ?>
			
		<section class="content-box">
			<header class="content-box-top box-downloads-header">
			<h2 class="content-box-title icon-doublearrow-red">CONTATO</h2>
		</header>
			<div class="contact-widget">
				<p>Equipe de Elaboração de Pautas<br/>
				Ramais: 4061 / 4715<br/>
				sgp24@saopaulo.sp.leg.br</p>
			</div>
		</section>	
	</div>
	<style>
    .contact-widget {
        float: inherit !important;
        text-align: left;
        width: 300px;
        margin-bottom: 0;
    }
    </style>
</div>