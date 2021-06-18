<?php
$mysqli = mysqli_connect("localhost", "root", "","rtemployee");
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
				
				1. Employee's Full Name :<br>
				<input type="text" id = "full_name" name="full_name" placeholder = "Enter Full Name" >
				<br><br>
				2. Contact Number :<br>
				<input type="text" id = "contact" name="contact" placeholder = "Enter the contact no" >
				<br><br>
				3. Email-Id :<br>
				<input type="text" id = "email" name="email" placeholder = "Enter the email-id" >
				<br><br>
				4. Employee Id :<br>
				<input type="text" id = "emp_id" name="emp_id" placeholder = "Enter the Employee Id" >
				<br><br>
				5. Address of the Employee :<br>
				<input type="text" id = "addresses" name="addresses" placeholder = "Enter the address" >
				<br><br>
				<input type="submit" name = "submit" value="Submit" id = "submit">
			</div>
		</form>
		<?php
			if(isset($_POST['submit']))
			{
				//$db_sno = $_REQUEST['sno'];
				$db_full_name = $_REQUEST['full_name'];
				$db_contact = $_REQUEST['contact'];
				$db_email = $_REQUEST['email'];
				$db_emp_id = $_REQUEST['emp_id'];
				$db_addresses = $_REQUEST['addresses'];
				
				$id_q = "SELECT COUNT(*) FROM emp";
				$result = mysqli_query($mysqli, $id_q);
				$row = mysqli_fetch_array($result);
				//echo $row['COUNT(*)'];
				$id = $row['COUNT(*)'];
				$db_sno = $id + 1;
				
				if($db_full_name!= "" && $db_contact!= "" && $db_email!= "" && $db_emp_id!= "" && $db_addresses!= "")
				{
					$sql="SELECT contact FROM emp WHERE contact=$db_contact";
					$result=mysqli_query($mysqli, $sql);
					if($result -> num_rows > 0)
					{
						echo "<h3> <font color=red> Your contact is already in our database, try with another number </font></h3>";
					}
					else
					{
						$query = "INSERT INTO emp VALUES ('$db_sno', '$db_full_name', '$db_contact', '$db_email', '$db_emp_id', '$db_addresses')";
						$data = mysqli_query($mysqli, $query);
						
						if($data)
						{
							echo "<h3> <font color=blue> Data inserted into Database </font></h3>";
						}
					}
				}
				else
				{
					echo "<h3> <font color=red> All fields are required  ";
				}	
			}
		?>	
</body>
</html>
