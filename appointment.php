<?php
//Include required PHPMailer files
        	require 'includes/PHPMailer.php';
        	require 'includes/SMTP.php';
        	require 'includes/Exception.php';
//Define name spaces
        	use PHPMailer\PHPMailer\PHPMailer;
        	use PHPMailer\PHPMailer\SMTP;
        	use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>

<html>
<head>
<title>RT PCR Test Booking Tool</title>
<link rel="stylesheet" href="styleit.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@1,300&display=swap" rel="stylesheet">
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body id="backg">

	<div id="head">
		<h1 style="color:SlateBlue" align = "center">RT PCR Test Booking Tool</h1>
	    <h2 style="color:MediumSeaGreen" align = "center">Siemens, Kalwa</h2>
	</div>
	<br>
<div id="div1">
<form action = "" method = "POST" class="form1">
		<label for="contact" class="c">Enter Your 10 digits mobile no:</label>
		<input type="text" id = "contact" name="contact" value = "" placeholder = "Enter Registered Mob no" >
		<input type="submit" name = "BT" value="Search" id="search">
</div>
</form>
<?php
			$db = mysqli_connect("localhost", "root", "","rtemployee");
			

			
			if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['BT']=="Search")
			{
				$con = $_REQUEST["contact"];
				$condition='';
				$contact = explode(" ",$_POST['contact']);
        // if $contact
        if(empty($con)) { 
          echo "Please enter your phone no. It can not be blank";
        }
        else{
        foreach($contact as $text){
          // echo $text."<br>";
          $condition.="contact LIKE '%".mysqli_real_escape_string($db,$text)."%' OR ";
        }
        // echo "<br>".$condition."<br>";
        $condition=substr($condition, 0, -4);
        $arr=array();
				$sql="SELECT * FROM emp WHERE ".$condition;
				$result=mysqli_query($db,$sql);
				if(mysqli_num_rows($result)>0){
				while ($row = mysqli_fetch_array($result)) {
                    array_push($arr, $row['contact']);
					echo "<tr><td><p align='center'> "."Employee's name : "."<font color=blue size='5pt'>".$row['full_name']."</font></p></td></tr>";
				}
				foreach($contact as $text){
				$query="INSERT INTO stat (contact) VALUES ('$text')";
                if(mysqli_query($db, $query)) {
                    echo "";
                  } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($db);
                  }
                }
				}
				else{
				echo "<tr><td><p align='center'>"."<font color=blue size='5pt'>"."Your record is not in our database, kindly contact with administration"."</font></p></td></tr>";
				}
			}
    }
	?>
			
<form action = "" method = "POST">			
<div id="div2"><br>
		<span class="c">Select the Date:</span>

		<label for="day1" class="container">03/06/2021
		<input type="radio" id="day1" name="date" value="1" required >
		<span class="checkmark"></span>
		</label>

		<label for="day2" class="container">04/06/2021
		<input type="radio" id="day2" name="date" value="2">
		<span class="checkmark"></span>
		</label>

		
		<p class="c" >Select the time-slot:</p>

		<label for="morning" class="container">Morning
		<input type="radio" id="morning" name="time" value="1" required >
		<span class="checkmark"></span>
		</label>

		<label for="afternoon" class="container">Afternoon
		<input type="radio" id="afternoon" name="time" value="2" >
		<span class="checkmark"></span>
		</label>

		<label for="evening" class="container">Evening
		<input type="radio" id="evening" name="time" value="3" >
		<span class="checkmark"></span>
		</label>
		
		<label for="mailid" class="c"><br>Enter Your Email id for getting Confirmation:</label>
		<input type="text" id = "mailid" name="mailid" placeholder = "Enter your mail id" required oninvalid="this.setCustomValidity('Please enter your mailid')"
         oninput="this.setCustomValidity('')">
		
		
		<input type="submit" name="BT" value="Submit" id="submit"><br><br>
  
	</form>
	
<?php

//session_start();
//function for mail sender
function mail_send($recip, $messages){
        //Create instance of PHPMailer
        	$mail = new PHPMailer();
        //Set mailer to use smtp
        	$mail->isSMTP();
        //Define smtp host
        	$mail->Host = "smtp.gmail.com";
        //Enable smtp authentication
        	$mail->SMTPAuth = true;
        //Set smtp encryption type (ssl/tls)
        	$mail->SMTPSecure = "tls";
        //Port to connect smtp
        	$mail->Port = "587";
        //Set gmail username
        	$mail->Username = "csecourse02@gmail.com";
        //Set gmail password
        	$mail->Password = "MyPassword@1234";
        //Email subject
        	$mail->Subject = "RT-PCR Appointment Confirmation";
        //Set sender email
        	$mail->setFrom('csecourse02@gmail.com');
        //Enable HTML
        	$mail->isHTML(true);
        //Attachment
        	//$mail->addAttachment('img/attachment.png');
        //Email body
        	$mail->Body = $messages;
        //Add recipient
        	$mail->addAddress($recip);
        //Finally send email
        	if ( $mail->send() ) {
        		echo "<br>";
        	}
        	else{
        	    echo "error..";
        	}/*
        	else{
        		echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
        	}*/
        	
        //Closing smtp connection
        	$mail->smtpClose();
}

if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['BT']=="Submit")
{

//Function for time 

function Time_Resize($num)
{
  $rem=$num%60;
  $div=(int)($num/60);
  if ($num==540){
    return '0'.$div. ':00:00';
  }
  elseif($num<600){
    return '0'.$div. ':'.$rem.':00' ;  
  }
  elseif($num%60==0){
    return $div.':00:00' ;
  }
  else{
    return $div.':'.$rem.':00' ;
  }
}

$db = mysqli_connect("localhost", "root", "","rtemployee");
if ($db->connect_error){
    die("connection failed :". $db->connect_error);
}
$radio_vial=$_REQUEST['time'];
// echo "Selected session is = ".$radio_vial;


//for mail sending
$sel_mail=$_REQUEST['mailid'];

//For Date selection

$sel_date=$_REQUEST['date'];
// echo "Selected date is = ".$sel_date;
if ($sel_date==1){
  $date='2021-06-03';
  //$date1 = date_format($date,'d-m-Y');
  $date1 = DateTime::createFromFormat('Y-m-d', $date);
  $date2 = $date1->format('d-m-Y');
}
if($sel_date==2){
  $date='2021-06-04';
  //$date1 = date_format($date,'d-m-Y');
  
  $date1 = DateTime::createFromFormat('Y-m-d', $date);
  $date2 = $date1->format('d-m-Y');
  //$date2 = $date1->format('d-m-Y');
}
// echo "Connected Successfully<br>";
$query3 = "SELECT COUNT(*) FROM stat";
$result4=$db->query($query3);
    if($result4->num_rows>0){
     while($row4 = $result4->fetch_assoc()){
        $count=$row4['COUNT(*)'];
    }
      }
$message="<table style='font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;'>
<tr style='background-color: #dddddd;' >
  <th style='cborder: 1px solid #dddddd;
  text-align: left;
  padding: 8px;'>Name</th>
  <th style='cborder: 1px solid #dddddd;
  text-align: left;
  padding: 8px;'>Date</th>
  <th style='cborder: 1px solid #dddddd;
  text-align: left;
  padding: 8px;'>Time-slot</th>
</tr>";

if($count > 0)
{
	


for($id_i=1; $id_i<=$count; $id_i++){
$query="SELECT contact FROM stat WHERE sno=$id_i";
$result=$db->query($query);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		$fill_contact=$row['contact'];
	}
}
$sql="SELECT contact FROM emp WHERE contact=$fill_contact";
$result=$db->query($sql);
if($result->num_rows==0){
  echo "<br>".$fill_contact." is not in our database<br>";
}
// echo " contact is ".$fill_contact;

// For getting the session data


// Checking entered phone number is present or not in morning database
else{
$query1 = "SELECT COUNT(*) FROM morning WHERE contact=$fill_contact";
$result2=$db->query($query1);
    if($result2->num_rows>0){
    while($row2 = $result2->fetch_assoc()){
    $count1=$row2['COUNT(*)'];
}
    }

//Checking entered phone number is present or not in afternoon database

$query2 = "SELECT COUNT(*) FROM afternoon WHERE contact=$fill_contact";
$result3=$db->query($query2);
    if($result3->num_rows>0){
    while($row3 = $result3->fetch_assoc()){
    $count2=$row3['COUNT(*)'];
}
    }


$query3 = "SELECT COUNT(*) FROM evening WHERE contact=$fill_contact";
$result4=$db->query($query3);
    if($result4->num_rows>0){
     while($row4 = $result4->fetch_assoc()){
        $count3=$row4['COUNT(*)'];
    }
      }


  $sql="SELECT full_name,contact,email,emp_id,addresses FROM emp Where contact=$fill_contact";
  $result=$db->query($sql);
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $name=$row["full_name"];
        $contact=$row["contact"];
        $Email=$row["email"];
        $Emp=$row["emp_id"];
        $address=$row["addresses"];
      }
    }
  else {
    echo "Entered phone number is not in our database. Please contact with admin";
  }
  if($count1==0 && $count2==0 && $count3==0){

//Morning Database
  if($radio_vial==1){
  $query1="SELECT COUNT(sno) FROM morning WHERE dated='2021-06-03'";
  $result1=$db->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $id1=$row1['COUNT(sno)'];
}
$query2="SELECT COUNT(sno) FROM morning WHERE dated='2021-06-04'";
  $result2=$db->query($query2);
  while($row2 = $result2->fetch_assoc()){
    $id2=$row2['COUNT(sno)'];
}
$id=$id1+$id2+1;

  //Inserting into morning database
  if($sel_date==1){
  $temp=540+$id1-($id1%10); 
  $time=Time_Resize($temp);
  }
  if($sel_date==2){
    $temp=540+$id2-($id2%10); 
  $time=Time_Resize($temp);
  }
  $sql = "INSERT INTO morning (sno,full_name,contact,addresses, email,emp_id, dated, timer) VALUES ('$id','$name', '$contact','$address','$Email','$Emp','$date','$time' )";
  if ($db->multi_query($sql) === TRUE) {
	  
	/*if($id_i === 1){
		$message="<table style='font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;'>
		<tr >
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Name</th>
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Date</th>
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Time-slot</th>
		</tr>";
	}*/
	
    if($id_i%2==0){
    $message.= "<tr style='background-color: #dddddd;'>
    <td style='cborder: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$name."</td>
    <tdstyle='cborder: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$date2."</td>
    <tdstyle='cborder: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".date('g:i a', strtotime($time))."</td>
  </tr>";
}
else{
 
  $message.= "<tr>
  <td style='border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;'>".$name."</td>
  <td style='border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;'>".$date2."</td>
  <td style='border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;'>".date('g:i a', strtotime($time))."</td>
</tr>";
}
  // echo "Your slot is booked.<br> Come at sharp ".$time. " on ".$date;
    // echo "<br>".$message;
    // mail_send($sel_mail, $message);
    //$_SESSION['msg'] = $message;
    //$_SESSION['mail'] = $Email;
    //header("location: /index.php");

    
    
  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }
}

//Afternoon Database

if($radio_vial==2){
  $query1="SELECT COUNT(sno) FROM afternoon WHERE dated='2021-06-03'";
  $result1=$db->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $id1=$row1['COUNT(sno)'];
}
$query2="SELECT COUNT(sno) FROM afternoon WHERE dated='2021-06-04'";
  $result2=$db->query($query2);
  while($row2 = $result2->fetch_assoc()){
    $id2=$row2['COUNT(sno)'];
}
$id=$id1+$id2+1;
  //Inserting data into afternoon database

  if($sel_date==1){
    $temp=720+$id1-($id1%10); 
    $time=Time_Resize($temp);
    }
    if($sel_date==2){
      $temp=720+$id2-($id2%10); 
    $time=Time_Resize($temp);
    }
  $sql = "INSERT INTO afternoon (sno,full_name,contact,addresses, email,emp_id, dated, timer) VALUES ('$id','$name', '$contact','$address','$Email','$Emp','$date','$time' )";
  if ($db->multi_query($sql) === TRUE) {
	  
	/*if($id_i == 1){
		$message="<table style='font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;'>
		<tr >
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Name</th>
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Date</th>
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Time-slot</th>
		</tr>";
	}*/
	
    if($id_i%2==0){
      $message.= "<tr style='background-color: #dddddd;'>
      <td style='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$name."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$date2."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".date('g:i a', strtotime($time))."</td>
    </tr>";
  }
  else{
   
    $message.= "<tr>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$name."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$date2."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".date('g:i a', strtotime($time))."</td>
  </tr>";
  }
    // $message= "Your slot is booked.<br> Come at sharp ".$time. " on ".$date;
    // echo "<br>".$message;
    // mail_send($sel_mail, $message);
  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }
}

//Evening Database

if($radio_vial==3){
  $query1="SELECT COUNT(sno) FROM evening WHERE dated='2021-06-03'";
  $result1=$db->query($query1);
  while($row1 = $result1->fetch_assoc()){
    $id1=$row1['COUNT(sno)'];
}
$query2="SELECT COUNT(sno) FROM evening WHERE dated='2021-06-04'";
  $result2=$db->query($query2);
  while($row2 = $result2->fetch_assoc()){
    $id2=$row2['COUNT(sno)'];
}
$id=$id1+$id2+1;
  //Inserting into evening database
  
  if($sel_date==1){
    $temp=900+$id1-($id1%10); 
    $time=Time_Resize($temp);
    }
    if($sel_date==2){
      $temp=900+$id2-($id2%10); 
    $time=Time_Resize($temp);
    }
  $sql = "INSERT INTO evening (sno,full_name,contact,addresses, email,emp_id, dated, timer) VALUES ('$id','$name', '$contact','$address','$Email','$Emp','$date','$time' )";
  if ($db->multi_query($sql) === TRUE) {
    // $message= "Your slot is booked.<br> Come at sharp ".$time. " on ".$date;
	/*if($id_i == 1){
		$message="<table style='font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;'>
		<tr >
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Name</th>
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Date</th>
		  <th style='cborder: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;'>Time-slot</th>
		</tr>";
	}*/
	
    if($id_i%2==0){
      $message.= "<tr style='background-color: #dddddd;'>
      <td style='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$name."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$date2."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".date('g:i a', strtotime($time))."</td>
    </tr>";
  }
  else{
   
    $message.= "<tr>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$name."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$date2."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".date('g:i a', strtotime($time))."</td>
  </tr>";
  }
    // echo "<br>".$message;
    // mail_send($sel_mail, $message);
  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }
}

}
else{
  echo "You have already booked your slot.<br>";

//Checking User has already booked his slot or not in morning

  if ($count1>0){
    $query5="SELECT dated, timer FROM morning WHERE contact=$fill_contact";
    $result5=$db->query($query5);
    if($result5->num_rows>0){
      while($row5=$result5->fetch_assoc()){
        $datem=$row5['dated'];
        $timem=$row5['timer']; 
      }
    }
    if($id_i%2==0){
      $message.= "<tr style='background-color: #dddddd;'>
      <td style='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$name."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$datem."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".date('g:i a', strtotime($timem))."</td>
    </tr>";
  }
  else{
   
    $message.= "<tr>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$name."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$datem."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".date('g:i a', strtotime($timem))."</td>
  </tr>";
  }
    echo $name." Kindly report at test centre at ".date('g:i a', strtotime($timem))." on ".$datem."<br>";
  }
  
  // Checking User has already booked his slot or not in afternoon

  if ($count2>0){
    $query="SELECT dated, timer FROM afternoon WHERE contact=$fill_contact";
    $result=$db->query($query);
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        $datea=$row['dated'];
        $timea=$row['timer'];
      }
    }
    if($id_i%2==0){
      $message.= "<tr style='background-color: #dddddd;'>
      <td style='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$name."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$datea."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".date('g:i a', strtotime($timea))."</td>
    </tr>";
  }
  else{
   
    $message.= "<tr>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$name."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$datea."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$date('g:i a', strtotime($timea))."</td>
  </tr>";
  }
  echo $name." Kindly report at test centre at ".date('g:i a', strtotime($timea))." on ".$datea."<br>";
  }
  
  // Checking User has already booked his slot or not in evening

  if ($count3>0){
    $query="SELECT dated, timer FROM evening WHERE contact=$fill_contact";
    $result=$db->query($query);
    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
        $datee=$row['dated'];
        $timee=$row['timer'];
      }
    }
    if($id_i%2==0){
      $message.= "<tr style='background-color: #dddddd;'>
      <td style='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$name."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".$datee."</td>
      <tdstyle='cborder: 1px solid #dddddd;
      text-align: left;
      padding: 8px;'>".date('g:i a', strtotime($timee))."</td>
    </tr>";
  }
  else{
   
    $message.= "<tr>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$name."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".$datee."</td>
    <td style='border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;'>".date('g:i a', strtotime($timee))."</td>
  </tr>";
  }
  echo $name." Kindly report at test centre at ".date('g:i a', strtotime($timee))." on ".$datee."<br>";

  }
}
}
}

$message.="</table>";
echo $message;
mail_send($sel_mail, $message);
if($count==1){
  echo "<br>Your slot is booked.<br> Come at sharp ".date('g:i a', strtotime($time)). " on ".$date2;
  
}
else{
	
  //echo $message."</table><br>";
  echo "<br>Check your mail for detailed information"; 
}
$sql1="DELETE FROM `stat`";
$db->query($sql1) === TRUE;
$sql2="ALTER TABLE `stat` DROP `sno`";
$db->query($sql2) === TRUE;
$sql3="ALTER TABLE `stat` AUTO_INCREMENT = 1";
$db->query($sql3) === TRUE;
$sql4="ALTER TABLE `stat` ADD `sno` INT(4) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`sno`)";
$db->query($sql4) === TRUE;
}

else{
	echo "Enter any valid number";
}
$db->close();
}
?>
</div>
</body>
</html>