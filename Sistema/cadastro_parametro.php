<?php
include "conecta.php";

function exclui_parametro(){

	remover('parametro',$_POST[id]);
	index();
	exit;

}
function modifica_parametro(){
	global $a_mod;

	$a_mod=carregar('parametro',$_POST[id]);

	layout_parametro();
	exit;

}

function cadastra_parametro(){
	
	$campos=array(
		para_tx_nome, para_tx_jornadaSemanal, para_tx_jornadaSabado, para_tx_percentualHE, para_tx_percentualSabadoHE, para_tx_HorasEXExcedente, 
		para_tx_tolerancia, para_tx_acordo, para_tx_inicioAcordo, para_tx_fimAcordo, para_nb_userCadastro, para_tx_dataCadastro, para_tx_diariasCafe, 
		para_tx_diariasAlmoco, para_tx_diariasJanta, para_tx_status
	);
	$valores=array(
		$_POST[nome], $_POST[jornadaSemanal], $_POST[jornadaSabado], $_POST[percentualHE], $_POST[percentualSabadoHE], $_POST[HorasEXExcedente], 
		$_POST[tolerancia],$_POST[acordo], $_POST[inicioAcordo], $_POST[fimAcordo], $_SESSION[user_nb_id],date("Y-m-d"),
		$_POST[diariasCafe], $_POST[diariasAlmoco], $_POST[diariasJanta], 'ativo'
	);

	if($_POST[id]>0)
		atualizar('parametro',$campos,$valores,$_POST[id]);
	else
		inserir('parametro',$campos,$valores);

	index();
	exit;
}



function layout_parametro(){
	global $a_mod;

	cabecalho("Cadastro de Parâmetros");

	$c[] = campo('Nome','nome',$a_mod[para_tx_nome],6);
	// $c[] = campo('Jornada Semanal (Horas)','jornadaSemanal',$a_mod[para_tx_jornadaSemanal],3,'MASCARA_NUMERO');
	// $c[] = campo('Jornada Sábado (Horas)','jornadaSabado',$a_mod[para_tx_jornadaSabado],3,'MASCARA_NUMERO');
	$c[] = campo_hora('Jornada Semanal (Horas/Dia)','jornadaSemanal',$a_mod[para_tx_jornadaSemanal],3);
	$c[] = campo_hora('Jornada Sábado (Horas/Dia)','jornadaSabado',$a_mod[para_tx_jornadaSabado],3);
	$c[] = campo_hora('Tolerência de jornada efetiva (Horas/Minutos)','tolerancia',$a_mod[para_tx_tolerancia],3);
	$c[] = campo('Percentual da Hora Extra(%)','percentualHE',$a_mod[para_tx_percentualHE],3,'MASCARA_NUMERO');
	$c[] = campo('Percentual da Hora Extra Sábado(%)','percentualSabadoHE',$a_mod[para_tx_percentualSabadoHE],3,'MASCARA_NUMERO');
	$c[] = campo_hora('Quando Exceder o limite de Horas Extras, O Percentual de Hora Extra passar para 100% (Horas/Minutos)','HorasEXExcedente',$a_mod[para_tx_HorasEXExcedente],3);
	$c[] = campo('Diária Café da Manhã(R$)','diariasCafe',$a_mod[para_tx_diariasCafe],3,'MASCARA_DINHERO');
	$c[] = campo('Diária Almoço(R$)','diariasAlmoco',$a_mod[para_tx_diariasAlmoco],3,'MASCARA_DINHERO');
	$c[] = campo('Diária Jantar(R$)','diariasJanta',$a_mod[para_tx_diariasJanta],3,'MASCARA_DINHERO');
	$c[] = combo('Acordo Sindical','acordo',$a_mod[para_tx_acordo],3,array('Sim','Não'));
	$c[] = campo_data('Início do Acordo','inicioAcordo',$a_mod[para_tx_inicioAcordo],3);
	$c[] = campo_data('Fim do Acordo','fimAcordo',$a_mod[para_tx_fimAcordo],3);
	
	$botao[] = botao('Gravar','cadastra_parametro','id',$_POST[id]);
	$botao[] = botao('Voltar','index');
	
	abre_form('Dados da de Parâmetros');
	linha_form($c);
	fecha_form($botao);

	rodape();
}

function index(){

	cabecalho("Cadastro de Parâmetros");

	$extra = '';

	if($_POST[busca_codigo])
		$extra .= " AND para_nb_id = '$_POST[busca_codigo]'";

	if($_POST[busca_nome])
		$extra .= " AND para_tx_nome LIKE '%$_POST[busca_nome]%'";

	$c[] = campo('Código','busca_codigo',$_POST[busca_codigo],2,'MASCARA_NUMERO');
	$c[] = campo('Nome','busca_nome',$_POST[busca_nome],10);

	$botao[] = botao('Buscar','index');
	$botao[] = botao('Inserir','layout_parametro');
	
	abre_form('Filtro de Busca');
	linha_form($c);
	fecha_form($botao);

	$sql = "SELECT * FROM parametro WHERE para_tx_status != 'inativo' $extra";
	$cab = array('CÓDIGO','NOME','JORNADA SEMANAL/DIA','JORNADA SÁBADO','HR(%)','HR SÁBADO(%)','ACORDO','INÍCIO','FIM','','');
	$val = array('para_nb_id','para_tx_nome','para_tx_jornadaSemanal','para_tx_jornadaSabado','para_tx_percentualHE','para_tx_percentualSabadoHE','para_tx_acordo','data(para_tx_inicioAcordo)','data(para_tx_fimAcordo)','icone_modificar(para_nb_id,modifica_parametro)','icone_excluir(para_nb_id,exclui_parametro)');

	grid($sql,$cab,$val);

	rodape();

}