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
<?php
	include_once("conexion_ronald.php");
	$sql0 = "use sihgea";
	$conn_base->query($sql0);
?>
<head>
	<title>username Notificado</title>
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<script language="javascript" type="text/javascript">
     </script>
</head>
<body>
<?php 
	if(isset($_REQUEST['xcount'])){
		$xcount=$_REQUEST['xcount'];
	}else{
		$xcount=0;
	}

	if(isset($_REQUEST['username'])){
		$username=$_REQUEST['username'];
	}else{
		$username="";
	}

	if(isset($_REQUEST['mensaje'])){
		$mensaje=$_REQUEST['mensaje'];
	}else{
		$mensaje="";
	}

	if(isset($_REQUEST['id_loco'])){
		$id_loco=$_REQUEST['id_loco'];
	}else{
		$id_loco="";
	}

	if(isset($_REQUEST['aceptar'])){
		$estado=0;
		$sql_up="update loco_ronald set estado='$estado' where id_loco=$id_loco";
		//$sql_up2="update loco_ronald set estado='?' where id_loco=?";
		//echo $sql_up2."<br>";
		//$matriz=$conn_base->prepare($sql_up2);
		$fila=$conn_base->query($sql_up);
		if ($fila!==true) {
			echo "error actualizando datos de $username correspondiente a id_loco=$id_loco";
		}?>
		<script>
			self.close();
			top.close();
			window.opener.location.reload(true);
		</script><?php
	}
?>
<form name=probeta >
<?php
echo "llamado por ".$username." mensaje =>".$mensaje." id_loco => ".$id_loco;
?>
<table align=center cellpadding=10>
	<tr><td>
	<input type="submit" name="aceptar" value="Procesar">
	<input type="button" name="baceptar" value="Retornar" onclick="javascript:self.close();window.opener.location.reload(true);counter = setInterval(timer,500);">
	<input type="text" name="xcount" value="<?php echo $xcount;?>">
	<input type="text" name="id_loco" value="<?php echo $id_loco;?>">
	</td></tr>
</table>
</form>
</body>
</html>