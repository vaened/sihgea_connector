<?php

//test 
//CE = 5063734
//HO = 47486

//declare @attention_id int = 47486 
//declare @origin varchar(2) = 'HO' 

//declare @attention_id int = 5063734 
//declare @origin varchar(2) = 'CE' 
$origin="";
$attention_id="";
$username="";
$tipo_doc=array();
$tipo_doc['DNI']=1;
$tipo_doc['LE']=12;
$tipo_doc['NI']=13;
$tipo_doc['D']=14;
$tipo_doc['CP']=15;
$tipo_doc['CA']=16;
$tipo_doc['CX']=17;
$tipo_doc['P']=18;
$tipo_doc['LT']=19;
$tipo_doc['PC']=20;
$tipo_doc['D.']=21;

if(isset($_REQUEST['username'])){
	$username=$_REQUEST['username'];
}
if(isset($_REQUEST['origin'])){
	$origin=$_REQUEST['origin'];
}
if(isset($_REQUEST['attention_id'])){
	$attention_id=$_REQUEST['attention_id'];
}

include_once("conexion_ronald.php");
	$sql0 = "use lolcli_iecn";
	$conn_base->query($sql0);

if($origin=='CE' or $origin=='EM'){
	$sql_cem="select
	pacientes.pachis [history],
	pacientes.pacpmn [full_names],
	pacientes.pacdoc [document_number],
	tipo_documento_identidad.tiddes [identification_type],
	dbo.calcEdad(pacientes.pacfen,citas.citdat) [age],
	citas.prfnum [preinvoice],
	'CONSULTA EXTERNA' [origin],
	citas.invnum [attention_id],
	fua_pages.number [fua],
	categorias_pago.pardes [category],
	servicios.serdes [service]
	from citas
	inner join prefacturas on prefacturas.prfnum = citas.prfnum 
	inner join categorias_pago on categorias_pago.parcod = prefacturas.parcod
	inner join pacientes on pacientes.pachis = citas.pachis
	inner join tipo_documento_identidad on  tipo_documento_identidad.tidcod = pacientes.tidcod
	left join fua_pages on fua_pages.fuable_id = citas.invnum and fua_pages.fuable_type='CE'
	left join consultorios on consultorios.codcon = citas.codcon
	left join servicios on servicios.sercod = consultorios.service_id
	-- order by invnum desc
	where 
	citas.invnum=$attention_id";
	$matriz = $conn_base->query($sql_cem);
	$fila=$matriz->fetch(PDO::FETCH_ASSOC);
	$mensaje="";
	$nreg=0;
	if($fila!==false){
		$nreg=count($fila);
	}
	if($nreg>0){
		$history = $fila["history"];
		$full_names = trim($fila["full_names"]);
		$document_number = trim($fila["document_number"]);
		$identification_type = trim($fila["identification_type"]);
		$age = $fila["age"];
		$preinvoice = $fila["preinvoice"];
		$origin = trim($fila["origin"]);
		$attention_id = $fila["attention_id"];
		$fua = $fila["fua"];
		$category = trim($fila["category"]);
		$service = trim($fila["service"]);
		/*
		echo "history =>".$fila['history']."<br>";
		echo "full_names =>".$fila['full_names']."<br>";
		echo "document_number =>".$fila['document_number']."<br>";
		echo "identification_type =>".$fila['identification_type']."<br>";
		echo "age =>".$fila['age']."<br>";
		echo "preinvoice =>".$fila['preinvoice']."<br>";
		echo "origin =>".$fila['origin']."<br>";
		echo "attention_id =>".$fila['attention_id']."<br>";
		echo "fua =>".$fila['fua']."<br>";
		echo "category =>".$fila['category']."<br>";
		echo "service =>".$fila['service']."<br>";
		echo "username =>".$fila['usuario']."<br>";
		*/
	        $sql1 = "use sihgea";
		$conn_base->query($sql1);
		$sql_pt="select top 1 * from patients where document_number='$document_number' and document_type_id='".$tipo_doc[$identification_type]."'";
		$matriz = $conn_base->query($sql_pt);
		$fila_pt=$matriz->fetch(PDO::FETCH_ASSOC);
		$nreg_pt=0;
		$id_pt="";
		//echo $sql_pt."<br>";

		if($fila_pt!==false){
			$nreg_pt=count($fila_pt);
		}
		if($nreg_pt>0){
			$id_pt=$fila_pt['id'];
		}else{
			//echo $sql_pt."<br>";
		}
		$sql_insert_er="insert into enrutador_ronald (usuario,id_pt,history,full_names,document_number,identification_type,age,preinvoice,origin,attention_id,fua,category,service,estado) values";
		$sql_insert_er.="('$username','$id_pt','$history','$full_names','$document_number','$identification_type','$age','$preinvoice','$origin','$attention_id','$fua','$category','$service','1')";
		//echo $sql_insert_er."<br>";
		$matriz = $conn_base->query($sql_insert_er);
		/*?history=<?php echo $history;?>&full_names=<?php echo $full_names; ?>&document_number=<?php echo $document_number;?>&identification_type=<?php echo $identification_type;?>&age=<?php echo $age;?>&preinvoice=<?php echo $preinvoice;?>&origin=<?php echo $origin;?>&attention_id=<?php echo $attention_id;?>&fua=<?php echo $fua;?>&category=<?php echo $category;?>&service=<?php echo $service;?>*/
	}
}elseif($origin=='HO'){
	$sql_ho="select 
	pacientes.pachis [history],
	pacientes.pacpmn [full_names],
	pacientes.pacdoc [document_number],
	tipo_documento_identidad.tiddes [identification_type],
	dbo.calcEdad(pacientes.pacfen,hospitalization.hosing) [age],
	hospitalization.prfnum [preinvoice],
	'HOSPITALIZACIÓN' [origin],
	hospitalization.invnum [attention_id],
	fua_pages.number [fua],
	categorias_pago.pardes [category],
	ho_rooms.[description] [service]
	from hospitalizacion [hospitalization]
	inner join prefacturas on prefacturas.prfnum = hospitalization.prfnum
	inner join categorias_pago on categorias_pago.parcod = prefacturas.parcod
	inner join pacientes on pacientes.pachis = hospitalization.pachis
	inner join tipo_documento_identidad on  tipo_documento_identidad.tidcod = pacientes.tidcod
	left join fua_pages on fua_pages.fuable_id = hospitalization.invnum and fua_pages.fuable_type='HO'
	inner join ho_movements on ho_movements.hospitalization_id = hospitalization.invnum  and ho_movements.id = (
	select top 1 id from ho_movements [move]
	where 
		move.hospitalization_id = hospitalization.invnum and
		movement_date <= GETDATE()
		order by movement_date desc
	)
	inner join ho_rooms on ho_rooms.id=ho_movements.room_id

	-- order by invnum desc
	where 
	hospitalization.invnum=$attention_id";
	$matriz = $conn_base->query($sql_ho);
	$fila=$matriz->fetch(PDO::FETCH_ASSOC);
	$mensaje="";
	$nreg=0;
	if($fila!==false){
		$nreg=count($fila);
	}
	if($nreg>0){
		$history = $fila["history"];
		$full_names = trim($fila["full_names"]);
		$document_number = trim($fila["document_number"]);
		$identification_type = trim($fila["identification_type"]);
		$age = $fila["age"];
		$preinvoice = $fila["preinvoice"];
		$origin = trim($fila["origin"]);
		$attention_id = $fila["attention_id"];
		$fua = $fila["fua"];
		$category = trim($fila["category"]);
		$service = trim($fila["service"]);
		/*
		echo "history =>".$fila['history']."<br>";
		echo "full_names =>".$fila['full_names']."<br>";
		echo "document_number =>".$fila['document_number']."<br>";
		echo "identification_type =>".$fila['identification_type']."<br>";
		echo "age =>".$fila['age']."<br>";
		echo "preinvoice =>".$fila['preinvoice']."<br>";
		echo "origin =>".$fila['origin']."<br>";
		echo "attention_id =>".$fila['attention_id']."<br>";
		echo "fua =>".$fila['fua']."<br>";
		echo "category =>".$fila['category']."<br>";
		echo "service =>".$fila['service']."<br>";
		echo "username =>".$fila['usuario']."<br>";
		*/
	        $sql1 = "use sihgea";
		$conn_base->query($sql1);
		$sql_pt="select top 1 * from patients where document_number='$document_number' and document_type_id='".$tipo_doc[$identification_type]."'";
		$matriz = $conn_base->query($sql_pt);
		$fila_pt=$matriz->fetch(PDO::FETCH_ASSOC);
		$nreg_pt=0;
		$id_pt="";
		//echo $sql_pt."<br>";

		if($fila_pt!==false){
			$nreg_pt=count($fila_pt);
		}
		if($nreg_pt>0){
		//var_dump($fila_pt);
			$id_pt=$fila_pt['id'];
		}else{
			//echo $sql_pt."<br>";
		}
		$sql_insert_er="insert into enrutador_ronald (usuario,id_pt,history,full_names,document_number,identification_type,age,preinvoice,origin,attention_id,fua,category,service,estado) values";
		$sql_insert_er.="('$username','$id_pt','$history','$full_names','$document_number','$identification_type','$age','$preinvoice','$origin','$attention_id','$fua','$category','$service','1')";
		//echo $sql_insert_er."<br>";
		$matriz = $conn_base->query($sql_insert_er);
		/*?history=<?php echo $history;?>&full_names=<?php echo $full_names; ?>&document_number=<?php echo $document_number;?>&identification_type=<?php echo $identification_type;?>&age=<?php echo $age;?>&preinvoice=<?php echo $preinvoice;?>&origin=<?php echo $origin;?>&attention_id=<?php echo $attention_id;?>&fua=<?php echo $fua;?>&category=<?php echo $category;?>&service=<?php echo $service;?>*/
	}
}
?>