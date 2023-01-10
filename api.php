<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


//test
//CE = 5063734
//HO = 47486

//declare @attention_id int = 47486
//declare @origin varchar(2) = 'HO'

//declare @attention_id int = 5063734
//declare @origin varchar(2) = 'CE'
$username = "";
if (isset($_REQUEST['username'])) {
	$username = $_REQUEST['username'];
}
if ($username != "") {
	include_once("conexion_ronald.php");
	$sql0 = "use lolcli_iecn";
	$conn_base->query($sql0);
	$sql1 = "use sihgea";
	$conn_base->query($sql1);
	$estado = '1';
	$sql_api = "select top 1 * from enrutador_ronald where usuario='$username' and estado='$estado' order by id_loco";
	$matriz = $conn_base->query($sql_api);
	$fila = $matriz->fetch(PDO::FETCH_ASSOC);
	$mensaje = "";
	$nreg = 0;
	if ($fila !== false) {
		$nreg = count($fila);
	}
	$response_api = array();
	$obj = new stdClass();
	if ($nreg > 0) {
		/*$response_api=array(
"history" =>$fila['history'],
"full_names" =>$fila['full_names'],
"document_number" =>$fila['document_number'],
"identification_type" =>$fila['identification_type'],
"age" =>$fila['age'],
"preinvoice" =>$fila['preinvoice'],
"origin" =>$fila['origin'],
"attention_id" =>$fila['attention_id'],
"fua" =>$fila['fua'],
"category" =>$fila['category'],
"service" =>$fila['service'],
"usuario" =>$fila['usuario'],
"id_pt" =>$fila['id_pt']
);*/

		$obj->id = $fila['id_loco'];
		$obj->history = $fila['history'];
		$obj->full_names = $fila['full_names'];
		$obj->document_number = $fila['document_number'];
		$obj->identification_type = $fila['identification_type'];
		$obj->age = $fila['age'];
		$obj->preinvoice = $fila['preinvoice'];
		$obj->origin = $fila['origin'];
		$obj->attention_id = $fila['attention_id'];
		$obj->fua = $fila['fua'];
		$obj->category = $fila['category'];
		$obj->service = $fila['service'];
		$obj->usuario = $fila['usuario'];
		$obj->id_pt = $fila['id_pt'];
	}

	header('Content-Type:application/json');
	echo json_encode($obj);
}