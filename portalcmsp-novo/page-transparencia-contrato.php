<?php
/*
 Template Name: Transparência - Contrato
*/
?>
<link rel="stylesheet" type="text/css" href="Site.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>	
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>	
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>	

<script>
	
	$(window).on('load', function() {
		$("#grid").DataTable({
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
				"paging": false,
				"info": false,
				"ordering": false,
				"searching": false
				});
	});
		
</script>
<?php get_header(); ?>

<?php
setlocale(LC_MONETARY, 'pt_BR');
$fmt = numfmt_create( 'pt_BR', NumberFormatter::CURRENCY );

global $wpdb;

$codEmpresa = $_GET['codEmpresa'];
$codContrato = $_GET['codContrato'];
$anoContrato = $_GET['anoContrato'];

$tabela = "transp_contratos";
$contratos = $wpdb->get_results( "SELECT * FROM $tabela where codEmpresa=18 order by datPublicacaoContrato" );

$queryEmpenho = $wpdb->prepare("SELECT e.*, c.numoriginalcontrato as numoriginal, c.codcontrato, c.codempresa, c.anocontrato, c.txtTipoContratacao as tipocontratacao FROM transp_empenhos e, transp_contratos c 
WHERE e.numcontrato=c.codcontrato and e.codempresa=c.codempresa and e.anocontrato=c.anocontrato and e.numContrato = %d AND e.codEmpresa=%d  and e.anoContrato=%d",[ $codContrato, $codEmpresa, $anoContrato ]);


//SELECT e.*, c.numoriginalcontrato, c.codcontrato, c.codempresa, c.anocontrato FROM wordpress.empenhos e, wordpress.contratos c
//WHERE  e.numcontrato=c.codcontrato and e.codempresa=c.codempresa and e.anocontrato=c.anocontrato and
//e.numContrato =118 AND e.codEmpresa=18  and e.anoContrato=2020

//$wpdb->prepare("SELECT e.codEmpenho,e.anoEmpenho,e.datEmpenho,e.codProcesso,e.codOrgao,e.codUnidade,e.codFuncao,e.codSubFuncao,e.codPrograma,e.codProjetoAtividade,e.codCategoria,e.codGrupo,e.codModalidade,
//e.codElemento,e.txtDescricaoFonteRecurso,e.txtDescricaoPrograma,e.txtCategoriaEconomica,e.txtModalidadeAplicacao,e.txtDescricaoSubFuncao,e.txtDescricaoSubElemento,e.txtDescricaoElemento,e.txtDescricaoProjetoAtividade,
//e.txtGrupoDespesa,e.txtRazaoSocial,e.numCpfCnpj,e.txtDescricaoItemDespesa,e.valPagoRestos,e.valPagoExercicio,e.txtDescricaoOrgao,e.txtDescricaoUnidade,e.txtDescricaoFuncao,e.valTotalEmpenhado,e.valAnuladoEmpenho,e.valLiquidado, e.valEmpenhadoLiquido, e.numContrato, e.anoContrato 
//FROM empenhos e where e.numContrato=%d and e.anoContrato=%d and e.codEmpresa=%d",[ $codContrato, $anoContrato, $codEmpresa ]);

$empenhos = $wpdb->get_results($queryEmpenho);

/*
$queryContrato = $wpdb->prepare("SELECT codContrato,anoContrato,datPublicacaoContrato,datAssinaturaContrato,datVigencia,numOriginalContrato,txtTipoContratacao,txtDescricaoModalidade,txtObjetoContrato,valPrincipal,valPago,valEmpenhadoLiquido 
,valTotalEmpenhado,valReajustes,valAditamentos,valLiquidado,valAnuladoEmpenho,valAnulacao 
FROM contratos where codContrato=%d and anoContrato=%d and codEmpresa=%d",[  $emp->numContrato, $emp->anoContrato, $codEmpresa ]);

$con = $wpdb->get_row($queryContrato);
*/
if(!empty($empenhos)){
$count=0;
foreach ($empenhos as $emp){ 
			$params="codEmpresa=".$codEmpresa."&codEmpenho=".$emp->codEmpenho."&anoEmpenho=".$emp->anoEmpenho;	
if($count==0){

$tab = '<br/><br/><table id="grid" class="display" width="50%" cellspacing="0" style="font-size: 1em;width:50%;text-align:center;">'.PHP_EOL;
$tab .= '<thead>
		<tr style="background-color:#ccc;">
			 <th>Contrato</th><th colspan="8">'.$codContrato."/".$anoContrato.'</th>
			 </tr>
		<tr>
			 <th>Número Original do Contrato</th><th colspan="8">'.$emp->numoriginal.'</th>
			 </tr>
		<tr>
			 <th>Credor</th><th colspan="8">'.$emp->txtRazaoSocial.'</th>
			 </tr>
		<tr>
			 <th>CPF/CNPJ</th><th colspan="8">'.$emp->numCpfCnpj.'</th>
			 </tr>
		<tr>
			 <th>Tipo de Contratação</th><th colspan="8">'.$emp->tipocontratacao.'</th>
			 </tr>
		<tr>
			 <th>Empenho</th>
			 <th>Data Empenho</th>
			 <th>Total Empenhado</th>
			 <th>Anulado</th>
			 <th>Empenhado Líquido</th>
			 <th>Liquidado</th>
			 <th>Pago Exercício</th>
			 <th>Pago Restos</th>
		</tr>
		</thead>';
$count++;
}

$dotacao="{$emp->codOrgao}.{$emp->codUnidade}.{$emp->codFuncao}.".
	"{$emp->codSubFuncao}.{$emp->codPrograma}.{$emp->codProjetoAtividade}.".
	"{$emp->codCategoria}.{$emp->codGrupo}.{$emp->codModalidade}.".
	"{$emp->codElemento}";						
//<a href='.'"empenho/?'.$params."'>'.$emp->codEmpenho.'/'.$emp->anoEmpenho.'</a> '. '
$tab .= '	<tr><td>  <a href="/empenho/?'.$params.'">'.$emp->codEmpenho.'/'.$emp->anoEmpenho.'</a></td>'.PHP_EOL;
$tab .= '	<td>'.date("d/m/Y", strtotime($emp->datEmpenho)).'</td>'.PHP_EOL;
//$tab .= '	<td>'.$dotacao.'</td>'.PHP_EOL;
//$tab .= '	<tr><td>Programa</td><td>'.$emp->txtDescricaoPrograma.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Projeto/Atividade</td><td>'.$emp->txtDescricaoProjetoAtividade.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Categoria</td><td>'.$emp->txtCategoriaEconomica.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Grupo</td><td>'.$emp->txtGrupoDespesa.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Modalidade</td><td>'.$emp->txtModalidadeAplicacao.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Elemento</td><td>'.$emp->txtDescricaoElemento.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Subelemento</td><td>'.$emp->txtDescricaoSubElemento.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Item da despesa</td><td>'.$emp->txtDescricaoItemDespesa.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Fonte de Recursos</td><td>'.$emp->txtDescricaoFonteRecurso.'</td></tr>'.PHP_EOL;
//
$tab .= '	<td>R$ '.number_format($emp->valTotalEmpenhado,2,',','.').'</td>'.PHP_EOL;
$tab .= '	<td>R$ '.number_format($emp->valAnuladoEmpenho,2,',','.').'</td>'.PHP_EOL;
$tab .= '	<td>R$ '.number_format($emp->valEmpenhadoLiquido,2,',','.').'</td>'.PHP_EOL;
$tab .= '	<td>R$ '.number_format($emp->valLiquidado,2,',','.').'</td>'.PHP_EOL;
$tab .= '	<td>R$ '.number_format($emp->valPagoExercicio,2,',','.').'</td>'.PHP_EOL;
$tab .= '	<td>R$ '.number_format($emp->valPagoRestos,2,',','.').'</td></tr>'.PHP_EOL;

}   
$tab .= '</table>'.PHP_EOL;
 
echo $tab."<br/><br/>";

}else{
	echo "<p>Não existem empenhos cadastrados no SOF associados a esse contrato.</p>";
}
?>
    </main>
<?php get_footer(); ?>