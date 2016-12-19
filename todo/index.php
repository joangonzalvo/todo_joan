<?php
session_start();

$dbhost='localhost';
$dbname='todo';
$dbuser='root';
$dbpassw='linuxlinux';

$email='ab';
$passwd='bc';

if($_POST)
{
if(!empty($_POST)){
		
		$email=htmlspecialchars($_POST['email']);
		$passwd=htmlspecialchars($_POST['passwd']);
		$flag=0;
		
		}

//obtenim variable de conexió

$db=new mysqli($dbhost,$dbuser,$dbpassw,$dbname);
if($db->connect_errno){
	die('Error de connexió');
}
else
{

$sql="SELECT email, passwd from users";
$result = $db->query($sql);
if($result -> num_rows > 0){
	while($row = $result->fetch_assoc()){
		if($email == $row["email"] && $passwd == $row["passwd"])
		{
			setcookie("email", $email, time()+2500, "/todo","", 0);
			setcookie("passwd", $passwd, time()+2500, "/todo","", 0);
			header("Location: list.php");
			
		}
		else
		{
			$flag =$flag+1;
			if($flag == 1)
			{
			echo('Usuari no existeix o la pass es erronea');
			}
		}
		

	}
}
}

$db->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TODO App - Joan</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<header><h1>TODO App</h1>
</header>
<div class="index">
	<form method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
		<p>
			E-MAIL: <input type="text" name="email"><br>
			PASSW: <input type="text" name="passwd">
		</p>
		<p><input type="submit" value="Log-in"></p>
	</form>
</div>
</body>
</html>

