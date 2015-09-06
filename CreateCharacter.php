<?php
include 'header.php'
?>
<?php 
if ( isset($_GET['submit'])) {
	$name = addslashes($_GET['Name']);
	$HP = addslashes($_GET["max_hp"]);
	$Armor = addslashes($_GET["Armor"]);
	$Strength = addslashes($_GET["Strength"]);
	$dexterity = addslashes($_GET["dexterity"]);
	$constitution = addslashes($_GET["constitution"]);
	$wisdom = addslashes($_GET["wisdom"]);
	$charisma = addslashes($_GET["charisma"]);
	$intelligence = addslashes($_GET["intelligence"]);
	$insert = "INSERT INTO players (player_name, max_hp, Armor_Class, strength, dexterity, constitution, intelect, wisdom,charisma) VALUES ('$name', $HP, $Armor, $Strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma);";
	if ($con->query($insert) === TRUE) {
		echo "<br/>New record created successfully";
	} else {
		echo "<br/>Error: " . $insert . "<br>" . $con->error;
	}
}
?>
<form class="form-horizontal">
	<fieldset>
		<!-- Form Name -->
		<legend>Character Name</legend>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="Name">Name</label>  
			<div class="col-md-4">
				<input id="Name" name="Name" type="text" placeholder="Name" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="HP">HP</label>  
			<div class="col-md-4">
				<input id="max_hp" name="max_hp" type="number" placeholder="HP" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="Armor">AC</label>  
			<div class="col-md-4">
				<input id="Armor" name="Armor" type="number" placeholder="AC" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="Strength">Strength</label>  
			<div class="col-md-4">
				<input id="Strength" name="Strength" type="number" placeholder="Strength" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="dexterity">dexterity</label>  
			<div class="col-md-4">
				<input id="dexterity" name="dexterity" type="number" placeholder="dexterity" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="constitution">constitution</label>  
			<div class="col-md-4">
				<input id="constitution" name="constitution" type="number" placeholder="constitution" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="intelligence">intelligence</label>  
			<div class="col-md-4">
				<input id="intelligence" name="intelligence" type="number" placeholder="intelligence" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="wisdom">wisdom</label>  
			<div class="col-md-4">
				<input id="wisdom" name="wisdom" type="number" placeholder="wisdom" class="form-control input-md">
				
			</div>
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="charisma">charisma</label>  
			<div class="col-md-4">
				<input id="charisma" name="charisma" type="number" placeholder="charisma" class="form-control input-md">
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label" for=""></label>  
			<div class="col-md-4">
				<button id="submit" name="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</fieldset>
</form>
</body>
<script>
</script>
<?php
mysqli_close($con);
?>
</html