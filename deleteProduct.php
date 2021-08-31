<?php 
session_start();

if(empty($_SESSION['userId']))
	header('Location: index.html');

require __DIR__.'/classes/Database.php';
require __DIR__.'/classes/JwtHandler.php';

$db_connection	= new Database();
$conn 			= $db_connection->dbConnection();

$delete_query	=	"DELETE FROM products WHERE productId = '".$_GET['pId']."'";

$delete_stmt 	= $conn->prepare($delete_query);

	if($delete_stmt->execute())	{
		echo '<script>alert("Success");
					  window.location = "dashboard.php";
			</script>';
	}
?>