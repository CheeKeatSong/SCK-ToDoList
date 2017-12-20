<?php 

class ToDoEntity{
	public $id;
	public $task;
	public $status;

	/**
	 * Class Constructor
	 * @param    $id   
	 * @param    $task   
	 * @param    $status   
	 */
	public function __construct($id, $task, $status)
	{
		$this->id = $id;
		$this->task = $task;
		$this->status = $status;
	}

}
?>
