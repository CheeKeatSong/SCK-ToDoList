<?php 

require '../Entities/ToDoEntity.php';

// class DisplayToDo{
//  	function GetToDoList(){
		require 'Credentials.php';

		$db = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8mb4',$user,$passwd);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		//$query = "SELECT *  FROM coffee WHERE type LIKE '$type'";
		$toDoArray = array();
		$toDoCounter = 1;

		$task = '';
		$status = '';

		try {
			foreach($db->query("SELECT * FROM todotable") as $row) {
				$task = $row[1];
				$status = $row[2];

				$toDo = new ToDoEntity($toDoCounter, $task, $status);
				$toDoCounter++;
				array_push($toDoArray, $toDo);
			}
		} catch(PDOException $ex) {
			echo "An Error occured!"; 
			echo $ex;
		}

		$db = null;
		echo json_encode($toDoArray);
// 			}
// }
?>
