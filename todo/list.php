<?php
session_start();

$dbhost='localhost';
$dbname='todo';
$dbuser='root';
$dbpassw='linuxlinux';

$db=new mysqli($dbhost,$dbuser,$dbpassw,$dbname);
if($db->connect_errno){
	die('Error de connexió');
}
else
{

if(isset($_COOKIE['email']))
{
	$email = $_COOKIE['email'];
	unset($_COOKIE['email']);//eliminem la cookie perque ya hem guardat el valor que voliem, i evitem posibles errors al conectar amb un altre usuari.
}
if(isset($_COOKIE['passwd']))
{
	$passwd = $_COOKIE['passwd'];
	unset($_COOKIE['passwd']);//eliminem la cookie perque ya hem guardat el valor que voliem, i evitem posibles errors al conectar amb un altre usuari.
}
$sql="SELECT id, email from users";//seleccionem id d'usuari y email
{
$result = $db->query($sql);
if($result -> num_rows > 0){
	while($row = $result->fetch_assoc()){
		if($email == $row["email"])
		{
			$id = $row['id'];//guardem id perque es el camp que conecta amb l'altra taula			
		}
}
	
}
}
$pos=0;
$sql="SELECT descripcio, user, data, completed from tasks";
//seleccionem els camps que necesitem per la llista
$result = $db->query($sql);
if($result -> num_rows > 0){
	while($row = $result->fetch_assoc())
	{
		
		if($id == $row["user"])
		{
			//guardem els camps en variables d'array:
			$descripcio[$pos] = $row["descripcio"];
			$data[$pos] = $row["data"];
			//com true or false esta en 0 o 1, posem dintre de la variable que es cada cosa per no imprimir numeros:
			if($row["completed"] == 1)
			{
			$completed[$pos] = "Si";
			}
			else
			{
			$completed[$pos] = "No";
			}
			
			$pos=$pos+1;
			//suma per recorrer les tasques que tenim en la base de dades
		}
		
	}
		

	}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Taskzone</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<h1>Tasks for <?= $email?></h1>
	<table>

		<tr>
			<td>Descripcio</td>
			<td>Data</td>
			<td>Complet?</td>
		</tr>
		
			<?php
			for($i=0;$i<$pos;$i++) {
				//posem dintre de variables normals els valors dels arrays (es podría fer directament imprimint desde els arrays)
				$des=$descripcio[$i];
				$dat=$data[$i];
				$comp=$completed[$i];
				//creacio de la taula amb els valors:
				echo"<tr>";
				echo"<td>----- ".$des." ---</td>";
				echo"<td>--- ".$dat." ---</td>";
				echo"<td>--- ".$comp." -----</td>";
				echo"</tr>";
			}
			?>

	</table>


</body>
</html>