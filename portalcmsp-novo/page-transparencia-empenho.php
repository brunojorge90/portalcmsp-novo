<?php
/*
 Template Name: Transparência - Empenho
*/
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>	
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>	
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>	
<?php get_header(); ?>

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
				"paging": true
				});
	});
		
</script>

<?php
setlocale(LC_MONETARY, 'pt_BR');
$fmt = numfmt_create( 'pt_BR', NumberFormatter::CURRENCY );

global $wpdb;

$codEmpresa = $_GET['codEmpresa'];
$codEmpenho = $_GET['codEmpenho'];
$anoEmpenho = $_GET['anoEmpenho'];

//$query = $wpdb->prepare("SELECT e.codempenho,e.anoempenho,e.datEmpenho,e.codProcesso,e.txtDescricaoFonteRecurso,e.txtDescricaoPrograma,e.txtCategoriaEconomica,e.txtModalidadeAplicacao,e.txtDescricaoSubFuncao ,
//e.txtDescricaoSubElemento,e.txtDescricaoElemento,e.txtDescricaoProjetoAtividade,e.txtGrupoDespesa,e.txtRazaoSocial,e.numCpfCnpj,e.txtDescricaoItemDespesa,e.valPagoRestos,e.valPagoExercicio,e.codOrgao,e.codUnidade,
//e.codFuncao,e.codSubFuncao,e.codPrograma,e.codProjetoAtividade,e.codCategoria,e.codGrupo,e.codModalidade,e.codElemento,c.codcontrato,c.anocontrato,c.datPublicacaoContrato,c.datAssinaturaContrato,c.datVigencia,
//c.numOriginalContrato,c.txtTipoContratacao,c.txtDescricaoModalidade,c.txtObjetoContrato,c.valPrincipal,c.valPago,c.valEmpenhadoLiquido ,c.valTotalEmpenhado,c.valReajustes,c.valAditamentos,c.valLiquidado,c.valAnuladoEmpenho,c.valAnulacao  
//FROM transparencia.empenhos e join transparencia.contratos c on e.numcontrato = c.codcontrato and e.anocontrato=c.anocontrato and e.codempresa=c.codempresa where codEmpenho=%d and anoEmpenho=%d and codEmpresa=%d",[ $codEmpenho, $anoEmpenho, $codEmpresa ]);

$queryEmpenho = $wpdb->prepare("SELECT e.codEmpenho,e.anoEmpenho,e.datEmpenho,e.codProcesso,e.codOrgao,e.codUnidade,e.codFuncao,e.codSubFuncao,e.codPrograma,e.codProjetoAtividade,e.codCategoria,e.codGrupo,e.codModalidade,
e.codElemento,e.txtDescricaoFonteRecurso,e.txtDescricaoPrograma,e.txtCategoriaEconomica,e.txtModalidadeAplicacao,e.txtDescricaoSubFuncao,e.txtDescricaoSubElemento,e.txtDescricaoElemento,e.txtDescricaoProjetoAtividade,
e.txtGrupoDespesa,e.txtRazaoSocial,e.numCpfCnpj,e.txtDescricaoItemDespesa,e.valPagoRestos,e.valPagoExercicio,e.txtDescricaoOrgao,e.txtDescricaoUnidade,e.txtDescricaoFuncao,e.valTotalEmpenhado,e.valAnuladoEmpenho,e.valLiquidado, e.valEmpenhadoLiquido, e.numContrato, e.anoContrato 
FROM transp_empenhos e where e.codEmpenho=%d and e.anoEmpenho=%d and e.codEmpresa=%d",[ $codEmpenho, $anoEmpenho, $codEmpresa ]);

$emp = $wpdb->get_row($queryEmpenho);

$queryContrato = $wpdb->prepare("SELECT codContrato,anoContrato,datPublicacaoContrato,datAssinaturaContrato,datVigencia,numOriginalContrato,txtTipoContratacao,txtDescricaoModalidade,txtObjetoContrato,valPrincipal,valPago,valEmpenhadoLiquido 
,valTotalEmpenhado,valReajustes,valAditamentos,valLiquidado,valAnuladoEmpenho,valAnulacao 
FROM transp_contratos where codContrato=%d and anoContrato=%d and codEmpresa=%d",[  $emp->numContrato, $emp->anoContrato, $codEmpresa ]);

$con = $wpdb->get_row($queryContrato);
$dotacao="{$emp->codOrgao}.{$emp->codUnidade}.{$emp->codFuncao}.".
	"{$emp->codSubFuncao}.{$emp->codPrograma}.{$emp->codProjetoAtividade}.".
	"{$emp->codCategoria}.{$emp->codGrupo}.{$emp->codModalidade}.".
	"{$emp->codElemento}";						

$tab = '<br/><br/><table id="grid" class="display" width="50%" cellspacing="0" style="font-size: 1em;width:50%">'.PHP_EOL;
$tab .= '	<tr><td>Empenho</td><td>'.$emp->codEmpenho."/".$emp->anoEmpenho.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Data Empenho</td><td>'.date("d/m/Y", strtotime($emp->datEmpenho)).'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Dotação</td><td>'.$dotacao.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Órgao</td><td>'.$emp->txtDescricaoOrgao.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Unidade</td><td>'.$emp->txtDescricaoUnidade.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Função</td><td>'.$emp->txtDescricaoFuncao.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Subfunção</td><td>'.$emp->txtDescricaoSubFuncao.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Programa</td><td>'.$emp->txtDescricaoPrograma.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Projeto/Atividade</td><td>'.$emp->txtDescricaoProjetoAtividade.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Categoria</td><td>'.$emp->txtCategoriaEconomica.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Grupo</td><td>'.$emp->txtGrupoDespesa.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Modalidade</td><td>'.$emp->txtModalidadeAplicacao.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Elemento</td><td>'.$emp->txtDescricaoElemento.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Subelemento</td><td>'.$emp->txtDescricaoSubElemento.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Item da despesa</td><td>'.$emp->txtDescricaoItemDespesa.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Fonte de Recursos</td><td>'.$emp->txtDescricaoFonteRecurso.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Credor</td><td>'.$emp->txtRazaoSocial.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>CPF/CNPJ</td><td>'.$emp->numCpfCnpj.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Total Empenhado</td>'."<td>R$ ".number_format($emp->valTotalEmpenhado,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Anulado</td>'."<td>R$ ".number_format($emp->valAnuladoEmpenho,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Empenhado Líquido</td>'."<td>R$ ".number_format($emp->valEmpenhadoLiquido,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Liquidado</td>'."<td>R$ ".number_format($emp->valLiquidado,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Pago Exercício</td>'."<td>R$ ".number_format($emp->valPagoExercicio,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Pago Restos</td>'."<td>R$ ".number_format($emp->valPagoRestos,2,',','.').'</td></tr>'.PHP_EOL;
//Exibe dados do contrato, caso exista.
if($con != ""){
	
$dataPublicacao = "";
if($con->datPublicacaoContrato != "0000-00-00"){
	$dataPublicacao = date("d/m/Y", strtotime($con->datPublicacaoContrato));
}
$dataAssinaturaContrato = "";
if($con->datAssinaturaContrato != "0000-00-00"){
	$dataAssinaturaContrato = date("d/m/Y", strtotime($con->datAssinaturaContrato));
}
$dataVigencia = "";
if($con->datVigencia != "0000-00-00"){
	$dataVigencia = date("d/m/Y", strtotime($con->datVigencia));
}

$params="codEmpresa=".$codEmpresa."&codContrato=".$con->codContrato."&anoContrato=".$con->anoContrato;	
$codConPad = str_pad("{$contrato->codContrato}", 3, '0', STR_PAD_LEFT);
$dataOrder="{$contrato->anoContrato}{$codConPad}";//.$codPage.$numEmp.$codEmpPad;		

$tab .= '	<tr><td style="background:#fff;color: #fff;" colspan=2></td></tr>'.PHP_EOL;
$tab .= '	<tr><td style="background:#ccc;color: #000;">Contrato</td>'."<td style='background:#ccc;color: #fff;'><a href='/contrato/?".$params."'>".$con->codContrato."/".$con->anoContrato.'</a></td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Número</td>'."<td>".$con->codContrato.'</td></tr>'.PHP_EOL;
//$tab .= '	<tr><td>Ano</td>'."<td>".$con->anoContrato.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Data da Publicação</td>'."<td>".$dataPublicacao.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Data da Assinatura</td>'."<td>".$dataAssinaturaContrato.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Data da Vigência</td>'."<td>".$dataVigencia.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Número Original Contrato</td>'."<td>".$con->numOriginalContrato.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Objeto Contrato Contrato</td>'."<td>".$con->txtObjetoContrato.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Modalidade</td>'."<td>".$con->txtDescricaoModalidade.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Tipo Contratação</td>'."<td>".$con->txtTipoContratacao.'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Principal</td>'."<td>R$ ".number_format($con->valPrincipal,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Pago</td>'."<td>R$ ".number_format($con->valPago).'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Empenhado Líquido</td>'."<td>R$ ".number_format($con->valEmpenhadoLiquido,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Total Empenhado</td>'."<td>R$ ".number_format($con->valTotalEmpenhado,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Reajustes</td>'."<td>R$ ".number_format($con->valReajustes,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Aditamentos</td>'."<td>R$ ".number_format($con->valAditamentos,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Liquidado</td>'."<td>R$ ".number_format($con->valLiquidado,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Anulado Empenho</td>'."<td>R$ ".number_format($con->valAnuladoEmpenho,2,',','.').'</td></tr>'.PHP_EOL;
$tab .= '	<tr><td>Valor Anulação</td>'."<td>R$ ".number_format($con->valAnulacao,2,',','.').'</td></tr>'.PHP_EOL;
}
$tab .= '</table><br/><br/>'.PHP_EOL;

echo $tab;

?>
  
<?php get_footer(); ?>