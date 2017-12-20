<?php 
//include the database login process(shorten the code)

require '../Entities/ToDoEntity.php';
require 'Credentials.php';

$db = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8mb4',$user,$passwd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$data = $_POST['data'];

try {
	$affected_rows = $db->exec("INSERT INTO todotable(id, task, status) VALUES(DEFAULT, '".$data."', false)");
	echo $affected_rows.' were affected';
} catch(PDOException $ex) {
	echo "An Error occured!"; 
	echo $ex;
}

$db = null;

?>