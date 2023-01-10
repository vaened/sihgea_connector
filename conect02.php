<?php
phpinfo();
//echo "holas";
// conexion a servidor ronald
$serverName = "191.98.140.81\sqlexpress, 1433"; //serverName\instanceName, portNumber (por defecto es 1433)
//$serverName = "191.98.140.81, 1433"; //serverName\instanceName, portNumber (por defecto es 1433)
/*$connectionInfo = array( "Database"=>"sihgea", "UID"=>"test", "PWD"=>"654321");
echo "holas 2";
$conn = pdo_sqlsrv( $serverName, $connectionInfo);
if($conn) {
     echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
*/


try {
    $base_de_datos = new PDO("sqlsrv:server=$serverName;database=sihgea", 'test', '654321');
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'holaaaaaaaaa......conexion exitosa ..............';
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}
?>
