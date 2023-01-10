<html>
<?php
/****
session_start();
if(!isset($_session["tu_token"])){
	header("location: tu_login.php");
}
if(!isset($_cookie["tu_token"])){
	header("location: tu_login.php");
}
if($_session["tu_token"]!=$_cookie["tu_token"]){
	header("location: tu_login.php");
}****/
?>
<head>
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>
<body>
	<?php
	include_once("conexion_ronald.php");
	$sql0 = "use sihgea";
	$conn_base->query($sql0);
	if (isset($_REQUEST['username'])) {
		$username = $_REQUEST['username'];
	} else {
		$username = "";
	}
	$estado = 1;
	$sql = "sql de origen de datos para exportarlos a la tabla control, control bajo un Id.";
	// procedimiento para insertar datos en tabla control
	$sql2 = "select top 1 * from enrutador_ronald where usuario='$username' and estado='$estado' order by id_loco";
		
	$matriz = $conn_base->query($sql2);
	//$xxmatriz = $matriz->fetchAll(PDO::FETCH_OBJ);	// para un resultado con varias filas
	$fila=$matriz->fetch(PDO::FETCH_ASSOC);
	
	//var_dump($fila);

	$mensaje="";
	$nreg=0;
	//$nreg=count($xxmatriz);	//usando resultado con varias filas
	if($fila!==false){
		$nreg=count($fila);
	}
	if($nreg>0){
		//foreach ($xxmatriz as $fila) {	//para resultado con varias filas ...
			$mensaje = $fila["mensaje"];
			$id_loco = $fila["id_loco"];
			$history = $fila["history"];
			$full_names = $fila["full_names"];
			$document_number = $fila["document_number"];
			$identification_type = $fila["identification_type"];
			$age = $fila["age"];
			$preinvoice = $fila["preinvoice"];
			$origin = $fila["origin"];
			$attention_id = $fila["attention_id"];
			$fua = $fila["fua"];
			$category = $fila["category"];
			$service = $fila["service"];
			$id_pt = $fila["id_pt"];
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
			echo "id_pt =>".$fila['id_pt']."<br>";
			
			//break;
		//}
	}

	if (isset($_REQUEST['xcount'])) {
		$xcount = $_REQUEST['xcount'];
	} else {
		$xcount = 1;
	}

	if (isset($_REQUEST['aceptar'])) { ?>
		<script type="text/javascript">
			self.close();
			top.close();
			counter = setInterval(timer, 1000);
		</script><?php }

		if ($nreg > 0) { ?>
			<script type="text/javascript">
				//window.open("notificaciones2.php?username=<?php echo $username; ?>&mensaje=<?php echo $mensaje; ?>&id_loco=<?php echo $id_loco;?>&xcount=<?php echo $xcount;?>","ventana1","width=480,height=360,left=200,top=100,scrollbars=YES");
				miw=window.open("http://192.168.10.80:8081/admin/orders/create#?username=<?php echo $username; ?>&mensaje=<?php echo $mensaje; ?>&id_loco=<?php echo $id_loco;?>&history=<?php echo $history;?>&full_names=<?php echo $full_names; ?>&document_number=<?php echo $document_number;?>&identification_type=<?php echo $identification_type;?>&age=<?php echo $age;?>&preinvoice=<?php echo $preinvoice;?>&origin=<?php echo $origin;?>&attention_id=<?php echo $attention_id;?>&fua=<?php echo $fua;?>&category=<?php echo $category;?>&service=<?php echo $service;?>&id_pt=<?php echo $id_pt;?>","ventana1","width=1280,height=840,left=250,top=50,scrollbars=YES");
				miw.moveTo(-1500, 100);
				
			</script>
		<form name=probeta action="#">
			<table align=center cellpadding=10>
				<tr>
					<td>
						<input type="hidden" name="aceptar" value="sRetornar">
						<input type="hidden" name="username" value="<?php echo $username; ?>">
						<input type="hidden" name="count" value="<?php echo $count; ?>">
					</td>
				</tr>
			</table>
		</form>
			

	<?php
		}
		if ($nreg <= 0) { ?>
		<script type="text/javascript">
			self.close();
			top.close();
			counter = setInterval(timer,1000);
		</script><?php
		}?>
</body>
</html>