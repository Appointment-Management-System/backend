<?php  
session_start();
if($_SESSION['status']==FALSE)
{
	header('location:loginpage.html');
}

$connect = mysqli_connect("localhost", "root", "", "rtemployee");
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
	$id_q = "SELECT COUNT(*) FROM emp";
				$result = mysqli_query($connect, $id_q);
				$row = mysqli_fetch_array($result);
				//echo $row['COUNT(*)'];
				$id = $row['COUNT(*)'];
				$db_sno = $id + 1;
				
    $item1 = mysqli_real_escape_string($connect, $data[0]);  
                $item2 = mysqli_real_escape_string($connect, $data[1]);
                $query = "INSERT into emp(sno, full_name, contact) values('$db_sno','$item1','$item2')";
                mysqli_query($connect, $query);
   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
 }
}
?>  
<!DOCTYPE html>  
<html>  
 <head>  
  <title>Insert Multiple Data</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 </head>  
 <body>  
 
 <style>
 div{
	width: 600px;
	padding: 10PX;
	border: 3px solid purple;
	background-color: rgb(250, 226, 205);
	margin: 33px auto;
	border-top-left-radius: 30px;
	border-top-right-radius: 30px;
	border-bottom-left-radius: 8px;
	border-bottom-right-radius: 8px;
	} 
			.backbutton {
			  background-color: #ef5350;
			  border-radius: 15px;
			  color: white;
			  padding: 10px 25px;
			  text-align: center;
			  text-decoration: none;
			  display: inline-block;
			  font-size: 16px;
			  margin: 4px 2px;
			  cursor: pointer;
			}
 </style>
 

  <form method="post" enctype="multipart/form-data">
   <div align="center">  
   <h1 style="color:Brown" align = "center">Import multiple Data from CSV File</h1><br>
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
  <a href="temp.php" class="backbutton">Back</a>
 </body>  
</html>