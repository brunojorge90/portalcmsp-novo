<?php 

function cmsp_make_csv() {

	$data = $_POST;

	$sheetArgs = array(
			'post_type' => 'minuta-comment',
			'post_status' => 'publish',
		);

	if($data['filter-type'] != '') {

		$sheetArgs['tax_query'] = array(
				array(
					'taxonomy' => 'comment-type',
					'field' => 'slug',
					'terms' => $data['filter-type'],
				),
			);
	}

	$output = 'Email;Nome;Entidade;RG;Telefone;Nº Protocolo;IP;Data;';

	switch($data['filter-type']):
		case 'minuta-comment':
			$output .= 'Título comentado;Artigo comentado;Comentário;';
			break;
		case 'zonas-feedback':
			$output .= 'Nº da matrícula do imóvel;Ruas;Zona atual;Zona sugerida;';
			break;
		case 'tabelas-feedback':
			$output .= 'Quadro;Linha;Coluna;Valor atual;Valor sugerido;';
			break;
		default:
			$output .= 'Título comentado;Artigo comentado;Comentário;Nº da matrícula do imóvel;Ruas;Zona atual;Zona sugerida;Quadro;Linha;Coluna;Valor atual;Valor sugerido;';
	endswitch;

	$output .= "\n";

	$sheetQuery = new WP_Query($sheetArgs);

	while($sheetQuery->have_posts()):
		$sheetQuery->the_post();

		$content = get_the_content();
		if($content == 'Informação do pedido nos campos personalizados abaixo') $content = '';

		$commentFields = get_post_custom(get_the_ID());

		// Email
		$output .= isset($commentFields['_cmsp_minuta_comment_commenter_email'][0]) ? $commentFields['_cmsp_minuta_comment_commenter_email'][0] . ';' : ';';
		// Nome
		$output .= isset($commentFields['_cmsp_minuta_comment_commenter_name'][0]) ? $commentFields['_cmsp_minuta_comment_commenter_name'][0] . ';' : ';';
		// Entidade
		$output .= isset($commentFields['_cmsp_minuta_comment_commenter_entity'][0]) ? $commentFields['_cmsp_minuta_comment_commenter_entity'][0] . ';' : ';';
		// RG
		$output .= isset($commentFields['_cmsp_minuta_comment_commenter_rg'][0]) ? $commentFields['_cmsp_minuta_comment_commenter_rg'][0] . ';' : ';';
		// Telefone
		$output .= isset($commentFields['_cmsp_minuta_comment_commenter_telephone'][0]) ? $commentFields['_cmsp_minuta_comment_commenter_telephone'][0] . ';' : ';';
		// Nº Protocolo
		$output .= isset($commentFields['_cmsp_minuta_comment_commenter_protocol'][0]) ? $commentFields['_cmsp_minuta_comment_commenter_protocol'][0] . ';' : ';';
		// IP
		$output .= isset($commentFields['_cmsp_minuta_comment_commenter_ip'][0]) ? $commentFields['_cmsp_minuta_comment_commenter_ip'][0] . ';' : ';';
		// Data
		$output .= get_the_date('d/m/Y - H:i:s') . ';';

		switch($data['filter-type']):
			case 'minuta-comment':
				// Titulo comentado
				$output .= isset($commentFields['_cmsp_minuta_comment_commented_title'][0]) ? $commentFields['_cmsp_minuta_comment_commented_title'][0] . ';' : ';';
				// Artigo comentado
				$output .= isset($commentFields['_cmsp_minuta_comment_commented_article'][0]) ? $commentFields['_cmsp_minuta_comment_commented_article'][0] . ';' : ';';
				// Comentário
				$output .= $content . ';';
				break;
			case 'zonas-feedback':
				// Nº da matrícula do imóvel
				$output .= isset($commentFields['_cmsp_zonas_comment_estate_id'][0]) ? $commentFields['_cmsp_zonas_comment_estate_id'][0] . ';' : ';';
				// Ruas
				foreach($commentFields['_cmsp_zonas_comment_streets'] as $street):
					$output .= $street . ', ';
				endforeach;
				$output .= ';';
				// Zona atual
				$output .= isset($commentFields['_cmsp_zonas_comment_old_zone'][0]) ? $commentFields['_cmsp_zonas_comment_old_zone'][0] . ';' : ';';
				// Zona sugerida
				$output .= isset($commentFields['_cmsp_zonas_comment_new_zone'][0]) ? $commentFields['_cmsp_zonas_comment_new_zone'][0] . ';' : ';';

				break;
			case 'tabelas-feedback':
				// Quadro
				$output .= isset($commentFields['_cmsp_tabelas_comment_frame'][0]) ? $commentFields['_cmsp_tabelas_comment_frame'][0] . ';' : ';';
				// Linha
				$output .= isset($commentFields['_cmsp_tabelas_comment_frame'][0]) ? $commentFields['_cmsp_tabelas_comment_frame'][0] . ';' : ';';
				// Coluna
				$output .= isset($commentFields['_cmsp_tabelas_comment_column'][0]) ? $commentFields['_cmsp_tabelas_comment_column'][0] . ';' : ';';
				// Valor atual
				$output .= isset($commentFields['_cmsp_tabelas_comment_old_value'][0]) ? $commentFields['_cmsp_tabelas_comment_old_value'][0] . ';' : ';';
				// Valor sugerido
				$output .= isset($commentFields['_cmsp_tabelas_comment_new_value'][0]) ? $commentFields['_cmsp_tabelas_comment_new_value'][0] . ';' : ';';

				break;
			default:
				// Titulo comentado
				$output .= isset($commentFields['_cmsp_minuta_comment_commented_title'][0]) ? $commentFields['_cmsp_minuta_comment_commented_title'][0] . ';' : ';';
				// Artigo comentado
				$output .= isset($commentFields['_cmsp_minuta_comment_commented_article'][0]) ? $commentFields['_cmsp_minuta_comment_commented_article'][0] . ';' : ';';
				// Comentário
				$output .= $content . ';';
				// Nº da matrícula do imóvel
				$output .= isset($commentFields['_cmsp_zonas_comment_estate_id'][0]) ? $commentFields['_cmsp_zonas_comment_estate_id'][0] . ';' : ';';
				// Ruas
				if(isset($commentFields['_cmsp_zonas_comment_streets'])):
					foreach($commentFields['_cmsp_zonas_comment_streets'] as $street):
						$output .= $street . ', ';
					endforeach;
				endif;
				$output .= ';';
				// Zona atual
				$output .= isset($commentFields['_cmsp_zonas_comment_old_zone'][0]) ? $commentFields['_cmsp_zonas_comment_old_zone'][0] . ';' : ';';
				// Zona sugerida
				$output .= isset($commentFields['_cmsp_zonas_comment_new_zone'][0]) ? $commentFields['_cmsp_zonas_comment_new_zone'][0] . ';' : ';';
				// Quadro
				$output .= isset($commentFields['_cmsp_tabelas_comment_frame'][0]) ? $commentFields['_cmsp_tabelas_comment_frame'][0] . ';' : ';';
				// Linha
				$output .= isset($commentFields['_cmsp_tabelas_comment_frame'][0]) ? $commentFields['_cmsp_tabelas_comment_frame'][0] . ';' : ';';
				// Coluna
				$output .= isset($commentFields['_cmsp_tabelas_comment_column'][0]) ? $commentFields['_cmsp_tabelas_comment_column'][0] . ';' : ';';
				// Valor atual
				$output .= isset($commentFields['_cmsp_tabelas_comment_old_value'][0]) ? $commentFields['_cmsp_tabelas_comment_old_value'][0] . ';' : ';';
				// Valor sugerido
				$output .= isset($commentFields['_cmsp_tabelas_comment_new_value'][0]) ? $commentFields['_cmsp_tabelas_comment_new_value'][0] . ';' : ';';
		endswitch;

		$output .= "\n";

	endwhile;

	$filename = date('U') . '.csv';
	$filepath = CMSP_FILES_DIR . $filename;
	$fileurl  = CMSP_FILES_URL . $filename;
	$file = fopen($filepath, 'w') or die ('Cannot open file: ' . $filepath);
	fclose($file);
	file_put_contents($filepath,  "\xEF\xBB\xBF" . $output);

	echo '<div id="message" class="updated notice notice-success is-dismissible below-h2"><p>Arquivo CSV gerado! <a href="'. $fileurl .'">Clique aqui para baixar</a></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dispensar este aviso.</span></button></div>';
}

function cmsp_make_csv_page() {

	echo '<h1>Exportar dados de propostas</h1>';

	if($_SERVER['REQUEST_METHOD'] == 'POST') cmsp_make_csv();

?>
	<form method="POST" id="poststuff">
	
	<div id="postbox-container-1" class="postbox-container">
		<div class="postbox" style="max-width: 600px;">
			<div class="handlediv" title="Clique para expandir ou recolher."><br></div>
			<h3 class="hndle ui-sortable-handle">Filtrar propostas:</h3>

			<div class="inside">
				<table class="form-table">
					<tbody>
						
						<tr>
							<td style="width: 25%;"><label for="filter-type">Por tipo:</label></td>
							<td>
								<select name="filter-type" id="filter-type">
									<option value="">Todos</option>
									<option value="minuta-comment">Texto da Lei</option>
									<option value="zonas-feedback">Zonas</option>
									<option value="tabelas-feedback">Tabelas</option>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="filter-date-start">Publicadas de:</label></td>
							<td><span class=""><input type="text" name="filter-date-start" class="cmsp_date_input_start cmsp_datepicker" placeholder="Qualquer data" value=""></span></td>
						</tr>
						<tr>
							<td><label for="filter-date-end">Até</label></td>
							<td><input type="text" name="filter-date-end" class="cmsp_date_input_start cmsp_datepicker" placeholder="Qualquer data" value=""></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" class="button button-primary button-large" value="Exportar propostas"/></td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>

	</form>

<?php
}

function cmsp_add_make_csv_page_menu_item() {
    add_submenu_page('edit.php?post_type=minuta-comment', 'Exportar dados', 'Exportar Dados', 'activate_plugins', 'exportar-dados', 'cmsp_make_csv_page');
}

add_action('admin_menu', 'cmsp_add_make_csv_page_menu_item');

?>