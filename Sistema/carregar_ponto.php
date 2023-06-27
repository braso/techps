<?php
session_start();
// error_reporting(E_ALL);

include "conecta.php";

// function finaliza_retorno(){

// 	$sql=" SELECT *	FROM baixaretorno,boleto,movimento,entidade
// 		WHERE bole_nb_movimento = movi_nb_id AND movi_nb_entidade = enti_nb_id AND baix_nb_boleto = bole_nb_id 
// 		AND baix_tx_situacao != 'Duplicado' AND baix_tx_situacao != 'Já baixado' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	while($a=carrega_array($sql)){
// 		atualizar('boleto',
// 			array(bole_tx_valor,bole_tx_data),
// 			array($a[baix_tx_valor],$a[baix_tx_dataPagamento]),
// 			$a[bole_nb_id]);
// 	}

// 	atualizar('retornobnb',array('reto_tx_status'),array('encerrado'),$_POST[id]);

// 	index();
// 	exit;



// }

// function layout_confirma(){
// 	$a=carregar('retornobnb',$_POST[id]);
// 	$a_use = carregar('user',$a[reto_nb_user]);
// 	cabecalho('Retorno BNB');

// 	$c[] = texto('Código',$a[reto_nb_id],1);
// 	$c[] = texto('Arquivo',$a[reto_tx_nome],3);
// 	$c[] = texto('Data do Arquivo',data($a[reto_tx_dataArquivo]),3);
// 	$c[] = texto('Data do Cadastro',data($a[reto_tx_data]),3);
// 	$c[] = texto('Usuário',$a_use[user_tx_login],2);

// 	if($a[reto_tx_status]!='encerrado')
// 		$b[] = botao('Finalizar','finaliza_retorno','id',$_POST[id]);

// 	$b[] = botao('Voltar','index');

// 	abre_form('Dados do Retorno');
// 	linha_form($c);
// 	fecha_form($b);

// 	//boletos encontrados
// 	$sql=" SELECT *	FROM baixaretorno,boleto,movimento,entidade WHERE bole_nb_movimento = movi_nb_id AND movi_nb_entidade = enti_nb_id AND baix_nb_boleto = bole_nb_id AND baix_tx_situacao = '' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	$cab = array('CÓD','NOSSO NUM.','ALUNO','VENCIMENTO','VALOR','DATA PG.','VALOR PG.');
// 	$val = array('baix_nb_id','baix_tx_nossoNum','enti_tx_nome','data(bole_tx_vencimento)','valor(bole_tx_valordoc)',
// 		'data(baix_tx_dataPagamento)','valor(baix_tx_valor)');
// 	grid($sql,$cab,$val,'Boletos Encontrados');

// 	//Valor inferior
// 	$sql=" SELECT *	FROM baixaretorno,boleto,movimento,entidade WHERE bole_nb_movimento = movi_nb_id AND movi_nb_entidade = enti_nb_id AND baix_nb_boleto = bole_nb_id AND baix_tx_situacao = 'Valor inferior' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	if(num_linhas(query($sql." LIMIT 1"))>0){
// 		$cab = array('CÓD','NOSSO NUM.','ALUNO','VENCIMENTO','VALOR','DATA PG.','VALOR PG.');
// 		$val = array('baix_nb_id','baix_tx_nossoNum','enti_tx_nome','data(bole_tx_vencimento)','valor(bole_tx_valordoc)',
// 			'data(baix_tx_dataPagamento)','valor(baix_tx_valor)');
// 		grid($sql,$cab,$val,'Valor Inferior');
// 	}

// 	//Valor superior
// 	$sql=" SELECT *	FROM baixaretorno,boleto,movimento,entidade WHERE bole_nb_movimento = movi_nb_id AND movi_nb_entidade = enti_nb_id AND baix_nb_boleto = bole_nb_id AND baix_tx_situacao = 'Valor superior' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	if(num_linhas(query($sql." LIMIT 1"))>0){
// 		$cab = array('CÓD','NOSSO NUM.','ALUNO','VENCIMENTO','VALOR','DATA PG.','VALOR PG.');
// 		$val = array('baix_nb_id','baix_tx_nossoNum','enti_tx_nome','data(bole_tx_vencimento)','valor(bole_tx_valordoc)',
// 			'data(baix_tx_dataPagamento)','valor(baix_tx_valor)');
// 		grid($sql,$cab,$val,'Valor Superior');
// 	}

// 	//Já baixado
// 	$sql=" SELECT *	FROM baixaretorno,boleto,movimento,entidade WHERE bole_nb_movimento = movi_nb_id AND movi_nb_entidade = enti_nb_id AND baix_nb_boleto = bole_nb_id AND baix_tx_situacao = 'Já baixado' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	if(num_linhas(query($sql." LIMIT 1"))>0){
// 		$cab = array('CÓD','NOSSO NUM.','ALUNO','VENCIMENTO','VALOR','DATA PG.','VALOR PG.');
// 		$val = array('baix_nb_id','baix_tx_nossoNum','enti_tx_nome','data(bole_tx_vencimento)','valor(bole_tx_valordoc)',
// 			'data(baix_tx_dataPagamento)','valor(baix_tx_valor)');
// 		grid($sql,$cab,$val,'Já Baixado');
// 	}

// 	//Boleto Excluído
// 	$sql=" SELECT *	FROM baixaretorno,boleto,movimento,entidade WHERE bole_nb_movimento = movi_nb_id AND movi_nb_entidade = enti_nb_id AND baix_nb_boleto = bole_nb_id AND baix_tx_situacao = 'Boleto Excluído' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	if(num_linhas(query($sql." LIMIT 1"))>0){
// 		$cab = array('CÓD','NOSSO NUM.','ALUNO','VENCIMENTO','VALOR','DATA PG.','VALOR PG.');
// 		$val = array('baix_nb_id','baix_tx_nossoNum','enti_tx_nome','data(bole_tx_vencimento)','valor(bole_tx_valordoc)',
// 			'data(baix_tx_dataPagamento)','valor(baix_tx_valor)');
// 		grid($sql,$cab,$val,'Boleto Excluído');
// 	}

// 	//Duplicado
// 	$sql=" SELECT *	FROM baixaretorno,boleto,movimento,entidade WHERE bole_nb_movimento = movi_nb_id AND movi_nb_entidade = enti_nb_id AND baix_nb_boleto = bole_nb_id AND baix_tx_situacao = 'Duplicado' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	if(num_linhas(query($sql." LIMIT 1"))>0){
// 		$cab = array('CÓD','NOSSO NUM.','ALUNO','VENCIMENTO','VALOR','DATA PG.','VALOR PG.');
// 		$val = array('baix_nb_id','baix_tx_nossoNum','enti_tx_nome','data(bole_tx_vencimento)','valor(bole_tx_valordoc)',
// 			'data(baix_tx_dataPagamento)','valor(baix_tx_valor)');
// 		grid($sql,$cab,$val,'Duplicado');
// 	}

// 	//Boleto não encontrado
// 	$sql=" SELECT *	FROM baixaretorno WHERE baix_tx_situacao = 'Boleto não encontrado' AND baix_tx_status = 'ativo' AND baix_nb_retornobnb = '$_POST[id]' ";
// 	if(num_linhas(query($sql." LIMIT 1"))>0){
// 		$cab = array('CÓD','NOSSO NUM.','ALUNO','VENCIMENTO','VALOR','DATA PG.','VALOR PG.');
// 		$val = array('baix_nb_id','baix_tx_nossoNum','','','',
// 			'data(baix_tx_dataPagamento)','valor(baix_tx_valor)');
// 		grid($sql,$cab,$val,'Boleto Não Encontrado');
// 	}

// 	rodape();
// }




// function cadastra_retornobnb(){
	
// 	$arquivo=$_FILES[arquivo];
	
// 	if( $arquivo[name] != ''){

		
// 		$cam = array(reto_tx_data,reto_tx_nome,reto_nb_user,reto_tx_status);
// 		$val = array(date('Y-m-d'),$arquivo[name],$_SESSION[user_nb_id],'ativo');
// 		$id=inserir('retornobnb',$cam,$val);	
		
// 		enviar('arquivo',"retornobnb/");
// 		atualizar('retornobnb',array(reto_tx_arquivo),array($arquivo[name]),$id);

// 	}else{

// 		set_status('ERRO: Envie o arquivo de retornobnb!');
// 		layout_ordem();
// 		exit;

// 	}

// 	$file=file('retornobnb/'.$arquivo[name]);
// 	$t_file = count($file);



// 	for($i=1;$i<$t_file-2;$i++){ // CONTADOR FOR COMECA DO 2 POIS AS 2 PRIMEIRAS LINHAS ( O E 1 ) SAO HEADERS DO ARQUIVO
		
// 		$linha=$file[$i];

// 		$nosso_num=(int)substr($linha, 62,7);//LINHA T removido os 2 primeiros digitos verificadores (24) e os 3 ultimos q sao gerados pelo sistema
					
// 		$valor_pag=substr($linha, 253,13);
// 		$valor_pag=$valor_pag/100;

// 		$data_pag=substr($linha, 110,8); // DA LINHA U data da arrecadacao
//  		$dia=substr($data_pag, 0,2);
//  		$mes=substr($data_pag, 2,2);
//  		$ano="20".substr($data_pag, 4,2);
//  		$data_pag="$ano-$mes-$dia";


// 		$sql_bole=query("SELECT bole_nb_id,bole_tx_status,bole_tx_valordoc FROM boleto WHERE bole_tx_nossoNum='$nosso_num' LIMIT 2");
	
// 		if(num_linhas($sql_bole)==1){
// 			$a_bol = carrega_array($sql_bole);

// 			if($a_bol[bole_tx_status] == 'ativo'){
// 				$erro = '';
				
// 				if($valor_pag < $a_bol[bole_tx_valordoc]){
// 					$erro = 'Valor inferior';
// 				}
// 				if($valor_pag > $a_bol[bole_tx_valordoc]){
// 					$erro = 'Valor superior';
// 				}
// 			}elseif($a_bol[bole_tx_status] == 'encerrado'){
// 				$erro = 'Já baixado';
// 			}elseif($a_bol[bole_tx_status] == 'inativo'){
// 				$erro = 'Boleto Excluído';
// 			}

// 			$id_boleto = $a_bol[bole_nb_id];


// 		}elseif(num_linhas($sql_bole)>1){
// 			$erro = 'Duplicado';
// 		}elseif(num_linhas($sql_bole) == 0){
// 			$erro = 'Boleto não encontrado';
// 		}

		


//  		$campos = array(baix_nb_retornobnb,baix_nb_boleto,baix_tx_nossoNum,baix_tx_valor,baix_tx_dataPagamento,baix_nb_user,baix_tx_dataCadastro,baix_tx_situacao,baix_tx_status);
// 		$valores = array($id,$id_boleto,$nosso_num,$valor_pag,$data_pag,$_SESSION[user_nb_id],date("Y-m-d"),$erro,'ativo');
// 		inserir("baixaretorno",$campos,$valores);
// 		unset($erro,$id_boleto);


// 	}


// 	$linha=$file[0];
// 	$dia_arq = substr($linha,94,2);
// 	$mes_arq = substr($linha,96,2);
// 	$ano_arq = substr($linha,98,2);
// 	$data_pag = "20".$ano_arq."-".$mes_arq."-".$dia_arq;
// 	// echo"!$data_pag";
	
// 	atualizar('retornobnb',array('reto_tx_dataArquivo'),array($data_pag),$id);

// 	$_POST[id] = $id;
// 	layout_confirma();
// 	exit;

// }


function layout_ponto(){

	cabecalho('Carregar Ponto');


	//$c[] = campo('Data do Arquivo:','data',date("d/m/Y"),2,MASCARA_DATA);
	$c[] = arquivo('Arquivo Ponto (.txt):','arquivo','',5);

	$b[] = botao("Enviar",'cadastra_retornobnb');
	$b[] = botao("Voltar",'index');

	abre_form('Arquivo de Ponto');
	linha_form($c);
	fecha_form($b);

	rodape();
}


function layout_ftp(){
	// error_reporting(E_ALL);
	
	$arquivo = 'apontamento'.date('dmY').'*.txt';
	$path = 'arquivos/pontos/';

	$local_file = $path.$arquivo;
	$server_file = './'.$arquivo;
	
	// connect and login to FTP server
	$ftp_server = "ftp-jornadas.positronrt.com.br";
	$ftp_username = '08995631000108';
	$ftp_userpass = '0899';
	// $ftp_username = 'techps';
	// $ftp_userpass = '123456';
	
	// $ftp_server = "ftp.modulusistemas.com.br";
	// $ftp_username = 'techps@modulusistemas.com.br';
	// $ftp_userpass = 'A1c2r31234!techps';

	
	$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
	$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
	
	//BUSCA O ARQUIVO
	$fileList = ftp_nlist($ftp_conn, $arquivo);
	// $fileList = array(
	// 	'apontamento27032023010000.txt',
	// 	'apontamento28032023010000.txt',
	// 	'apontamento29032023010000.txt',
	// 	'apontamento30032023010000.txt',
	// 	'apontamento31032023010000.txt'
	// );
	// // print_r($fileList);exit;
	for ($i = 0; $i < count($fileList); $i++) {

		$sqlCheck = "SELECT * FROM arquivoponto WHERE arqu_tx_nome = '$fileList[$i]' AND arqu_tx_status = 'ativo' LIMIT 1";
		$queryCheck = query($sqlCheck);
		if(num_linhas($queryCheck) > 0){
			continue;
		}

		$local_file = $path.$fileList[$i];

		if (ftp_get($ftp_conn, $local_file, $fileList[$i], FTP_BINARY)){
			// echo "Successfully written to $path$fileList[$i]<br>";

			$campos = array(arqu_tx_nome, arqu_tx_data, arqu_nb_user, arqu_tx_status);
			$valores = array($fileList[$i], date("Y-m-d H:i:s"), $_SESSION['user_nb_id'], 'ativo');
			$idArquivo = inserir('arquivoponto',$campos,$valores);
			

			foreach(file($local_file) as $line) {
				$line = trim($line);
				$loginMotorista = substr($line,0,10)+0;
				
				$data = substr($line,10,8);
				$data = substr($data,4,4)."-".substr($data,2,2)."-".substr($data,0,2);
				
				$hora = substr($line,18,4);
				$hora = substr($hora,0,2).":".substr($hora,2,2).":00";
				
				$codigoExterno = substr($line,-2,2)+0;
				// echo $line."->";
				// echo "$loginMotorista|$data|$hora|$codigoExterno<hr>";

				$queryMacroPonto = query("SELECT macr_tx_codigoInterno FROM macroponto WHERE macr_tx_codigoExterno = '".$codigoExterno."'");
				$aTipo = carrega_array($queryMacroPonto);

				$campos = array(pont_nb_user, pont_nb_arquivoponto, pont_tx_matricula, pont_tx_data, pont_tx_tipo, pont_tx_tipoOriginal, pont_tx_status, pont_tx_dataCadastro);
				$valores = array($_SESSION[user_nb_id], $idArquivo, $loginMotorista, "$data $hora", $aTipo[0], $codigoExterno, 'ativo', date("Y-m-d H:i:s"));
				inserir('ponto',$campos,$valores);

			}
		} else {
			echo "There was a problem writing the file\n";
			exit;
		}
	}
	
	
	// var_dump($ftp_conn)
	// // then do something...
	// close connection
	ftp_close($ftp_conn);
	if($_SERVER['HTTP_ENV'] == 'carrega_cron'){
		exit;
	}
	index();
	exit;
	
}

function index() {
	global $CACTUX_CONF;
	if($_SERVER['HTTP_ENV'] == 'carrega_cron'){
		$_SESSION['user_nb_id']=1;
		$_SESSION['user_tx_nivel']='Administrador';
		$_SESSION['user_tx_login']='Adm';
		layout_ftp();
		exit;
	}
	
	cabecalho('Carregar Ponto',1);

	$extra = '';
	if($_POST[busca_inicio])
		$extra .= " AND reto_tx_dataArquivo >= '".data($_POST[busca_inicio],1)."'";
	if($_POST[busca_fim])
		$extra .= " AND reto_tx_dataArquivo <= '".data($_POST[busca_fim],1)."'";

	
	
	//CONSULTA
	$c[] = campo('Código:','busca_codigo',$_POST[busca_codigo],2);
	$c[] = campo('Data Início:','busca_inicio',$_POST[busca_inicio],2,MASCARA_DATA);
	$c[] = campo('Data Fim:','busca_fim',$_POST[busca_fim],2,MASCARA_DATA);
		
	
	//BOTOES
	$b[] = botao("Buscar",'index');
	$b[] = botao("Inserir",'layout_ponto');
	$b[] = botao("FTP",'layout_ftp');
	
	
	abre_form('Filtro de Busca');
	linha_form($c);
	fecha_form($b);
	
	
	$sql=" SELECT *	FROM arquivoponto,user WHERE  arqu_nb_user = user_nb_id AND  arqu_tx_status != 'inativo' $extra ";
	$cab = array('CÓD','ARQUIVO','USUÁRIO','DATA','SITUAÇÃO');

	// $ver2 = "icone_modificar(arqu_nb_id,layout_confirma)";
	$val = array('arqu_nb_id','arqu_tx_nome','user_tx_nome','data(arqu_tx_data,1)','ucfirst(arqu_tx_status)');
	grid($sql,$cab,$val,'','',0,'desc');

	
	rodape();

}
