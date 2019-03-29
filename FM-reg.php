<head>
<title>FM Index</title>
</head>
<body style="font-family:sans-serif;">

<?php
include "FM-Connect.php";
$dbsrv_descriptor = DBInit($dbadres, $dbuser, $dbpass);
$sdres=DBConn($dbname,$dbsrv_descriptor);
	
	if (isset($_POST['usrname'])){
		
		if ($_POST['reg']==1){
		$uregres=mysqli_query($dbsrv_descriptor,"INSERT INTO fmusers SET uname='".$_POST['usrname']."', upasswd='".$_POST['usrpswd']."';");
		if ($uregres){
			echo "<div align='center'>Вы <b>успешно зарегистрировались</b> в системе!</div>";
		} else {
		echo mysql_error();
		}
		} else {
			
			$usdbrs=mysqli_query($dbsrv_descriptor,"SELECT * FROM fmusers WHERE uname='".$_POST['usrname']."' AND upasswd='".$_POST['usrpswd']."';");
			if ($usdbrs){
				if (mysqli_num_rows($usdbrs)>0){
					while($fmrows=mysqli_fetch_array($usdbrs)){
						$uname = $fmrows['uname'];
					}
					echo "<div align='center'><b>".$uname."</b>, успешно вошли в систему!</div>";
					session_start();
					$_SESSION['ulog']=true;
				} else { 
					echo "<div align='center'>Вы НЕ зарегистрированны<br> или ввели неверный пароль!</div>";
				}			
			} 
		}
		
	} else {
?>

<form method="post" action="FM-reg.php" name="regform">
<table>
<tr>
	<td colspan="2" align="center"> <label id="lab" style='font-weifght:bold;'>Регистрация</label><br> </td>
</tr><tr>
	<td>Логин (<15 симв.):</td>
	<td><input type="text" size="15" name="usrname"><br></td>
</tr><tr>	
	<td>Пароль (< 25 симв.):</td>
	<td><input type="password" size="25" name="usrpswd"><br></td>
</tr><tr>
	<td colspan="2"><br> 
		<input type="hidden" name="reg" value="1">
		<div align="center"><input type="submit" name="btnsb" value="Register"></div> 
	</td>
</tr></table>
	
</form>
<?php
}

if (isset($_GET['regv'])){
echo "<script type='text/javascript'>
document.forms['regform'].elements['reg'].value=0;
document.forms['regform'].elements['btnsb'].value='Enter';
document.getElementById('lab').innerHTML='Вход';
</script>";
}

?>

</body>
