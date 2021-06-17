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
	<title>Insert Data into Database</title>
	
</head>

<body >

		<form action = "" method = "POST">
			<div id = "time" >
				<h2 style="color:MediumSeaGreen" >Please fill the details of new Entry</h2><br>
				1. Serial no :<br>
				<input type="text" id = "sno" name="sno" placeholder = "Enter the serial no" >
				<br><br>
				2. Employee's Full Name :<br>
				<input type="text" id = "full_name" name="full_name" placeholder = "Enter Full Name" >
				<br><br>
				3. Contact Number :<br>
				<input type="text" id = "contact" name="contact" placeholder = "Enter the contact no" >
				<br><br>
				4. Email-Id :<br>
				<input type="text" id = "email" name="email" placeholder = "Enter the email-id" >
				<br><br>
				5. Employee Id :<br>
				<input type="text" id = "emp_id" name="emp_id" placeholder = "Enter the Employee Id" >
				<br><br>
				6. Address of the Employee :<br>
				<input type="text" id = "addresses" name="addresses" placeholder = "Enter the address" >
				<br><br>
				<input type="submit" name = "submit" value="Submit" id = "submit">
			</div>
		</form>
		<?php
			if(isset($_POST['submit']))
			{
				$db_sno = $_REQUEST['sno'];
				$db_full_name = $_REQUEST['full_name'];
				$db_contact = $_REQUEST['contact'];
				$db_email = $_REQUEST['email'];
				$db_emp_id = $_REQUEST['emp_id'];
				$db_addresses = $_REQUEST['addresses'];
				
				if($db_sno!= "" && $db_sno!= "" && $db_full_name!= "" && $db_email!= "" && $db_emp_id!= "" && $db_addresses!= "")
				{
					$query = "INSERT INTO emp VALUES ('$db_sno', '$db_full_name', '$db_contact', '$db_email', '$db_emp_id', '$db_addresses')";
					$data = mysqli_query($mysqli, $query);
					
					if($data)
					{
						echo "<h3> <font color=blue> Data inserted into Database </font></h3>";
					}
				}
				else
				{
					echo "<h3> <font color=red> All fields are required </font></h3>";
				}
				
			}
		?>
	
	
</body>

</html>
