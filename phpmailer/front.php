<!DOCTYPE html>

<html>
<head>
<title>RT PCR Test Booking Tool</title>
<style>
                #backg {
                background-image: url(https://www.crushpixel.com/big-static15/preview4/flat-design-coronavirus-covid19-on-2144595.jpg);
                /*background-repeat: no-repeat;*/
                background-size: auto;
            }
            
            #head {
                text-align: center;
                background-color: antiquewhite;
                margin: 0;
            }
            
            #div1 {
                padding-left: 30%;
                padding-right: 30%;
                margin: 0;
                color: antiquewhite;
                padding-bottom: 0ch;
            }
            
            #div2 {
                margin: 0;
                color: antiquewhite;
                padding-left: 30%;
                padding-right: 30%;
            }
            
            #submit {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;
                color: red;
                font-weight: bold;
                background-color: rgb(0, 255, 0);
            }
            
            .b {
                font-weight: bold;
                color: rgb(187, 255, 0);
            }
            
            .c {
                font-size: 20px;
                font-weight: bolder;
                margin-bottom: 5px;
            }
            
            input[type=text] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                box-sizing: border-box;
            }
            
            #search {
                display: block;
                margin: 0px auto;
                height: auto;
                width: 500px;
                padding: 20px;
                background-color: rgb(134, 136, 139);
                font-weight: bolder;
            }
            /* The container */
            
            .container {
                display: block;
                position: relative;
                padding-left: 40px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                color: rgb(218, 40, 40);
            }
            /* Hide the browser's default checkbox */
            
            .container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }
            /* Create a custom checkbox */
            
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #eee;
            }
            /* On mouse-over, add a grey background color */
            
            .container:hover input~.checkmark {
                background-color: #ccc;
            }
            /* When the checkbox is checked, add a blue background */
            
            .container input:checked~.checkmark {
                background-color: #2196F3;
            }
            /* Create the checkmark/indicator (hidden when not checked) */
            
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }
            /* Show the checkmark when checked */
            
            .container input:checked~.checkmark:after {
                display: block;
            }
            /* Style the checkmark/indicator */
            
            .container .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            
            body {
                border: 3px dotted black;
                padding-bottom: 3cm;
                padding-top: 1cm;
            }
            .dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: absolute;
  top: 130px;
  right: 60px;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
    </style>

</head>
<body id="backg">

	<h1 id="head">RT PCR Test Booking Tool</h1>
	<h2 id="head">Siemens, Kalwa</h2>
	<br>
<div id="div1">
	<form action = "" method = "POST" class="form1">
		<label for="contact" class="c">Enter Your 10 digits mobile no:</label>
		<input type="text" id = "contact" name="contact" placeholder = "Enter Registered Mob no" />
		<input type="submit" name = "BT" value="Search" id="search"/>
</div>
<?php
			$connection = mysqli_connect("localhost","root");
			$db = mysqli_select_db($connection, "master");
			
			if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['BT']=="Search")
			{
				$contact = $_POST['contact'];
				$sql="SELECT * FROM emp WHERE contact = $contact";
				$result=mysqli_query($connection,$sql);
				if($result){
				while ($row = mysqli_fetch_array($result)) {
					echo "Employee's name : ".$row['full_name'] ;
				}
				$query3 = "SELECT COUNT(*) FROM stat ";
                $result4=$connection->query($query3);
                    if($result4->num_rows>0){
                    while($row4 = $result4->fetch_assoc()){
                        $id=$row4['COUNT(*)'];
                    }
                    }
                    $id+=1;
				$query="INSERT INTO stat (sno, contact) VALUES ('$id','$contact')";
                if(mysqli_query($connection, $query)) {
                    echo "New record created successfully";
                  } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($connnection);
                  }
				}
				else{
				echo "Your record is not in our database, kindly contact with administration";
				}
			}
		
		?>
    
<div id="div2"><br>
		<span class="c">Select the Date:</span>

		<label for="day1" class="container">03/06/2021
		<input type="radio" id="day1" name="date" value="1">
		<span class="checkmark"></span>
		</label>

		<label for="day2" class="container">04/06/2021
		<input type="radio" id="day2" name="date" value="2">
		<span class="checkmark"></span>
		</label>

		
		<p class="c" >Select the time-slot:</p>

		<label for="morning" class="container">Morning
		<input type="radio" id="morning" name="time" value="1">
		<span class="checkmark"></span>
		</label>

		<label for="afternoon" class="container">Afternoon
		<input type="radio" id="afternoon" name="time" value="2">
		<span class="checkmark"></span>
		</label>

		<label for="evening" class="container">Evening
		<input type="radio" id="evening" name="time" value="3">
		<span class="checkmark"></span>
		</label>
		
		<input type="submit" name="BT" value="Submit" id="submit"><br><br>
  
	</form>
  <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">LOG IN</button>
  <div id="myDropdown" class="dropdown-content">
  <a href="loginpage.html">Admin Login</a>
  
  </div>
  </div>
    <?php

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

$db=mysqli_connect("localhost", "root", "", "master") ;
if ($db->connect_error){
    die("connection failed :". $db->connect_error);
}
// echo "Connected Successfully<br>";
$query3 = "SELECT COUNT(*) FROM stat";
$result4=$db->query($query3);
    if($result4->num_rows>0){
     while($row4 = $result4->fetch_assoc()){
        $count=$row4['COUNT(*)'];
    }
      }
$query="SELECT contact FROM stat WHERE sno=$count";
$result=$db->query($query);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		$fill_contact=$row['contact'];
	}
}
echo " contact is ".$fill_contact;

// For getting the session data

$radio_vial=$_REQUEST['time'];
// echo "Selected session is = ".$radio_vial;

//For Date selection

$sel_date=$_REQUEST['date'];
echo "Selected date is = ".$sel_date;
if ($sel_date=='1'){
  $date='2021-06-03';
}
if($sel_date==2){
  $date='2021-06-04';
}

//Checking entered phone number is present or not in morning database

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

if($count1==0 && $count2==0 && $count3==0){

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
    echo "Your slot has booked. Come at sharp ".$time. " on ".$date;
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
    echo "Your slot has booked. Come at sharp ".$time. " on ".$date;
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
    echo "Your slot has booked. Report at the  sharp ".$time. " on ".$date;
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
    echo "Kindly report at test centre at ".$timem." on ".$datem;
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
  echo "Kindly report at test centre at ".$timea." on ".$datea;
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
  echo "Kindly report at test centre at ".$timee." on ".$datee;
  }
}

$db->close();
}
?>
</div>
</body>
</html>