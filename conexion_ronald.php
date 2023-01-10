<?php
$serverName = "191.98.140.81\sqlexpress, 1433"; //serverName\instanceName, portNumber (por defecto es 1433)
try {
	$conn_base = new PDO("sqlsrv:server=$serverName;database=sihgea", 'test', '654321');
	$conn_base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "conexion exitosa";
}catch (Exception $e) {
	echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
?>

