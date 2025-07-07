<?php
/*
 Template Name: Empenhos - CMSP
*/
?>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js	"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/wp-content/uploads/PortalContent/Site.css"/>
	<style>
		th, td {
		padding: 5px !important;
		text-align: center !important;
		}
	
	</style>
	<!--
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>	
	<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.min.js"></script>
-->
	
	<script>
		
	$(window).on('load', function() {
		
		var table = $("#grid").DataTable({
				language: 	{
					"sEmptyTable": "Nenhum registro encontrado",
					"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
					"sInfoFiltered": "(Filtrados de _MAX_ registros)",
					"sInfoPostFix": "",
					"sInfoThousands": ".",
					"sLengthMenu": "_MENU_ resultados por página",
					"sLoadingRecords": "Carregando...",
					"sProcessing": "Processando...",
					"sZeroRecords": "Nenhum registro encontrado",
					"sSearch": "Pesquisar",
					"oPaginate": {
						"sNext": "Próximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast": "Último"
					},
					"oAria": {
						"sSortAscending": ": Ordenar colunas de forma ascendente",
						"sSortDescending": ": Ordenar colunas de forma descendente"
					}
				},
				"lengthChange": false,
				"searching": false,
				"info": true,
				"paging": true,
				 "order": [],
				 "pageLength": 30
				});
	});
		
</script>
		<?php get_header(); ?>

<?php
	setlocale(LC_MONETARY, 'pt_BR');
	$fmt = numfmt_create( 'pt_BR', NumberFormatter::CURRENCY );
	//$csv = fopen('C:\wamp64\www\wordpress\wp-content\uploads\sof\empenhos.csv', 'w');
	//$csv_head =  array("Empenho","Dotação","Contratado","Data","Valor Total Empenhado","Valor Anulado","Valor Empenhado Líquido","Valor Liquidado");
	//fputcsv($csv, $csv_head);
	global $wpdb;

	$tabela = "transp_empenhos";
	$codEmpresa = "18";

	$queryEmpenhos = $wpdb->prepare("SELECT * FROM $tabela where codEmpresa=%d order by datEmpenho desc",[ $codEmpresa ]);

	$empenhos = $wpdb->get_results($queryEmpenhos);


	//$empenhos = $wpdb->get_results( "SELECT * FROM $tabela where codEmpresa=18 order by datEmpenho" );
	
?>
<div id="content" >

		<div class="breadcrumbs cf">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p class="wrap cf">','</p>');
			} ?>
		</div>

		<div id="inner-content" class="wrap cf">

			<div id="main" class="cf" role="main">

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

					<header class="article-header">
						<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
					</header><?php //end article header ?>

					<section class="entry-content cf" itemprop="articleBody">
					
					
					
	<table id="grid" class="display dataTable" width="100%" cellspacing="0" style="font-size: .8em; padding:0px" border="1">
		<thead>
		<tr>
			 <th style="padding:5px !Important;" >Empenho</th>
			 <th style="padding:5px !Important;">Dotação</th>
			 <th style="padding:5px !Important;">Credor/ fornecedor/ contratado</th>
			 <th style="padding:5px !Important;">Data</th>
			 <th style="padding:5px !Important;">Valor Total Empenhado</th>
			 <th style="padding:5px !Important;">Valor Anulado</th>
			 <th style="padding:5px !Important;">Valor Empenhado Líquido</th>
			 <th style="padding:5px !Important;">Valor Liquidado</th>
		</tr>
		</thead>
	<?php foreach ($empenhos as $empenho){		
			$dotacao="{$empenho->codOrgao}.{$empenho->codUnidade}.{$empenho->codFuncao}.{$empenho->codSubFuncao}.{$empenho->codPrograma}.{$empenho->codProjetoAtividade}.{$empenho->codCategoria}.{$empenho->codGrupo}.{$empenho->codModalidade}.{$empenho->codElemento}";//.{$empenho->codSubElemento}.{$empenho->codItemDespesa}";
			$params="codEmpresa=".$codEmpresa."&codEmpenho=".$empenho->codEmpenho."&anoEmpenho=".$empenho->anoEmpenho;	
			$codEmpPad = str_pad("{$empenho->codEmpenho}", 3, '0', STR_PAD_LEFT);
			$dataOrder="{$empenho->anoEmpenho}{$codEmpPad}";//.$codPage.$numEmp.$codEmpPad;			
	?>
		<tr>
			 <td style="padding:5px !Important;" data-order="<?php echo $dataOrder; ?>"> <?php echo "<a href='/empenho/?".$params."'>".$empenho->codEmpenho."/".$empenho->anoEmpenho."</a> "; ?></td>
             <td style="padding:5px !Important;"><?php echo $dotacao; ?> </td>
             <td style="padding:5px !Important;"> <?php echo $empenho->txtRazaoSocial ; ?> </td>
             <td style="padding:5px !Important;"> <?php echo date("d/m/Y", strtotime($empenho->datEmpenho)); ?> </td>
             <td style="padding:5px !Important;"><?php echo "<span style='display:none'>".str_pad(number_format($empenho->valTotalEmpenhado, 2, ',', '.'), 14, '0', STR_PAD_LEFT)."</span>".numfmt_format_currency($fmt, $empenho->valTotalEmpenhado, "BRL"); ?> </td>
             <td style="padding:5px !Important;"> <?php echo "<span style='display:none'>".str_pad(number_format($empenho->valAnuladoEmpenho, 2, ',', '.'), 14, '0', STR_PAD_LEFT)."</span>".numfmt_format_currency($fmt, $empenho->valAnuladoEmpenho, "BRL"); ?> </td>
             <td style="padding:5px !Important;"> <?php echo "<span style='display:none'>".str_pad(number_format($empenho->valEmpenhadoLiquido, 2, ',', '.'), 14, '0', STR_PAD_LEFT)."</span>".numfmt_format_currency($fmt, $empenho->valEmpenhadoLiquido, "BRL"); ?> </td>
             <td style="padding:5px !Important;"><?php echo "<span style='display:none'>".str_pad(number_format($empenho->valLiquidado, 2, ',', '.'), 14, '0', STR_PAD_LEFT)."</span>".numfmt_format_currency($fmt, $empenho->valLiquidado, "BRL"); ?> </td>			 
		</tr>     
<?php 
 $linha = array($empenho->codEmpenho."/".$empenho->anoEmpenho, $dotacao, $empenho->txtRazaoSocial, date("d/m/Y", strtotime($empenho->datEmpenho)), $empenho->valTotalEmpenhado,$empenho->valAnuladoEmpenho, $empenho->valEmpenhadoLiquido, $empenho->valLiquidado ); 

 //fputcsv($csv, $linha);

} 
 //fclose($csv);
?>        
             
	</table>    

<p>Observações:</p>
<p>Em razão de alteração na Lei de Responsabilidade Fiscal dada pela Lei Complementar nº 156 de 2016, desde janeiro de 2018 a Câmara Municipal de São Paulo passou a usar o mesmo sistema orçamentário e financeiro (SOF) da Prefeitura Municipal de São Paulo (PMSP).</p>

<p>Para acessar dados anteriores a 2018 <a href="http://transparencia.saopaulo.sp.leg.br/cmsppt/#/">clique aqui.</a></p>

<p>Numa iniciativa de incentivo à <a href="http://www.planalto.gov.br/ccivil_03/_ato2011-2014/2011/lei/l12527.htm">Transparência</a> e projetos baseados em <a href="http://dados.gov.br/pagina/dados-abertos">Dados Abertos</a>, a PMSP mantém uma Vitrine de <a href="https://api.prodam.sp.gov.br/index.html">APIs</a>, dentre as quais há uma dedicada ao <a href="https://api.prodam.sp.gov.br/store/apis/info?name=SOF&version=v3.0.1&provider=admin">SOF</a>.
Os dados aqui exibidos apresentam um atraso de até 1 dia em relação ao cadastramento da informação no SOF em função dos processos de transformação e cópia para fins de publicação.</p>

<p>Clique abaixo para baixar os dados.</p>

<div style="display: flex;">
<form action="wp-content/uploads/transparencia/empenhos-xlsx.php" method="post">
<input type="hidden" name="codEmpresa" value="18"/>
<button  style="background-color: #2db55d;color:#fff;padding:4px;" type="submit">XLSX</button>
</form>&nbsp;
<form action="/wp-content/uploads/transparencia/18_empenhos.csv" method="post">
<button style="background-color: #dfb100;color:#fff;padding:4px;" type="submit">CSV</button>
</form>
</div>

					</section><?php //end article section ?>
				</article>
			</div>
						<!-- Sidebar -->
						<?php// get_sidebar('page'); ?>

		</div>
	</div>

<?php get_footer(); ?>