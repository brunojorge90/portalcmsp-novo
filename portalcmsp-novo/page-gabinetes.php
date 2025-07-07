<?php
/*
 Template Name: Home Vereadores
*/
?>

<?php get_header(); ?>

	<div id="content">

		<div class="breadcrumbs cf">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p class="wrap cf">','</p>');
			}?>
		</div>

		<div class="section-title">
			<h2 class="wrap icon-connected-large-red">Gabinetes</h2>
		</div>

		<div id="inner-content" class="wrap cf">

			<div id="main" class="cf entry-content" role="main">

				<p>* informações sujeitas à alterações</p>

				<table>
					<tbody>
						<tr>
							<td><strong>VEREADOR</strong></td>
							<td><strong>GV</strong></td>
							<td><strong>SALA</strong></td>
							<td><strong>RAMAL (PABX: 3396-4000) </strong></td>
							<td><strong>FAX</strong></td>
							<td><strong>E-MAIL</strong></td>
						</tr>

						<?php
							// default arguments for the query
							$defaultArgs = array(
									'post_type' => 'vereador',
									'posts_per_page' => -1,
									'meta_key' => '_cmsp_vereador_ativo',
									'orderby' => 'title',
									'order' => 'ASC'
								);

							$vereadoresQuery = new WP_Query($defaultArgs);

							while($vereadoresQuery->have_posts()): $vereadoresQuery->the_post();
								$nome = get_post_meta($post->ID,'_cmsp_vereador_name', true);
								$partido = get_post_meta($post->ID,'_cmsp_vereador_party', true);
								$gv = get_post_meta($post->ID,'_cmsp_vereador_contato_gv', true);
								$sala = get_post_meta($post->ID,'_cmsp_vereador_contato_sala', true);
								$ramal = get_post_meta($post->ID,'_cmsp_vereador_contato_ramal', true);
								$fax = get_post_meta($post->ID,'_cmsp_vereador_contato_fax', true);
								$email = get_post_meta($post->ID,'_cmsp_vereador_contato_email', true);
						?>

						<tr>
							<td><a target="_blank" href="/?p=<?=$post->ID?>"><?=$nome?> - <?=$partido?></a></td>
							<td><?=$gv?></td>
							<td><?=$sala?></td>
							<td><?=$ramal?></td>
							<td><?=$fax?></td>
							<td><a href="mailto:<?=$email?>"><?=$email?></a></td>
						</tr>

						<?php endwhile; ?>

					</tbody>
				</table>

			</div>

		</div>

	</div>
</main>
<?php get_footer(); ?>