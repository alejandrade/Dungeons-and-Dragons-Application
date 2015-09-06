<?php
include 'header.php'
?>
<form class="form-horizontal" method="POST">
	<fieldset>
		<!-- Form Name -->
		<legend>Note</legend>
		<?php
		if(isset($_POST["submit"])){
			$newNode = addslashes($_POST["notesSubmit"]);
			$insert = "insert into Notes (notes)values('$newNode')";
			if ($con->query($insert) === TRUE) {
				echo "<br/>New record created successfully";
			} else {
				echo "<br/>Error: " . $insert . "<br>" . $con->error;
			}
		}
		if ($result = mysqli_query($con,"SELECT * FROM Notes")) {
			while ($row = mysqli_fetch_assoc($result)) {
				$notes = $row["notes"];
				$date = $row["Date_Created"];
				echo "<div class='form-group'>";
				echo "<label class='col-md-4 control-label' for=''>$date</label>";
				echo "<div class='col-md-4'>";                     
				echo "<textarea readonly class='form-control' id='' name=''>$notes</textarea>";
				echo "</div>";
				echo "</div>";
			}
		}
		?>
		<hr>
		<!-- Textarea -->
		<div class="form-group">
			<label class="col-md-4 control-label" for="">New Notes</label>
			<div class="col-md-4">                     
				<textarea class="form-control" id="notesSubmit" name="notesSubmit"></textarea>
			</div>
		</div>
		<!-- Button -->
		<div class="form-group">
			<label class="col-md-4 control-label" for=""></label>
			<div class="col-md-4">
				<button id="submit" name="submit" class="btn btn-primary">submit</button>
			</div>
		</div>
	</fieldset>
</form>
<?php
mysqli_close($con);
?>
