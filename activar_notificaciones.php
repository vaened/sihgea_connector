<html>
<head>
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>
<body>
<?php
	include("conexion_ronald.php");
	if(isset($_REQUEST['usuario'])){
		$usuario=$_REQUEST['usuario'];
	}else{
		$usuario="";
	}
	echo "Usuario $usuario activado ...<br>";
	if(isset($_REQUEST['aceptar'])){
		$estado=0;
		$sql="update loco_ronald set estado='?' where usuario='?'";
		$matriz=$conn_base->prepare($sql);
		$fila=$matriz->execute([$estado,$usuario]);
		if($fila!==true){
			$mensaje="error activando mensaje";
		}
	}?>

	<form name=actinoti>
	<table align=center cellpadding=10>
		<tr><td>
		<input type="text" name="usuario" value="<?php echo $usuario;?>">
		</td></tr>
		<tr><td>
		<input type="submit" name="aceptar" value="activar">
		</td></tr>
	</table>
	</form>

</body>
</html>
