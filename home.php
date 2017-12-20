<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./Style/home.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>Bootstrap</title>
</head>
<body>

	<div id="header" class="modal-header">
		<div class="container-fluid">
			<h3>My To Do List</h2>
				<div class="col-xs-10 col-md-11">
					<input type="text" class="form-control" id="myInput" placeHolder="What To Do...?">
				</div>
				<div class="col-xs-2 col-md-1">
				 <div class="btn-group" role="group">
					<button onclick="addNewTask()" class="btn btn-default btn-block">Add</button>
				</div>
			</div>
			</div>
		</div> 

		<div id="listGroupContainer" class="container-fluid">
			<ul id="myListGroup" class="list-group"><!-- 
				<li class="list-group-item">First Item</li>
				<li class="list-group-item">Second Item</li> -->
			</ul>
		</div>

	<!-- 	<?php 
		// require 'Model/DisplayToDo.php';

		// $DisplayToDo = new DisplayToDo();
		// $toDoArray = $DisplayToDo->GetToDoList();

// $result = "";

// foreach ($toDoArray as $key => $toDo) {
// 	$result = $result .
// 	"<div id='listGroupContainer class='container-fluid'>
// 		<ul id='myListGroup' class='list-group'>
// 			<li class='list-group-item'>$toDo->task</li>
// 		</ul>
// 	</div>";
// }

// return $result;
				
// var toDoArray = <?php echo json_encode($toDoArray); ?>;
?> -->

<script>

	var itemListCounter = 0;

	function addCheckFunction(obj){

		var itemID = obj.getAttribute('id');
		document.getElementById(itemID).classList.toggle('checked');	

		// listGroup = document.getElementById("myListGroup");
		// listGroup.addEventListener('click', function(listGroupItem){
		// 	if(listGroupItem.target.tagName = 'LI'){
		// 		listGroupItem.target.classList.toggle('checked');
		// 	}
		// }, false);

var str = $(obj).text();
var newStr = str.substring(0, str.length-1);

$.ajax({
	type: "POST",
	url: "Model/UpdateToDo.php",
	data: {data : newStr}, 
	cache: false,

	success: function(){
	},
	error: function(){
		console.log("ajax error");
	}

});

}

function appendCloseButton(){
	var span = document.createElement("SPAN");
	var txt = document.createTextNode("x");
	span.className = "close";
	span.appendChild(txt);
	return span;
}

function addDeleteFunction(){
	var close = document.getElementsByClassName("close");
	var i;
	for (i = 0; i < close.length; i++){
		close[i].onclick = function(){
			var div = this.parentElement;
			div.style.display = "none";

			var str = $(div).text();
			var newStr = str.substring(0, str.length-1);

			$.ajax({
				type: "POST",
				url: "Model/DeleteToDo.php",
				data: {data : newStr}, 
				cache: false,

				success: function(e){
					console.log(e);
					alert("Deleted from MySQL database.");
				},
				error: function(){
					console.log("ajax error");
				}

			});
		}
	}
}

function createToDoList(toDoArray){

	for (var i = 0, l = toDoArray.length; i < l; i++){
		var toDo = toDoArray[i];

		$('#myListGroup').append('<li id="item' + i +'" class="list-group-item" onClick="addCheckFunction(this)">' + toDo.task + '</li>');
		itemListCounter++;
	}

	var myNodeList = document.getElementsByTagName("LI");
	var i;
	for (i = 0; i < myNodeList.length; i++){
		var span = appendCloseButton();
		myNodeList[i].appendChild(span);
	}
	addDeleteFunction();

	for(var i = 0, l = toDoArray.length; i < l; i++){
		if (toDoArray[i].status == true){
			document.getElementById('item'+ i).classList.toggle('checked');	
		}
	}
}

function addNewTask(){
	var li = document.createElement("li");
	li.className="list-group-item";
	var inputValue = document.getElementById("myInput").value;
	var t = document.createTextNode(inputValue);
	$(li).on('click', function () {
		addCheckFunction(this);
	});
	li.appendChild(t);
	li.id="item"+itemListCounter+"";
	if (inputValue === ''){
		alert("You must write something!");
	}else{
		document.getElementById("myListGroup").appendChild(li);
		itemListCounter++;

		$.ajax({
			type: "POST",
			url: "Model/AddToDo.php",
			data: {data : inputValue}, 
			cache: false,

			success: function(e){
				console.log(e);
				alert("Added to MySQL database.");
			},
			error: function(){
				console.log("ajax error");
			}

		});
	}
	document.getElementById("myInput").value = "";

	var span = appendCloseButton();
	li.appendChild(span);

	addDeleteFunction();


}

			// function retrieveTodoList(){
				$.ajax({  
					type: "GET",
					url: "Model/DisplayToDo.php",             
					dataType: "json",              
					success: function(toDoArray){       
						createToDoList(toDoArray);
					},
					error: function(){
						console.log("ajax error");
					}

				});
			// } 

			// retrieveTodoList();

		</script>

	</body>
	</html>

