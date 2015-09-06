<?php
include 'header.php'
?>
<?php
if(isset($_POST["submit"])){
	$player = addslashes($_POST["SelectPlayer"]);
	$itemName = addslashes($_POST["ItemName"]);
	$description = addslashes($_POST["description"]);
	$insert = "INSERT INTO item(item_name,players_id,description)VALUES('$itemName',$player,'$description');";
	if ($con->query($insert) === TRUE) {
		echo "<br/>New record created successfully";
	} else {
		echo "<br/>Error: " . $insert . "<br>" . $con->error;
	}
}
?>
<form class="form-horizontal" method="POST">
	<fieldset>
		<!-- Form Name -->
		<legend>Item Form</legend>
		<!-- Select Basic -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="Select Player">Select Basic</label>
			<div class="col-md-4">
				<select id="SelectPlayer" name="SelectPlayer" class="form-control" required>
					<option value="">Select User...</option>
				</select>
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="ItemName">ItemName</label>  
			<div class="col-md-4">
				<input id="ItemName" name="ItemName" type="text" placeholder="Item Name" class="form-control input-md" required>
				
			</div>
		</div>
		<!-- Textarea -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="">Description</label>
			<div class="col-md-4">                     
				<textarea class="form-control" id="description" name="description"></textarea>
			</div>
		</div>
		<!-- Button -->
		<div class="form-group">
			<div class="col-md-4">
				<button id="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</fieldset>
</form>
<script>
$( document ).ready(function() {
	$.post( "playerFill.php", function( data ) {
		var results = $.parseJSON(data);
		
		for(var i =0; i< results.length; i++){
			
			fillUserList(results[i].player_name,results[i].id, "SelectPlayer");
		}
	});
	function fillUserList(text,value, selectID){
		var x = document.getElementById(selectID);
		var option = document.createElement("option");
		option.text = text;
		option.value= value;
		x.add(option);
	}
});
</script>
<?php
mysqli_close($con);
?>
