<?php 
require '../Entities/ToDoEntity.php';
require 'Credentials.php';

$db = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8mb4',$user,$passwd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$data = $_POST['data'];
$status;
$newStatus;

try {

	foreach($db->query("SELECT * FROM todotable WHERE task='".$data."'") as $row) {
				$status = $row[2];
			}

			if ($status==true){$newStatus=false;}
			else{$newStatus=true;}

	$affected_rows = $db->exec("UPDATE todotable SET status='".$newStatus."' WHERE task='".$data."' ");
echo $affected_rows.' were affected';

} catch(PDOException $ex) {
}

$db = null;

?>