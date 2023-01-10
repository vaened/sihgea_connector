<html>
<?php
/****/
session_start();
/****/

//var_dump($HTTP_COOKIE_VARS);
//var_dump($GLOBALS);
//var_dump($_COOKIE);
/*****
if(isset($_REQUEST['token'])){
	echo "no hay session token";
	echo "<br>";
	$token=$_REQUEST['token'];
	//header("location: http://192.168.10.80:8081/login");
}

if(!isset($_COOKIE['PHPSESSID'])){
	echo "no hay cookie token";
	echo "<br>";
	//header("location: http://192.168.10.80:8081/login");
}else{
	echo $_COOKIE['PHPSESSID'];
}

if($_REQUEST['token']!=$_COOKIE['token']){
	header("location: http://192.168.10.80:8081/admin/orders/create");
}
*/
?>
<?php
include("conexion_ronald.php");
if(isset($_REQUEST['username'])){
	$username=str_replace(" ","_",$_REQUEST['username']);
}else{
$username="";
}
$username=trim($username);
/*
if(isset($_REQUEST['password'])){
	$password=$_REQUEST['password'];
}else{
$password="";
}
$password=trim($password);
*/
/*
if(isset($_REQUEST['username'])){
		$username=str_replace(" ","_",$_REQUEST['username']);
}else{
	$username="";
}
$username=trim($username);
*/
?>
	<head>
	<title>Enrutador</title>
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<script type="text/javascript" src="jquery-1.2.3.min.js"></script>
	</head>
	<body>
	<form name=user>
		<div class="bigBox">
			<div>username</div>
				<div><input type=text name=username id=username value="<?php echo $username;?>"></div>
				<button onclick="timer();" id="xxtimer" type="button" name="button">Aceptar</button>
				<input type="hidden" name="token" id="token" value="<?php echo $token;?>">
				<div id="result"></div>
				<div id="zz"></div>
			</div>
		</div>	
	</form>
	<script>
		let count = 0;
		let counter = setInterval(timer, 1000)
		<?php if($username==""){?>
			clearInterval(counter);
		<?php }?>

		function timer(){
			var user='<?php echo $username;?>';
			user=user.trim();
			count++;
			result.innerHTML = count;
			if(user!=""){
				clearInterval(counter);
				$("#zz").load("notificaciones.php?username="+user+"&xcount="+count);
			}
			if(count>10){
				document.user.submit(); 
			}

		}
	</script>
	
	</body>
</html>