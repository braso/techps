<?php

include "conecta.php";

function motorista_nao_cadastrado()
{
    $sqlPonto = query("SELECT pont_tx_matricula FROM ponto WHERE pont_tx_matricula");

    $pontos = mysqli_fetch_all($sqlPonto, MYSQLI_ASSOC);


    $motoristas = [];


    foreach ($pontos  as $valor) {

        $sqlMotorista = query("SELECT enti_tx_matricula FROM entidade WHERE enti_tx_matricula = " . $valor[pont_tx_matricula]);
        $aMotorista = carrega_array($sqlMotorista);

        if ($aMotorista == null) {

            $motoristas[] = $valor[pont_tx_matricula];

        }
    }


    return array_unique($motoristas);

}


function index() {
	global $CACTUX_CONF;

	cabecalho('Matriculas Não Cadastrados');


    echo '<div class="col-md-3 col-sm-3" style="left: 500px;">';
    echo '<div class="portlet light ">';
    echo '<div class="portlet-body form">';

    echo '		<style>
    table thead tr th:nth-child(4),
    table thead tr th:nth-child(8),
    table thead tr th:nth-child(12),
    table td:nth-child(4),
    table td:nth-child(8),
    table td:nth-child(12) {
        border-right: 3px solid #d8e4ef !important;
    }
</style>';

    echo '<div class="table-responsive">';
	echo "<table class='table w-auto text-xsmall table-bordered table-striped table-condensed flip-content table-hover compact'>";

    echo "<thead><tr>";
    echo "<th>MATRÍCULAS</th>";
    echo "<th>Total = ".sizeof(motorista_nao_cadastrado())."</th>";
    echo "</thead></tr>";

    $matriculas = motorista_nao_cadastrado();

    echo "<tbody>";
    foreach ($matriculas as $valor) {
        echo "<tr>";
        echo "<td>".$valor."</td>";
        echo "</tr>";
    }


    echo "</tbody>";
    echo "</table>";
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

	rodape();


}

?>
