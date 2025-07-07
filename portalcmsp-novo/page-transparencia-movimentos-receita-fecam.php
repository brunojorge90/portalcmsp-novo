<?php
/*
 Template Name: Movimentos Receita - FECAM
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
		padding: 8px !important;
		}
	
	</style>
	
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
	global $wpdb;

	$tabela = "transp_movimentos_receita";
	$codEmpresa = "22";

	$queryMov = $wpdb->prepare("SELECT * FROM $tabela where codEmpresa=%d order by anoExercicio desc, codMovimentoReceita desc",[ $codEmpresa ]);

	$movs = $wpdb->get_results($queryMov);
	
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
			 <th style="padding:5px !Important;">Ano</th>
			 <th style="padding:5px !Important;">Dotação</th>
			 <th style="padding:5px !Important;">Descrição</th>
			 <th style="padding:5px !Important;">Valor Realizado</th>
		</tr>
		</thead>
	<?php foreach ($movs as $mov){		
				if ($mov->valRealizado > 0) {	
	?>
		<tr>
			<td style="padding:8px !Important;"><?php echo $mov->anoExercicio; ?> </td>
			<td style="padding:8px !Important;"><?php echo $mov->codMovimentoReceita; ?> </td>
			<td style="padding:8px !Important;text-align:left;"><?php echo $mov->txtDescricaoMovimentoReceita; ?> </td>
			<td style="padding:8px !Important;text-align:right;"><?php echo numfmt_format_currency($fmt, $mov->valRealizado, "BRL"); ?> </td>
		</tr>     
		<?php 
				}
		} 

?>        
             
	</table>    

<p>Observações:</p>
<p>Em razão de alteração na Lei de Responsabilidade Fiscal dada pela Lei Complementar nº 156 de 2016, desde janeiro de 2018 a Câmara Municipal de São Paulo passou a usar o mesmo sistema orçamentário e financeiro (SOF) da Prefeitura Municipal de São Paulo (PMSP).</p>

<p>Para acessar dados anteriores a 2018 <a href="http://transparencia.saopaulo.sp.leg.br/cmsppt/#/">clique aqui.</a></p>

<p>Numa iniciativa de incentivo à <a href="http://www.planalto.gov.br/ccivil_03/_ato2011-2014/2011/lei/l12527.htm">Transparência</a> e projetos baseados em <a href="http://dados.gov.br/pagina/dados-abertos">Dados Abertos</a>, a PMSP mantém uma Vitrine de <a href="https://api.prodam.sp.gov.br/index.html">APIs</a>, dentre as quais há uma dedicada ao <a href="https://api.prodam.sp.gov.br/store/apis/info?name=SOF&version=v3.0.1&provider=admin">SOF</a>.
Os dados aqui exibidos apresentam um atraso de até 1 dia em relação ao cadastramento da informação no SOF em função dos processos de transformação e cópia para fins de publicação.</p>

<p>Clique abaixo para baixar os dados.</p>

<div style="display: flex;">
<form action="wp-content/uploads/transparencia/movimentos-receita-xlsx.php" method="post">
<input type="hidden" name="codEmpresa" value="22"/>
<button  style="background-color: #2db55d;color:#fff;padding:4px;" type="submit">XLSX</button>
</form>&nbsp;
<form action="/wp-content/uploads/transparencia/22_movimentos_receita.csv" method="post">
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
</main>
<?php get_footer(); ?>