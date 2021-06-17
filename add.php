<?php
$mysqli = new mysqli("localhost", "root", "","rtemployee");
// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .$mysqli->connect_errno . ') '.$mysqli->connect_error);
}
?>
 
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Appointment Details</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
		table {
			margin: 0 auto;
			font-size: large;
			border: 1px solid black;
		}

		h1 {
			text-align: center;
			color: #006600;
			font-size: xx-large;
			font-family: 'Gill Sans', 'Gill Sans MT',
			' Calibri', 'Trebuchet MS', 'sans-serif';
		}

		td {
			background-color: #E4F5D4;
			border: 1px solid black;
		}

		th,
		td {
			font-weight: bold;
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
	</style>
</head>

<body >

		<form action = "" method = "POST">
			<div id = "time" align = "center">
				<h2 style="color:MediumSeaGreen" >Choose a Time-slot:</h2><br>

				<select name="time" id="time">
				  <option value="morning">Morning</option>
				  <option value="afternoon">Afternoon</option>
				  <option value="evening">Evening</option>
				</select>
				<br><br>
				<input type="submit" name = "submit" value="Submit" id = "submit">
			</div>
		</form>
		<?php
			if(isset($_POST['submit']))
			{
				$db_time = $_REQUEST['time'];
				if ($db_time == 'morning')
					$sql = "SELECT * FROM morning";
				elseif ($db_time == 'afternoon')
					$sql = "SELECT * FROM afternoon";
				elseif ($db_time == 'evening')
					$sql = "SELECT * FROM evening";
				
				$result = $mysqli->query($sql);
				$mysqli->close();
		?>
	<section>
		<h1><?php echo ucfirst($db_time) ?> Database</h1>
		<!-- TABLE CONSTRUCTION-->
		<table>
			<tr>
				<th>SN</th>
				<th>Full Name</th>
				<th>Contact</th>
				<th>Date</th>
				<th>Time</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS-->
			<?php // LOOP TILL END OF DATA
				while(($rows = $result->fetch_assoc()) !== null)
				{
			?>
			<tr>
				<!--FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN-->
				<td><?php echo $rows['sno'];?></td>
				<td><?php echo $rows['full_name'];?></td>
				<td><?php echo $rows['contact'];?></td>
				<td><?php echo $rows['dated'];?></td>
				<td><?php echo $rows['timer'];?></td>
			</tr>
			<?php
			 }
			?>
		</table>
	</section>
			<?php } ?>
</body>

</html>
